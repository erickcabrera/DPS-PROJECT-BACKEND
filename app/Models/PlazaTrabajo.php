<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlazaTrabajo extends Model
{
    protected $table = 'plazas_trabajos';

    protected $fillable = [
        'nombre_plaza',
        'propuesta_id',
        'usuario_recurso_humanos_id',
        'salario',
        'cantidad_solicitada',
        'fecha_recepcion_validacion_perfil',
        'fecha_modificacion_perfil',
        'fecha_publicacion_perfil',
        'estatus',
        'fecha_finalizacion',
    ];

    public function propuesta()
    {
        return $this->belongsTo(Propuesta::class);
    }

    public function usuarioRecursoHumanos()
    {
        return $this->belongsTo(Usuario::class, 'usuario_recurso_humanos_id');
    }
}
