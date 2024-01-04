<?php

namespace Database\Factories;

use App\Models\Jiri;
use Illuminate\Database\Eloquent\Factories\Factory;

class JiriFactory extends Factory
{
    protected $model = Jiri::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'start' => $this->faker->dateTime(),
            'end' => $this->faker->dateTime(),
        ];
    }
}
