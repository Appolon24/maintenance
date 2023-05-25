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
        Schema::create('ligne_piece_depannages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiche_depannage_id')->constrained()->cascadeOnDelete();
            $table->foreignId('piece_detache_id')->constrained()->cascadeOnDelete();
            $table->integer('quantite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligne_piece_depannages');
    }
};
