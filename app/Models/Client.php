<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'iduser'
    ];
    public function users()
    {
        return $this->belongsTo(Users::class, 'iduser');
    }
    public function projets()
    {
        return $this->hasMany(Projet::class, 'idcl');
    }
}
