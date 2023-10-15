<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'FechaEnvioPropuesta',
        'UsuarioEjecutivoComercialID',
        'ClienteID',
        'TipoPropuestaEnviada',
        'MontoPropuesta',
        'Descuento',
        'EstadoPropuesta',
        'FechaActualizacionSeguimiento',
        'ComentariosSeguimiento',
    ];

    public function usuarioEjecutivoComercial()
    {
        return $this->belongsTo(Usuario::class, 'UsuarioEjecutivoComercialID');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'ClienteID');
    }
}
