<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Vidange extends Model
{
    use HasFactory;

    protected $table = 'vidanges';

    protected $primaryKey = 'idvidenge';
    protected $dates = ['archived_at'];

    protected $fillable = [
        'kilométrage',
        'montant',
        'Matricule',
        'id_fournisseur',
    ];

    public function voiture()
    {
        return $this->belongsTo(Voiture::class, 'Matricule', 'Matricule');
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'id_fournisseur', 'id_fournisseur');
    }
}
