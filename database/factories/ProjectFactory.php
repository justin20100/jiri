<?php

namespace Database\Factories;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'weighting' => $this->faker->numberBetween(1, 100),
            'github' => $this->faker->text(),
            'link' => $this->faker->text(),
            'description'=> $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
