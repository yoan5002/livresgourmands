<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\User;
use App\Models\Livre;

class VenteController extends Controller
{
    public function create()
    {
        $livres = Livre::all();
        $users = User::all(); // clients
        return view('gestionnaire.vente_create', compact('livres', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'livre_id' => 'required|exists:livres,id',
            'quantite' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
        ]);

        Vente::create([
            'user_id' => $request->user_id,
            'livre_id' => $request->livre_id,
            'quantite' => $request->quantite,
            'prix_unitaire' => $request->prix_unitaire,
        ]);

        return redirect()->route('ventes.index')->with('success', 'Vente enregistrée avec succès !');

    }
    public function ventes()
    {
        $ventes = Vente::with(['livre', 'user'])->get();
        return view('gestionnaire.vente', compact('ventes'));
    }

}

