<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    use HasFactory;

    protected $table = 'modeles';

    protected $primaryKey = 'idmodele';
    protected $dates = ['archived_at'];

    protected $fillable = ['libellemodele', 'id_marque'];

    public function marques()
    
    {
        return $this->belongsTo(Marques::class, 'id_marque');
    }

}
