<?php

namespace Pinetcodev\LaravelImpersonate\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Pinetcodev\LaravelImpersonate\Models\Impersonate;

class ModelFactory extends Factory
{
    protected $model = Impersonate::class;

    public function definition()
    {
        return [
            'impersonated_id' => 1,
            'user_id' => 1,
            'logged_in' => $this->faker->dateTime,
            'logouted_at' => $this->faker->dateTime,
        ];
    }
}
