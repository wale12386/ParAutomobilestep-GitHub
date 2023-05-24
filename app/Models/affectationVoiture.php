<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class affectationVoiture extends Model
{
    use HasFactory;
    protected $table = 'affectation_voitures';
    protected $primaryKey = ['Matricule', 'CINC'];
    public $incrementing = false;
    protected $fillable = ['date_affectation', 'Matricule', 'CINC'];
    protected $dates = ['date_affectation','archived_at'];

    public function voiture()
    {
        return $this->belongsTo('App\Models\Voiture', 'Matricule');
    }

    public function conducteur()
    {
        return $this->belongsTo('App\Models\Conducteur', 'CINC');
    }
}
