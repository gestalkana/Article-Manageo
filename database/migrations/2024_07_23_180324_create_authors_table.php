<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //Nom de l'auteur
            $table->text('bio')->nullable(); //Biographie
            $table->integer('age')->nullable(); // Nouvelle colonne age
            $table->string('email')->unique()->nullable(); // Nouvelle colonne email
            $table->string('phone')->nullable(); // Nouvelle colonne phone
            $table->string('photo')->nullable(); // Nouvelle colonne photo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
