<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marques extends Model
{
    use HasFactory;
    protected $table = 'marques';

    protected $primaryKey = 'idmarque';

    public $incrementing = true;

    protected $fillable = [
        'libellemarque'
    ];
  

    protected $dates = [
        'created_at',
        'updated_at',
        'archived_at'
    ];

    public function voitures()
    {
        return $this->hasMany(Voiture::class, 'id_marque');
    }  
    public function modele()
    {
        return $this->hasMany(Modele::class, 'id_modele');
    }
}

   

