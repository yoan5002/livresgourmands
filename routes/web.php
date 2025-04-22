<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\EditeurController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\GestionnaireController;
use App\Http\Controllers\VenteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Éditeur
Route::middleware('auth')->group(function () {
    Route::get('/editeur/categories', [EditeurController::class, 'categories'])->name('editeur.categories');
    Route::get('/editeur/livres', [EditeurController::class, 'index'])->name('editeur.livres');

    Route::get('/editeur/commentaires', [CommentaireController::class, 'create'])->name('commentaires.create');
    Route::post('/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');

    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');

    Route::post('/livres', [LivreController::class, 'store'])->name('livres.store');
    Route::delete('/livres/{id}', [LivreController::class, 'destroy'])->name('livres.destroy');
});

// Admin - Commentaires
Route::middleware(['auth'])->group(function () {
    Route::get('/commentaires', [CommentaireController::class, 'index'])->name('commentaires.index');
    Route::put('/commentaires/{id}/{action}', [CommentaireController::class, 'update'])->name('commentaires.update');
    Route::patch('/commentaires/{id}/valider', [CommentaireController::class, 'valider'])->name('commentaires.valider');
    Route::delete('/commentaires/{id}', [CommentaireController::class, 'destroy'])->name('commentaires.destroy');
});

// Gestionnaire - Stock & Catalogue
Route::middleware(['auth'])->prefix('gestionnaire')->group(function () {
    Route::get('/catalogue', [GestionnaireController::class, 'catalogue'])->name('gestionnaire.catalogue');
    Route::get('/stock', [GestionnaireController::class, 'stock'])->name('gestionnaire.stock');
    Route::get('/vente', [GestionnaireController::class, 'ventes'])->name('ventes.index');
    Route::get('/vente/ajouter', [VenteController::class, 'create'])->name('ventes.create');
    Route::post('/vente', [VenteController::class, 'store'])->name('ventes.store');
});

Route::put('/stock/{id}', [StockController::class, 'update'])->name('stock.update');

// Admin - Gestion utilisateurs (création/suppression uniquement)
Route::post('/admin/utilisateurs', [AdminController::class, 'store'])->name('admin.utilisateurs.store');
Route::get('/admin/utilisateurs', [AdminController::class, 'index'])->name('admin.utilisateurs');
Route::delete('/admin/utilisateurs/{id}', [AdminController::class, 'destroy'])->name('admin.utilisateurs.destroy');

// UML
Route::get('/diagrammes', function () {
    return view('uml');
});

require __DIR__.'/auth.php';
