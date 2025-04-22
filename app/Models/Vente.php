<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function livre()
    {
        return $this->belongsTo(Livre::class);
    }
    
    protected $fillable = [
        'user_id',
        'livre_id',
        'quantite',
        'prix_unitaire',
        'date_vente'
    ];
    
}
