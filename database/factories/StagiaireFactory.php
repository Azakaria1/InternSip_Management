<?php

namespace Database\Factories;

use App\Models\Stagiaire;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StagiaireFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stagiaire::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
            'nom' => $this->faker->name(),
            'prenom' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'tel' => $this->faker->phoneNumber(),
            'date_naissance' => $this->faker->dateTimeBetween('1996-01-01', '2003-12-31')->format('Y-m-d'),
            'etablissement' =>  $this->faker->words(10, true),
            'niveau' => $this->faker->numberBetween(1, 5),
            'created_at' => now(),
            'updated_at' => now(),

           ];
    }
}
