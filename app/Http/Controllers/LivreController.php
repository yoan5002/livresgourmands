<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivreController extends Controller
{    
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string',
            'description' => 'required|string',
            'auteur' => 'required|string',
            'niveau_expertise' => 'required|string',
            'prix' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);
        

        $data = $request->only([
            'titre',
            'description',
            'auteur',
            'niveau_expertise',
            'prix',
            'category_id',
        ]);
        $data = $request->only(['titre', 'description', 'auteur', 'niveau_expertise', 'prix', 'category_id']);
        $data['user_id'] = auth()->id(); // Lier au créateur

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/livres', 'public');
            $data['image'] = 'storage/' . $path;
        }

        Livre::create($data);

        return back()->with('success', 'Livre ajouté avec succès !');
    }

    public function destroy($id)
    {
        $livre = Livre::findOrFail($id);

        // Optionnel : supprimer l’image du disque
        if ($livre->image && Storage::disk('public')->exists(str_replace('storage/', '', $livre->image))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $livre->image));
        }

        $livre->delete();

        return redirect()->back()->with('success', 'Livre supprimé !');
    }
}

