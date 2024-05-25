<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController
{
  /**
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

        // Verifica si se encontró un usuario y si la contraseña coincide
        if ($user && $user->password === $credentials['password']) {
            // Autenticación exitosa, devuelve el campo 'rol' del usuario
            return response()->json(['respuesta' => $user->rol,'id'=>$user->id]);
        }
        // Autenticación fallida
        return response()->json(['respuesta' => 'Credenciales inválidas']);
    }
    
}
