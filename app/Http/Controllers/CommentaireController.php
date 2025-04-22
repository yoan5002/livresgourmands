<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;
use App\Models\Livre;

class CommentaireController extends Controller
{
    // Affiche les commentaires à valider (pour l'admin)
    public function index()
    {
        $commentaires = Commentaire::with(['user', 'livre'])
            ->where('valide', false)
            ->get();

        return view('commentaires.index', compact('commentaires'));
    }

    // Validation ou rejet d'un commentaire
    public function update(Request $request, $id, $action)
    {
        $commentaire = Commentaire::findOrFail($id);
    
        if ($action === 'valide') {
            $commentaire->valide = true;
        } elseif ($action === 'rejete') {
            $commentaire->delete(); // ou $commentaire->valide = false si tu veux garder
        } else {
            return back()->with('error', 'Action non reconnue.');
        }
    
        $commentaire->save();
    
        return back()->with('success', 'Commentaire ' . $action . ' avec succès.');
    }
    
    

    

    // Ajout d’un commentaire (par un éditeur)
    public function store(Request $request)
    {
        $request->validate([
            'livre_id' => 'required|exists:livres,id',
            'contenu' => 'required|string',
        ]);

        Commentaire::create([
            'livre_id' => $request->livre_id,
            'user_id' => auth()->id(),
            'contenu' => $request->contenu,
            'valide' => false, // Par défaut
        ]);

        return back()->with('success', 'Commentaire soumis pour validation.');
    }
    public function create()
    {
        $livres = \App\Models\Livre::all();
        return view('commentaires.create', compact('livres'));
    }
}
