<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{


   /*
     * Verifica las credenciales del usuario sin hashear la contraseña.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Busca al usuario por su correo electrónico
    $user = User::where('email', $credentials['email'])->first();

    // Verifica si se encontró un usuario
    if (!$user) {
        // Correo electrónico no encontrado
        return response()->json(['respuesta' => 'Correo electrónico no encontrado']);
    }

    // Verifica si la contraseña coincide
    if ($user->password !== $credentials['password']) {
        // Contraseña incorrecta
        return response()->json(['respuesta' => 'Contraseña incorrecta']);
    }

    // Autenticación exitosa, devuelve el campo 'rol' del usuario
    return response()->json(['respuesta' => $user->rol,'id'=>$user->id]);
}

}


