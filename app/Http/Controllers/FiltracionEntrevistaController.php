<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FiltracionEntrevista;
use Illuminate\Support\Facades\Validator;

class FiltracionEntrevistaController extends Controller
{
    public function index()
    {
        $filtraciones = FiltracionEntrevista::all();
        return response()->json($filtraciones);
    }

    public function show($id)
    {
        $filtracion = FiltracionEntrevista::find($id);

        if (!$filtracion) {
            return response()->json(['error' => 'Filtración de Entrevista no encontrada'], 404);
        }

        return response()->json($filtracion);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plaza_trabajo_id' => 'required|exists:plazas_trabajos,id',
            'candidato_id' => 'required|exists:candidatos,id',
            'estatus' => 'required|in:Candidato contratado,Otro',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $filtracion = FiltracionEntrevista::create($request->all());

        return response()->json($filtracion, 201);
    }

    public function update(Request $request, $id)
    {
        $filtracion = FiltracionEntrevista::find($id);

        if (!$filtracion) {
            return response()->json(['error' => 'Filtración de Entrevista no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'plaza_trabajo_id' => 'exists:plazas_trabajos,id',
            'candidato_id' => 'exists:candidatos,id',
            'estatus' => 'in:Candidato contratado,Otro',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $filtracion->update($request->all());

        return response()->json($filtracion, 200);
    }

    public function destroy($id)
    {
        $filtracion = FiltracionEntrevista::find($id);

        if (!$filtracion) {
            return response()->json(['error' => 'Filtración de Entrevista no encontrada'], 404);
        }

        $filtracion->delete();

        return response()->json(null, 204);
    }
}
