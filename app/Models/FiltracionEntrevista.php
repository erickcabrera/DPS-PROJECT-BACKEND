<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FiltracionEntrevista extends Model
{
    protected $fillable = [
        'plaza_trabajo_id',
        'candidato_id',
        'estatus',
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
