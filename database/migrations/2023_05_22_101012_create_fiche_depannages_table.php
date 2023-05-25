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
        Schema::create('fiche_depannages', function (Blueprint $table) {
            $table->id();
            $table->text('observation')->nullable();
            $table->boolean('isclose')->default(false);
            $table->float('maindoeuvre')->default(0);
            $table->float('totalpiece')->default(0);
            $table->float('total')->default(0);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('demande_depannage_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiche_depannages');
    }
};
