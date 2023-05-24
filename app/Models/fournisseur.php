<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Fournisseur extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_fournisseur';
    protected $dates = ['archived_at'];

    protected $fillable = [
        'raison',
        'adresse',
        'téléphone',
    ];
}