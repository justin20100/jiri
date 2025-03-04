<?php

namespace Database\Factories;

use App\Models\JiriProject;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class JiriProjectFactory extends Factory
{
    protected $model = JiriProject::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
