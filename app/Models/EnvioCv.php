<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvioCv extends Model
{
    protected $table = 'envio_cvs';
    protected $fillable = [
        'plaza_trabajo_id',
        'candidato_id',
        'fecha_envio_cv',
        'numero_terna',
    ];

    public function plazaTrabajo()
    {
        return $this->belongsTo(PlazaTrabajo::class);
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class);
    }
}
