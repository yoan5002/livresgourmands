<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantite' => 'required|integer'
        ]);

        $livre = Livre::findOrFail($id);
        $livre->stock += $request->quantite;
        if ($livre->stock < 0) {
            $livre->stock = 0; // éviter stock négatif
        }
        $livre->save();

        return redirect()->back()->with('success', 'Stock mis à jour !');
    }
}
