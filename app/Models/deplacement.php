<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deplacement extends Model
{
    protected $table = 'deplacements';
    protected $primaryKey = 'id_deplacement';
    public $timestamps = true;
    protected $dates = ['archived_at'];

    protected $fillable = [
        'destination',
        'kilometrage',
        'qte_carburant',
        'Matricule',
        'CINC'
    ];

    public function conducteur()
    {
        return $this->belongsTo(Conducteur::class, 'CINC', 'CINC');
    }

    public function voiture()
    {
        return $this->belongsTo(Voiture::class, 'Matricule', 'matricule');
    }
}





