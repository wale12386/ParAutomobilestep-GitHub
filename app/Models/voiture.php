<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class voiture extends Model
{
    use HasFactory;

    protected $table = 'voitures';

    protected $primaryKey = 'matricule';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'matricule',
        'photo',
        'couleur',
        'GPS',
        'Date_1ere_cerculation',
        'id_marque',
        'id_modele'
    ];
    
    protected $dates = [
        'created_at',
        'updated_at',   
        'Date_1ere_cerculation',
        'archived_at'

    ];

    public function marques()
    {
        return $this->belongsTo(Marques::class, 'id_marque');
    }
    public function conducteurs()
    {
        return $this->belongsToMany(Conducteur::class, 'affectation___voitures');
    }
    public function modele()
    {
        return $this->belongsTo(Modele::class, 'id_modele');
    }
}

?>