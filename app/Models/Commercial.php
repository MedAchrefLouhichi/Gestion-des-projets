<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Projet;

class Commercial extends Model
{
    use HasFactory;

    protected $fillable = [
        'iduser',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function projets()
    {
        return $this->hasMany(Projet::class, 'idcomm');
    }
}
