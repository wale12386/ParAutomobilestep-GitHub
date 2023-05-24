<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accidents extends Model
{
    use HasFactory;
    protected $primaryKey = 'idAccidant';
    public $timestamps = false;
    protected $dates = ['archived_at'];
    protected $fillable = [
        'idAccidant', 
        'dateA', 
        'Matricule', 
        'idconstat'
    ];
}
