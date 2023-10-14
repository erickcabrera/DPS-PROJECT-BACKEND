<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;
use Illuminate\Support\Facades\Validator;

class CandidatoController extends Controller
{
    public function index()
    {
        $candidatos = Candidato::all();
        return response()->json($candidatos);
    }

    public function show($id)
    {
        // Buscar el candidato por ID
        $candidato = Candidato::find($id);

        // Verificar si el candidato existe
        if (!$candidato) {
            return response()->json(['error' => 'Candidato no encontrado'], 404);
        }

        // Devolver el candidato encontrado
        return response()->json($candidato);
    }

    public function store(Request $request)
    {
        // Validar los datos del request
        $validator = Validator::make($request->all(), [
            'nombre_candidato' => 'required|string|max:255|unique:candidatos',
            'fecha_nacimiento' => 'nullable|date',
            'telefono' => 'nullable|string|max:15|unique:candidatos',
            'correo_electronico' => 'required|email|max:255|unique:candidatos',
            'residencia' => 'nullable|string|max:255',
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Crear el candidato si la validación pasa
        $candidato = Candidato::create($request->all());

        // Devolver la respuesta JSON con el candidato creado
        return response()->json($candidato, 201);
    }

    public function update(Request $request, $id)
    {
        $candidato = Candidato::find($id);

        if (!$candidato) {
            return response()->json(['error' => 'Candidato no encontrado'], 404);
        }

        $candidato->update($request->all());
        return response()->json($candidato, 200);
    }

    public function destroy($id)
    {
        // Buscar el candidato por ID
        $candidato = Candidato::find($id);

        // Verificar si el candidato existe
        if (!$candidato) {
            return response()->json(['error' => 'Candidato no encontrado'], 404);
        }

        try {
            // Eliminar el candidato
            $candidato->delete();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            // Manejo de Errores y Excepciones
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }
}
