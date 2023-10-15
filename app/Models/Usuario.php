<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;


class Usuario extends Model
{
    use HasApiTokens, Notifiable;



    protected $fillable = [
        'nombre_usuario',
        'contrasena',
        'rol',
    ];
}
