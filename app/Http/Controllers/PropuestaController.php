<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propuesta;
use Illuminate\Support\Facades\Validator;

class PropuestaController extends Controller
{
    public function index()
    {
        $propuestas = Propuesta::with('usuarioEjecutivoComercial', 'cliente')->get();
        return response()->json($propuestas);
    }

    public function show($id)
    {
        $propuesta = Propuesta::with('usuarioEjecutivoComercial', 'cliente')->find($id);

        if (!$propuesta) {
            return response()->json(['error' => 'Propuesta no encontrada'], 404);
        }

        return response()->json($propuesta);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'FechaEnvioPropuesta' => 'required|date',
            'UsuarioEjecutivoComercialID' => 'required|exists:usuarios,id',
            'ClienteID' => 'required|exists:clientes,id',
            'TipoPropuestaEnviada' => 'required|string|max:255',
            'MontoPropuesta' => 'required|numeric',
            'Descuento' => 'required|numeric',
            'EstadoPropuesta' => 'required|in:Pendiente,En Proceso,Ganada,Perdida,Otro',
            'FechaActualizacionSeguimiento' => 'nullable|date',
            'ComentariosSeguimiento' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $propuesta = Propuesta::create($request->all());

        return response()->json($propuesta, 201);
    }

    public function update(Request $request, $id)
    {
        $propuesta = Propuesta::find($id);

        if (!$propuesta) {
            return response()->json(['error' => 'Propuesta no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'FechaEnvioPropuesta' => 'sometimes|required|date',
            'UsuarioEjecutivoComercialID' => 'sometimes|required|exists:usuarios,id',
            'ClienteID' => 'sometimes|required|exists:clientes,id',
            'TipoPropuestaEnviada' => 'sometimes|required|string|max:255',
            'MontoPropuesta' => 'sometimes|required|numeric',
            'Descuento' => 'sometimes|required|numeric',
            'EstadoPropuesta' => 'sometimes|required|in:Pendiente,En Proceso,Ganada,Perdida,Otro',
            'FechaActualizacionSeguimiento' => 'sometimes|nullable|date',
            'ComentariosSeguimiento' => 'sometimes|nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $propuesta->update($request->all());

        return response()->json($propuesta, 200);
    }

    public function destroy($id)
    {
        $propuesta = Propuesta::find($id);

        if (!$propuesta) {
            return response()->json(['error' => 'Propuesta no encontrada'], 404);
        }

        $propuesta->delete();

        return response()->json(null, 204);
    }
}
