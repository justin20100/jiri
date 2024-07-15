<?php

namespace Database\Factories;

use App\Models\ContactDuty;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactDutyFactory extends Factory
{
    protected $model = ContactDuty::class;

    public function definition(): array
    {
        return [
            'urls' => json_encode(['https://www.google.com', 'https://www.facebook.com']),
            'points' => $this->faker->numberBetween(0, 20),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
