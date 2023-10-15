<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistorialAsignacion;
use Illuminate\Support\Facades\Validator;

class HistorialAsignacionController extends Controller
{
    public function index()
    {
        $historialAsignaciones = HistorialAsignacion::all();
        return response()->json($historialAsignaciones);
    }

    public function show($id)
    {
        $historialAsignacion = HistorialAsignacion::find($id);

        if (!$historialAsignacion) {
            return response()->json(['error' => 'Historial de Asignación no encontrado'], 404);
        }

        return response()->json($historialAsignacion);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plaza_trabajo_id' => 'required|exists:plazas_trabajos,id',
            'analista_rrhh_id' => 'required|exists:usuarios,id',
            'fecha_asignacion' => 'required|date',
            'fecha_desasignacion' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $historialAsignacion = HistorialAsignacion::create($request->all());

        return response()->json($historialAsignacion, 201);
    }

    public function update(Request $request, $id)
    {
        $historialAsignacion = HistorialAsignacion::find($id);

        if (!$historialAsignacion) {
            return response()->json(['error' => 'Historial de Asignación no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'plaza_trabajo_id' => 'exists:plazas_trabajos,id',
            'analista_rrhh_id' => 'exists:usuarios,id',
            'fecha_asignacion' => 'date',
            'fecha_desasignacion' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $historialAsignacion->update($request->all());

        return response()->json($historialAsignacion, 200);
    }

    public function destroy($id)
    {
        $historialAsignacion = HistorialAsignacion::find($id);

        if (!$historialAsignacion) {
            return response()->json(['error' => 'Historial de Asignación no encontrado'], 404);
        }

        $historialAsignacion->delete();

        return response()->json(null, 204);
    }
}
