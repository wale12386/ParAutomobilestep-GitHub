<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class VisiteTechnique extends Model
{
    use HasFactory;

    protected $table = 'visites_techniques';
    protected $primaryKey = 'idvisite';
    protected $dates = ['datev','archived_at'];
  

    protected $fillable = [
        'datev',
        'resultatv',
        'description',
        'Matricule'
    ];

    public function voiture()
    {
        return $this->belongsTo(Voiture::class, 'Matricule');
    }
}