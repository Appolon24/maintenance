<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PieceDetache extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'modele',
        'marque',
        'quantite',
        'price',
        'price_sell',
    ];
}
