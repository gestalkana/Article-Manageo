<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () { return view('welcome');});

Route::get('/', [ArticleController::class, 'home'])->name('home');
Route::put('/authors/{id}', [AuthorController::class, 'updateModal'])->name('authors.updateModal');

Route::resource('articles', ArticleController::class); //Ici le nom de la ressource c'est 'articles' d'où l'utilsation de ce nom dans route au view 'articles.Methode' (exp: articles.index)

Route::resource('authors', AuthorController::class);

//teto mbola juste liste auteur fotsiny
//Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
