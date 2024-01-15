<?php

namespace Database\Factories;

use App\Models\ContactJiri;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactJiriFactory extends Factory
{
    protected $model = ContactJiri::class;

    public function definition(): array
    {
        return [
            'role' => $this->faker->randomElement(['student', 'evaluator']),
            'token' => $this->faker->sha256(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
