<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model as EloquentModel;



class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string|max:255|unique:usuarios',
            'contrasena' => 'required|string|min:8',
            'rol' => 'required|in:Comercial,RRHH,Administrador',
        ]);

        $usuario = Usuario::create([
            'nombre_usuario' => $request->nombre_usuario,
            'contrasena' => Hash::make($request->contrasena),
            'rol' => $request->rol,
        ]);

        $token = $usuario->createToken('app-token')->accessToken;

        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nombre_usuario', 'contrasena');

        // Obtener el usuario por nombre de usuario
        $user = Usuario::where('nombre_usuario', $credentials['nombre_usuario'])->first();

        if ($user && Hash::check($credentials['contrasena'], $user->contrasena)) {
            // Las credenciales son válidas
            $token = $user->createToken('app-token')->accessToken;

            // Dependiendo del rol, puedes retornar diferentes datos
            if ($user->rol === 'Administrador') {
                return response()->json(['token' => $token, 'rol' => 'Administrador']);
            } elseif ($user->rol === 'Comercial') {
                return response()->json(['token' => $token, 'rol' => 'Comercial']);
            } elseif ($user->rol === 'RRHH') {
                return response()->json(['token' => $token, 'rol' => 'RRHH']);
            }

            // Retorno predeterminado si no se encuentra el rol
            return response()->json(['token' => $token, 'rol' => 'Usuario']);
        }

        return response()->json(['error' => 'Credenciales incorrectas'], 401);
    }
}
