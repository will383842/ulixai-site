<?php

namespace Database\Factories;

use App\Models\MissionOffer;
use App\Models\Mission;
use App\Models\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MissionOffer>
 */
class MissionOfferFactory extends Factory
{
    protected $model = MissionOffer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'mission_id' => Mission::factory(),
            'provider_id' => ServiceProvider::factory(),
            'price' => $this->faker->numberBetween(50, 500),
            'delivery_time' => $this->faker->randomElement(['1 day', '3 days', '1 week', '2 weeks']),
            'message' => $this->faker->paragraph(),
            'status' => 'pending',
        ];
    }

    /**
     * State for accepted offer.
     */
    public function accepted()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'accepted',
        ]);
    }

    /**
     * State for rejected offer.
     */
    public function rejected()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
        ]);
    }
}
