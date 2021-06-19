<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tache extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'statut',
        'datedeb',
        'datefin',
        'idpr',
        'idpers',
    ];


    public function personnels()
    {
        return $this->belongsTo(Personnel::class);
    }
    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
}
