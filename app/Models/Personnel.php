<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personnel extends Model
{
    use HasFactory;
    protected
        $fillable = [
            'job',
            'iduser',
        ];


    public function users()
    {
        return $this->belongsTo(Users::class, 'iduser');
    }
    public function taches()
    {
        return $this->hasMany(tache::class, 'idpers');
    }
}
