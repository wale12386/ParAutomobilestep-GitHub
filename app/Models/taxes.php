<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class taxes extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_taxe';
    protected $dates = ['date_taxe','archived_at'];

    protected $fillable = [
        'date_taxe',
        'Matricule'
    ];

    public function voiture()
    {
        return $this->belongsTo(Voiture::class, 'Matricule', 'Matricule');
    }
}
