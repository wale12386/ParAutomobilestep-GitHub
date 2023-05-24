<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Echange extends Model
{
    protected $table = 'echanges';
    protected $primaryKey = 'idechange';
    public $timestamps = true;
    protected $dates = ['dateEch','archived_at'];

    protected $fillable = [
        'dateEch',
        'kilometrage',
        'Niveaucarburant',
        'accidentelle',
        'conducteur1',
        'conducteur2',
        'Matricule',
    ];

    public function voiture()
    {
        return $this->belongsTo(Voiture::class, 'Matricule', 'Matricule');
    }
}