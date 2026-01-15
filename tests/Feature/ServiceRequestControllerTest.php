<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Mission;
use App\Models\ServiceProvider;
use App\Models\MissionOffer;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceRequestControllerTest extends TestCase
{
    use WithFaker;

    /**
     * Test authenticated user can access service requests page.
     */
    public function test_authenticated_user_can_access_service_requests()
    {
        $user = User::factory()->create(['status' => 'active']);

        $response = $this->actingAs($user)
            ->get(route('user.service.requests'));

        $response->assertStatus(200);
    }

    /**
     * Test unauthenticated user is redirected from service requests.
     */
    public function test_unauthenticated_user_cannot_access_service_requests()
    {
        $response = $this->get(route('user.service.requests'));

        $response->assertRedirect(route('login'));
    }

    /**
     * Test mission list is returned for authenticated user.
     */
    public function test_user_can_get_their_missions()
    {
        $user = User::factory()->create(['status' => 'active']);

        // Create missions for this user
        Mission::factory()->count(3)->create([
            'requester_id' => $user->id,
            'status' => 'published',
        ]);

        $response = $this->actingAs($user)
            ->getJson('/get-missions');

        $response->assertStatus(200);
    }

    /**
     * Test mission model factory works.
     */
    public function test_mission_factory_creates_mission()
    {
        $user = User::factory()->create(['status' => 'active']);
        $mission = Mission::factory()->create([
            'requester_id' => $user->id,
            'status' => 'published',
        ]);

        $this->assertDatabaseHas('missions', [
            'id' => $mission->id,
            'requester_id' => $user->id,
            'status' => 'published',
        ]);
    }

    /**
     * Test mission belongs to requester.
     */
    public function test_mission_belongs_to_requester()
    {
        $user = User::factory()->create(['status' => 'active']);
        $mission = Mission::factory()->create([
            'requester_id' => $user->id,
        ]);

        $this->assertEquals($user->id, $mission->requester_id);
        $this->assertInstanceOf(User::class, $mission->requester);
    }

    /**
     * Test ongoing requests page loads for authenticated user.
     */
    public function test_ongoing_requests_page_loads()
    {
        $user = User::factory()->create(['status' => 'active']);

        $response = $this->actingAs($user)
            ->get(route('ongoing-requests'));

        $response->assertStatus(200);
    }

    /**
     * Test category subcategories endpoint works.
     */
    public function test_subcategories_endpoint_works()
    {
        $user = User::factory()->create(['status' => 'active']);
        $parentCategory = Category::factory()->create(['parent_id' => null]);
        Category::factory()->count(3)->create(['parent_id' => $parentCategory->id]);

        $response = $this->actingAs($user)
            ->getJson("/get-subcategories/{$parentCategory->id}");

        $response->assertStatus(200);
    }
}
