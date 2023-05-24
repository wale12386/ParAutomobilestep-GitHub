<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conducteurs extends Model
{
    use HasFactory;
    protected $table = 'conducteurs';
    protected $primaryKey = 'CINC';
    public $incrementing = false;
    protected $fillable = ['CINC', 'nom', 'prenom', 'adresse', 'date_naissance', 'photo', 'telephone', 'email', 'password'];
    protected $hidden = ['password'];
    protected $dates = ['date_naissance','archived_at'];

    public function affectations()
    {
        return $this->hasMany('App\Models\AffectationVoiture', 'CINC');
    }
    public function voitures()
    {
        return $this->belongsToMany(Voiture::class, 'affectation___voitures');
    }
}
