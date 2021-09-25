<?php

namespace Database\Factories;

use App\Models\Sujet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SujetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sujet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'description' => $this->faker->paragraphs(6, true),
            'titre' => $this->faker->words(5, true),
            'created_at' => now(),
            'updated_at' => now(),

           ];
    }
}
