<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_candidato',
        'fecha_nacimiento',
        'telefono',
        'correo_electronico',
        'residencia',
    ];
}
