<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialAsignacion extends Model
{
    protected $table = 'historial_asignaciones';
    protected $fillable = [
        'plaza_trabajo_id',
        'analista_rrhh_id',
        'fecha_asignacion',
        'fecha_desasignacion',
    ];

    public function plazaTrabajo()
    {
        return $this->belongsTo(PlazaTrabajo::class);
    }

    public function analistaRRHH()
    {
        return $this->belongsTo(Usuario::class, 'analista_rrhh_id');
    }
}
