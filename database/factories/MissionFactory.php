<?php

namespace Database\Factories;

use App\Models\Mission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mission>
 */
class MissionFactory extends Factory
{
    protected $model = Mission::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'requester_id' => User::factory(),
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(3),
            'status' => 'published',
            'payment_status' => 'unpaid',
            'location_country' => $this->faker->country(),
            'location_city' => $this->faker->city(),
            'urgency' => $this->faker->randomElement(['low', 'medium', 'high']),
            'budget_min' => $this->faker->numberBetween(50, 200),
            'budget_max' => $this->faker->numberBetween(200, 500),
            'budget_currency' => 'EUR',
        ];
    }

    /**
     * State for waiting to start missions.
     */
    public function waitingToStart()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'waiting_to_start',
            'payment_status' => 'paid',
        ]);
    }

    /**
     * State for in progress missions.
     */
    public function inProgress()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress',
            'payment_status' => 'paid',
        ]);
    }

    /**
     * State for completed missions.
     */
    public function completed()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'payment_status' => 'released',
        ]);
    }
}
