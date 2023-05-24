<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparation extends Model
{
    use HasFactory;

    protected $primaryKey = 'idreparation';
    protected $dates = ['dateR','archived_at'];

    protected $fillable = [
        'dateR',
        'montant',
        'dégât',
        'Matricule',
        'id_fournisseur'
    ];

    public function voiture()
    {
        return $this->belongsTo(Voiture::class, 'Matricule', 'Matricule');
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'id_fournisseur');
    }
}