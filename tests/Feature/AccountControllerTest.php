<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\ServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
    use WithFaker;

    /**
     * Test authenticated user can access personal info page.
     */
    public function test_authenticated_user_can_access_personal_info_page()
    {
        $user = User::factory()->create(['status' => 'active']);

        $response = $this->actingAs($user)
            ->get(route('personal-info'));

        $response->assertStatus(200);
    }

    /**
     * Test unauthenticated user is redirected from personal info page.
     */
    public function test_unauthenticated_user_cannot_access_personal_info()
    {
        $response = $this->get(route('personal-info'));

        $response->assertRedirect(route('login'));
    }

    /**
     * Test user can update personal information.
     */
    public function test_user_can_update_personal_info()
    {
        $user = User::factory()->create(['status' => 'active']);
        $newName = $this->faker->name();

        $response = $this->actingAs($user)
            ->postJson('/account/update-personal-info', [
                'name' => $newName,
                'email' => $user->email,
                'gender' => 'Male',
            ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $newName,
        ]);
    }

    /**
     * Test user cannot update with invalid email.
     */
    public function test_user_cannot_update_with_invalid_email()
    {
        $user = User::factory()->create(['status' => 'active']);

        $response = $this->actingAs($user)
            ->postJson('/account/update-personal-info', [
                'name' => $user->name,
                'email' => 'invalid-email',
            ]);

        $response->assertStatus(422);
    }

    /**
     * Test user cannot use another user's email.
     */
    public function test_user_cannot_use_another_users_email()
    {
        $user1 = User::factory()->create(['status' => 'active']);
        $user2 = User::factory()->create(['status' => 'active']);

        $response = $this->actingAs($user1)
            ->postJson('/account/update-personal-info', [
                'name' => $user1->name,
                'email' => $user2->email, // Try to use user2's email
            ]);

        $response->assertStatus(422);
    }

    /**
     * Test user can update password with valid credentials.
     */
    public function test_user_can_update_password()
    {
        $user = User::factory()->create([
            'status' => 'active',
            'password' => bcrypt('OldPassword123'),
        ]);

        $response = $this->actingAs($user)
            ->postJson('/account/update-password', [
                'current_password' => 'OldPassword123',
                'new_password' => 'NewPassword456',
                'new_password_confirmation' => 'NewPassword456',
            ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    /**
     * Test user cannot update password with wrong current password.
     */
    public function test_user_cannot_update_password_with_wrong_current()
    {
        $user = User::factory()->create([
            'status' => 'active',
            'password' => bcrypt('CorrectPassword123'),
        ]);

        $response = $this->actingAs($user)
            ->postJson('/account/update-password', [
                'current_password' => 'WrongPassword123',
                'new_password' => 'NewPassword456',
                'new_password_confirmation' => 'NewPassword456',
            ]);

        $response->assertStatus(400);
    }

    /**
     * Test account page requires authentication.
     */
    public function test_account_page_requires_auth()
    {
        $response = $this->get(route('user.account'));

        $response->assertRedirect(route('login'));
    }

    /**
     * Test authenticated user can access account page.
     */
    public function test_authenticated_user_can_access_account_page()
    {
        $user = User::factory()->create(['status' => 'active']);

        $response = $this->actingAs($user)
            ->get(route('user.account'));

        $response->assertStatus(200);
    }
}
