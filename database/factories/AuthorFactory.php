<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use App\Models\Author;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'bio' => $this->faker->paragraph, // Génère un paragraphe de texte pour la biographie
            'age' => $this->faker->numberBetween(18, 80), // Génère un âge entre 18 et 80 ans
            'phone' => $this->faker->phoneNumber, // Génère un numéro de téléphone
            'email' => $this->faker->unique()->safeEmail,
            /*'email_verified_at' => now(),
            'photo' => $this->faker->imageUrl(640, 480, 'people', true, 'author'), // Génère une URL d'image*/
        ];
    }
}
