<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Article;



class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crée 10 auteurs avec des données fictives
        //Author::factory()->count(10)->create();
        // Author::factory()
        //     ->count(10)
        //     ->has(Article::factory()->count(3)) // Chaque auteur aura 3 articles
        //     ->create();
        // Crée 10 auteurs avec des données fictives
        Author::factory()
            ->count(10)
            ->has(Article::factory()->count(fake()->numberBetween(1, 5))) // Chaque auteur aura entre 1 et 5 articles
            ->create();
    }
}
