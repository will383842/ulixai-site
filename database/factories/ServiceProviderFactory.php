<?php

namespace Database\Factories;

use App\Models\ServiceProvider;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceProvider>
 */
class ServiceProviderFactory extends Factory
{
    protected $model = ServiceProvider::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->state(['user_role' => 'service_provider']),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'country' => $this->faker->country(),
            'provider_visibility' => true,
            'profile_description' => $this->faker->paragraph(),
            'kyc_status' => 'pending',
        ];
    }

    /**
     * State for verified provider.
     */
    public function verified()
    {
        return $this->state(fn (array $attributes) => [
            'kyc_status' => 'verified',
            'stripe_account_id' => 'acct_' . $this->faker->regexify('[A-Za-z0-9]{16}'),
            'stripe_chg_enabled' => true,
            'stripe_pts_enabled' => true,
        ]);
    }

    /**
     * State for hidden provider.
     */
    public function hidden()
    {
        return $this->state(fn (array $attributes) => [
            'provider_visibility' => false,
        ]);
    }
}
