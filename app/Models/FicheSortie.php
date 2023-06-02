<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheSortie extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'fiche_depannage_id',
        'date_sortie',
        'status',
    ];
    public function fiche_depannage() {
        return $this->belongsTo(FicheDepannage::class, 'fiche_depannage_id', 'id');
    }
}
