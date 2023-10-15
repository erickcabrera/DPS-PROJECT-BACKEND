<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnvioCv;
use Illuminate\Support\Facades\Validator;

class EnvioCvController extends Controller
{
    public function index()
    {
        $enviosCv = EnvioCv::all();
        return response()->json($enviosCv);
    }

    public function show($id)
    {
        $envioCv = EnvioCv::find($id);

        if (!$envioCv) {
            return response()->json(['error' => 'Envío de CV no encontrado'], 404);
        }

        return response()->json($envioCv);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plaza_trabajo_id' => 'required|exists:plazas_trabajos,id',
            'candidato_id' => 'required|exists:candidatos,id',
            'fecha_envio_cv' => 'required|date',
            'numero_terna' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $envioCv = EnvioCv::create($request->all());

        return response()->json($envioCv, 201);
    }

    public function update(Request $request, $id)
    {
        $envioCv = EnvioCv::find($id);

        if (!$envioCv) {
            return response()->json(['error' => 'Envío de CV no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'plaza_trabajo_id' => 'exists:plazas_trabajo,id',
            'candidato_id' => 'exists:candidatos,id',
            'fecha_envio_cv' => 'date',
            'numero_terna' => 'string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $envioCv->update($request->all());

        return response()->json($envioCv, 200);
    }

    public function destroy($id)
    {
        $envioCv = EnvioCv::find($id);

        if (!$envioCv) {
            return response()->json(['error' => 'Envío de CV no encontrado'], 404);
        }

        $envioCv->delete();

        return response()->json(null, 204);
    }
}
