<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Mission;
use App\Models\ServiceProvider;
use App\Models\MissionOffer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StripePaymentControllerTest extends TestCase
{
    use WithFaker;

    /**
     * Test checkout requires authentication.
     */
    public function test_checkout_requires_authentication()
    {
        $response = $this->postJson('/payments/stripe/checkout', [
            'mission_id' => 1,
            'provider_id' => 1,
            'offer_id' => 1,
            'amount' => 100,
            'client_fee' => 10,
            'total' => 110,
        ]);

        $response->assertStatus(401);
    }

    /**
     * Test checkout validates required fields.
     */
    public function test_checkout_validates_required_fields()
    {
        $user = User::factory()->create(['status' => 'active']);

        $response = $this->actingAs($user)
            ->postJson('/payments/stripe/checkout', [
                // Missing required fields
            ]);

        $response->assertStatus(422);
    }

    /**
     * Test checkout validates mission exists.
     */
    public function test_checkout_validates_mission_exists()
    {
        $user = User::factory()->create(['status' => 'active']);

        $response = $this->actingAs($user)
            ->postJson('/payments/stripe/checkout', [
                'mission_id' => 999999, // Non-existent
                'provider_id' => 1,
                'offer_id' => 1,
                'amount' => 100,
                'client_fee' => 10,
                'total' => 110,
            ]);

        $response->assertStatus(422);
    }

    /**
     * Test process payment requires authentication.
     */
    public function test_process_payment_requires_auth()
    {
        $response = $this->postJson('/payments/stripe/process', [
            'payment_intent_id' => 'pi_test123',
        ]);

        $response->assertStatus(401);
    }

    /**
     * Test process payment validates payment intent format.
     */
    public function test_process_payment_validates_intent_format()
    {
        $user = User::factory()->create(['status' => 'active']);

        $response = $this->actingAs($user)
            ->postJson('/payments/stripe/process', [
                'payment_intent_id' => 'invalid_format', // Should start with pi_
            ]);

        $response->assertStatus(422);
    }

    /**
     * Test service provider factory works.
     */
    public function test_service_provider_factory_works()
    {
        $user = User::factory()->create([
            'status' => 'active',
            'user_role' => 'service_provider',
        ]);

        $provider = ServiceProvider::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('service_providers', [
            'id' => $provider->id,
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test mission with provider relationship.
     */
    public function test_mission_with_provider_relationship()
    {
        $requester = User::factory()->create(['status' => 'active']);
        $providerUser = User::factory()->create([
            'status' => 'active',
            'user_role' => 'service_provider',
        ]);
        $provider = ServiceProvider::factory()->create([
            'user_id' => $providerUser->id,
        ]);

        $mission = Mission::factory()->create([
            'requester_id' => $requester->id,
            'selected_provider_id' => $provider->id,
            'status' => 'waiting_to_start',
        ]);

        $this->assertEquals($provider->id, $mission->selected_provider_id);
    }

    /**
     * Test mission offer factory works.
     */
    public function test_mission_offer_factory_works()
    {
        $user = User::factory()->create(['status' => 'active']);
        $providerUser = User::factory()->create([
            'status' => 'active',
            'user_role' => 'service_provider',
        ]);
        $provider = ServiceProvider::factory()->create([
            'user_id' => $providerUser->id,
        ]);
        $mission = Mission::factory()->create([
            'requester_id' => $user->id,
        ]);

        $offer = MissionOffer::factory()->create([
            'mission_id' => $mission->id,
            'provider_id' => $provider->id,
            'status' => 'pending',
        ]);

        $this->assertDatabaseHas('mission_offers', [
            'id' => $offer->id,
            'mission_id' => $mission->id,
            'provider_id' => $provider->id,
        ]);
    }
}
