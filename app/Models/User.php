<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Commercial;
use App\Models\Admin;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'email_verified_at',
        'password',
        'phone',
        'daten',
        'adress',
        'role',
        'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function commercial()
    {
        return $this->hasOne(Commercial::class, 'iduser');
    }
    public function client()
    {
        return $this->hasOne(Client::class, 'iduser');
    }
    public function admin()
    {
        return $this->hasOne(Admin::class, 'iduser');
    }
    public function personnel()
    {
        return $this->hasOne(Personnel::class, 'iduser');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'idem');
    }
}
