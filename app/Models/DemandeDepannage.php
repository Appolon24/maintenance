<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeDepannage extends Model
{
    const ENVOYE="ENVOYE";
    const REPARATION="REPARATION";
    const COMPLETED="COMPLETE";
    const ANNULER="ANNULER";
    use HasFactory;
    protected $fillable = [
        'datecreation',
        'description',
        'user_id',
        'machine_id',
        'status',
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function machine() {
        return $this->belongsTo(Machine::class, 'machine_id', 'id');
    }
}
