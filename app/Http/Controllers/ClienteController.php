<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    public function show($id)
    {
        // Buscar el cliente por ID
        $cliente = Cliente::find($id);

        // Verificar si el cliente existe
        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        // Devolver el cliente encontrado
        return response()->json($cliente);
    }

    public function store(Request $request)
    {
        // Validar los datos del request
        $validator = Validator::make($request->all(), [
            'nombre_empresa' => 'required|string|max:255|unique:clientes',
            'rubro' => 'nullable|string|max:255',
            'nombre_contacto' => 'required|string|max:255',
            'telefono' => 'required|string|max:15|unique:clientes',
            'correo_electronico' => 'required|email|max:255|unique:clientes',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Crear el cliente si la validación pasa
        $cliente = Cliente::create($request->all());

        // Devolver la respuesta JSON con el cliente creado
        return response()->json($cliente, 201);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        $cliente->update($request->all());
        return response()->json($cliente, 200);
    }

    public function destroy($id)
    {
        // Buscar el cliente por ID
        $cliente = Cliente::find($id);

        // Verificar si el cliente existe
        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        try {
            // Eliminar el cliente
            $cliente->delete();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            // Manejo de Errores y Excepciones
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }
}
