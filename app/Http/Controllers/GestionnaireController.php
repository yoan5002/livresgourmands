<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre; 
use App\Models\Vente;

class GestionnaireController
{
    public function catalogue()
    {
        $livres = Livre::with('categorie')->get();
        return view('gestionnaire.catalogue', compact('livres'));
    }

    public function stock()
    {
        $livres = Livre::all();
        return view('gestionnaire.stock', compact('livres'));
    }

    public function ventes()
    {
        $ventes = Vente::with('livre', 'user')->get();
        return view('gestionnaire.vente', compact('ventes'));
    }
}
