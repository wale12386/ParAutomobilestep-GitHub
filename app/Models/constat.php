<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constat extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_constat';
    protected $fillable = ['date_c', 'lieu_c', 'matriculev', 'assurancev', 'vehicule_id'];
    protected $guarded = ['id_constat', 'created_at', 'updated_at'];
    protected $dates = ['date_c','archived_at'];

    public function vehicule()
    {
        return $this->belongsTo(Voiture::class, 'vehicule_id', 'matricule');
    }
}