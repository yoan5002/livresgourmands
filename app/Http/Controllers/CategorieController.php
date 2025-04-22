<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['nom' => 'required|string|unique:categories']);
        Categorie::create(['nom' => $request->nom]);
        return redirect()->back()->with('success', 'Catégorie ajoutée !');
    }

    public function destroy($id)
    {
        Categorie::destroy($id);
        return redirect()->back()->with('success', 'Catégorie supprimée !');
    }
}

