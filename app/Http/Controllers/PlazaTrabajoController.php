<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlazaTrabajo;
use Illuminate\Support\Facades\Validator;

class PlazaTrabajoController extends Controller
{
    public function index()
    {
        $plazasTrabajo = PlazaTrabajo::all();
        return response()->json($plazasTrabajo);
    }

    public function show($id)
    {
        $plazaTrabajo = PlazaTrabajo::find($id);

        if (!$plazaTrabajo) {
            return response()->json(['error' => 'Plaza de Trabajo no encontrada'], 404);
        }

        return response()->json($plazaTrabajo);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_plaza' => 'required|string|max:255',
            'propuesta_id' => 'required|exists:propuestas,id',
            'usuario_recurso_humanos_id' => 'required|exists:usuarios,id',
            'salario' => 'required|numeric',
            'cantidad_solicitada' => 'required|integer',
            'fecha_recepcion_validacion_perfil' => 'nullable|date',
            'fecha_modificacion_perfil' => 'nullable|date',
            'fecha_publicacion_perfil' => 'nullable|date',
            'estatus' => 'required|in:Cerrado,Cancelado,Otro',
            'fecha_finalizacion' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $plazaTrabajo = PlazaTrabajo::create($request->all());

        return response()->json($plazaTrabajo, 201);
    }

    public function update(Request $request, $id)
    {
        $plazaTrabajo = PlazaTrabajo::find($id);

        if (!$plazaTrabajo) {
            return response()->json(['error' => 'Plaza de Trabajo no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_plaza' => 'string|max:255',
            'propuesta_id' => 'exists:propuestas,id',
            'usuario_recurso_humanos_id' => 'exists:usuarios,id',
            'salario' => 'numeric',
            'cantidad_solicitada' => 'integer',
            'fecha_recepcion_validacion_perfil' => 'nullable|date',
            'fecha_modificacion_perfil' => 'nullable|date',
            'fecha_publicacion_perfil' => 'nullable|date',
            'estatus' => 'in:Cerrado,Cancelado,Otro',
            'fecha_finalizacion' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $plazaTrabajo->update($request->all());

        return response()->json($plazaTrabajo, 200);
    }

    public function destroy($id)
    {
        $plazaTrabajo = PlazaTrabajo::find($id);

        if (!$plazaTrabajo) {
            return response()->json(['error' => 'Plaza de Trabajo no encontrada'], 404);
        }

        $plazaTrabajo->delete();

        return response()->json(null, 204);
    }
}
