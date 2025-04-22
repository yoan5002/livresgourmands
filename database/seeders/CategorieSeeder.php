<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        Categorie::insert([
            ['nom' => 'Desserts'],
            ['nom' => 'Plats'],
            ['nom' => 'Apéritifs'],
        ]);
    }
}

