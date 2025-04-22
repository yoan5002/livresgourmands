<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;
use App\Models\Commentaire;
use App\Models\Vente;

class Livre extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'auteur',
        'niveau_expertise',
        'category_id',
        'prix',
        'stock',
        'image'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
