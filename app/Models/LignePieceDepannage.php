<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LignePieceDepannage extends Model
{
    use HasFactory;
    protected $fillable = [
        'fiche_depannage_id',
        'piece_detache_id',
        'quantite',
    ];
    public function piece() {
        return $this->belongsTo(PieceDetache::class, 'piece_detache_id', 'id');
    }
    public function fiche() {
        return $this->belongsTo(FicheDepannage::class, 'fiche_depannage_id', 'id');
    }
}
