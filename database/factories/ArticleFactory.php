<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Author;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'titre' => fake()->unique()->sentence,
            'contenu' => fake()->paragraphs(asText: true),
            'author_id' => Author::factory(), // Crée un nouvel auteur et obtient son ID
        ];
    }
}
