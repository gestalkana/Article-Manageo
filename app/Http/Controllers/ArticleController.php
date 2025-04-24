<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Author;

class ArticleController extends Controller
{
    //fonction de la page d'accueil
    public function home()
    {
        /*
        Récupère tous les articles
        $articles = Article::all();
        return view('home', compact('articles')); 
        // Assurez-vous que le nom de la vue correspond à votre fichier blade
        */

        $articles = Article::latest()->take(3)->get(); // Récupère les 3 derniers articles

        // Récupère les trois auteurs ayant écrit le plus d'articles
        $topAuthors = Author::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->take(3)
            ->get();

        return view('home', compact('articles', 'topAuthors'));


    }

    //Affichage de la liste de tous les articles
     public function index()
    {
        //$articles = Article::all(); //recupère tous les articles 

        //Récupérer tous les articles avec les relations 'author'
        //$articles = Article::with('author')->get();

        // 10 articles par page avec l'auteur chargé
        $articles = Article::with('author')->paginate(10); 
        return view('articles.index', compact('articles'));
    }

    //Affichage d'un article specifique
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    //Affichage du formulaire de création d'un article
    public function create()
    {
        $authors = Author::with('articles')->get();

        return view('articles.create', compact('authors'));
    }

    //Affichage du formulaire de modification 
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    //Enregistrer une nouvelle article
/*    public function store(Request $request)
    {
        //Message d'erreur
        $request->validate([
        'titre' => 'required|max:255',
        'contenu' => 'required',
        'author_id' => 'nullable|exists:authors,id',
        ], 
        [
        'titre.required' => 'Le titre est obligatoire.',
        'titre.max' => 'Le titre ne peut pas dépasser 255 caractères.',
        'contenu.required' => 'Le contenu est obligatoire.',
        ]);

        /*$request->validate([
            'titre'=>'required',
            'contenu'=>'required',

        ]);*/

       /* Article::create($request->all());

        return redirect()->route('articles.index');

    }*/

    public function store(Request $request)
{
    \Log::info('Request Data:', $request->all()); // Pour vérifier les données envoyées

    $request->validate([
        'titre' => 'required|max:255',
        'contenu' => 'required',
        'author_id' => 'required|exists:authors,id',
         // 'author_id' => 'nullable|exists:authors,id',
    ], 
    
    [
        'titre.required' => 'Le titre est obligatoire.',
        'titre.max' => 'Le titre ne peut pas dépasser 255 caractères.',
        'contenu.required' => 'Le contenu est obligatoire.',
        'author_id.required' => 'Le champ auteur est obligatoire.',

    ]);

    Article::create([
        'titre' => $request->input('titre'),
        'contenu' => $request->input('contenu'),
        'author_id' => $request->input('author_id'),
    ]);

    return redirect()->route('articles.index')->with('success', 'Article créé avec succès.');
}


    //Mise à jour des articles
    public function update(Request $request, Article $article){
        $request->validate([
            'titre'=>'required',
            'contenu'=>'required',
        ]);

        //Article::update($request->all());
        // Utilisez l'instance de l'article pour mettre à jour les données
        $article->update($request->only(['titre', 'contenu']));

        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès.');
    }

    //Suppression d'un article existante
    public function destroy(Article $article){
        $article->delete();

        return redirect()->route('articles.index');
    }

}
