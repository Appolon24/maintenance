<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheDepannage extends Model
{
    use HasFactory;
    protected $fillable = [
        'isclose',
        'user_id',
        'demande_depannage_id',
        'type',
        'observation',
        'maindoeuvre',
        'totalpiece',
        'total',
    ];
    public function demande() {
        return $this->belongsTo(DemandeDepannage::class, 'demande_depannage_id', 'id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
