<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     
     public function up(): void
     {
         Schema::create('ventes', function (Blueprint $table) {
             $table->id();
             $table->foreignId('user_id')->constrained()->onDelete('cascade');      // Client
             $table->foreignId('livre_id')->constrained('livres')->onDelete('cascade'); // Livre vendu
             $table->integer('quantite');
             $table->decimal('prix_unitaire', 8, 2);
             $table->timestamp('date_vente')->useCurrent();
             $table->timestamps();
         });
     }
     
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
