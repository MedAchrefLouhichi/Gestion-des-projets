<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Commercial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projet extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'type',
        'descrtiption',
        'datedeb',
        'datefin',
        'avance',
        'idcl',
        'idcomm',

    ];

    public function commercial()
    {
        return $this->belongsTo(Commercial::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function taches()
    {
        return $this->hasMany(tache::class, 'idpr');
    }
}
