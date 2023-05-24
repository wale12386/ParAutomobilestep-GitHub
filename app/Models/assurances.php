<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assurances extends Model
{
    protected $table = 'assurances';
    
    protected $dates = ['dateAssur','archived_at'];
    protected $primaryKey = 'id_assurance';
    protected $fillable = [
        'dateAssur',
        'contratAssur',
        'Matricule',
    ];

    public function voiture()
    {
        return $this->belongsTo(Voiture::class, 'Matricule');
    }
}
