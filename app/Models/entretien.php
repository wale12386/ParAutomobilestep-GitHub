<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entretien extends Model
{
    protected $table = 'entretiens';

    protected $primaryKey = 'identretien';
    protected $dates = ['dateE','archived_at'];

    protected $fillable = [
        'dateE',
        'kilométrage',
        'Matricule',
    ];

    public function voiture()
    {
        return $this->belongsTo('Voiture', 'Matricule', 'Matricule');
    }
}