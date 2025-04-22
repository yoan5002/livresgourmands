<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Livre;
use App\Models\Commentaire;
use Illuminate\Support\Facades\Auth;

class EditeurController extends Controller
{  
    
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $livres = Livre::with('categorie')->get();
        $categories = Categorie::all();
        return view('editeur.livres', compact('livres', 'categories'));
    }

    public function categories()
    {
        $categories = Categorie::all();
         return view('editeur.categories', compact('categories'));
    }

    public function commentaires()
    {
        $commentaires = Commentaire::with('livre', 'user')->where('statut', 'en_attente')->get();
        return view('editeur.commentaires', compact('commentaires'));
    }
}

