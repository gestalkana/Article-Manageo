<?php
// app/Http/Controllers/AuthorController.php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Assure-toi que ce use est présent


class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    /*public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'age' => 'nullable|integer',
            'photo' => 'nullable|url',
            'phone' => 'nullable|string',
        ]);

        Author::create($request->all());

        return redirect()->route('authors.index');
    }*/

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'age' => 'nullable|integer',
            'email' => 'required|email|unique:authors,email',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048',
            
            
        ]);

        $author = new Author($request->all());

        if ($request->hasFile('photo')) {
            $author->photo = $request->file('photo')->store('authors', 'public');
        }

        $author->save();

        return redirect()->route('authors.index');
    }

    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

   /* public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'age' => 'nullable|integer',
            'photo' => 'nullable|url',
            'phone' => 'nullable|string',
        ]);

        $author->update($request->all());

        return redirect()->route('authors.index');
    }*/


    /*public function update(Request $request, Author $author)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'bio' => 'nullable|string',
        'age' => 'nullable|integer',
        'email' => 'required|email|unique:authors,email,' . $author->id,
        'phone' => 'nullable|string|max:20',
        'photo' => 'nullable|image|max:2048',
        
        
    ]);

    $author->fill($request->except('photo'));

    if ($request->hasFile('photo')) {
        // Supprimer l'ancienne image si elle existe
        if ($author->photo && Storage::disk('public')->exists($author->photo)) {
            Storage::disk('public')->delete($author->photo);
        }

        // Sauvegarder la nouvelle image
        $author->photo = $request->file('photo')->store('authors', 'public');
    }

    $author->save();

    return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }*/


public function update(Request $request, Author $author)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'bio' => 'nullable|string',
        'age' => 'nullable|integer',
        'email' => 'required|email|unique:authors,email,' . $author->id,
        'phone' => 'nullable|string|max:20',
        'photo' => 'nullable|image|max:2048',
    ]);

    // Mise à jour des autres champs
    $author->fill($request->except('photo'));

    if ($request->hasFile('photo')) {
        // Vérifier et supprimer l'ancienne image
        if ($author->photo && Storage::disk('public')->exists($author->photo)) {
            Log::info("Suppression de l'ancienne image : " . $author->photo);
            Storage::disk('public')->delete($author->photo);
        } else {
            Log::warning("Aucune ancienne image trouvée pour : " . $author->id);
        }

        // Sauvegarde de la nouvelle image
        $author->photo = $request->file('photo')->store('authors', 'public');
        Log::info("Nouvelle image enregistrée pour l'auteur {$author->id} : " . $author->photo);
    }

    $author->save();
    Log::info("Auteur mis à jour avec succès : " . json_encode($author));

    return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }
  
    public function updateModal(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'photo' => 'nullable|image|max:2048',
        ]);

        $author->name = $request->name;
        $author->age = $request->age;

        if ($request->hasFile('photo')) {
            if ($author->photo) {
                Storage::disk('public')->delete($author->photo);
            }
            $author->photo = $request->file('photo')->store('authors', 'public');
        }

        $author->save();

        return redirect()->route('home')->with('success', 'Profil mis à jour avec succès.');
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index');
    }
}
