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
        Schema::create('piece_detaches', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('modele')->nullable();
            $table->string('marque')->nullable();
            $table->integer('quantite');
            $table->float('price')->default(0);
            $table->float('price_sell')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piece_detaches');
    }
};
