<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Http\JsonResponse;


class UserController
{
    public function get_user_by_id($id)
    {
        // Asegurémonos de que $id sea un entero antes de continuar
        if (!is_int($id)) {
            // Si no es un entero, intentemos convertirlo a un entero
            $id = (int)$id;
        }

        // Lógica para obtener el usuario por su ID aquí...
    }
    public function edit_user_by_id($id)
{
    // Asegurémonos de que $id sea un entero antes de continuar
    if (!is_int($id)) {
        // Si no es un entero, intentemos convertirlo a un entero
        $id = (int)$id;
    }

    // Lógica para obtener el usuario por su ID
    $user = User::find($id);

    if ($user) {
        return response()->json(['user' => $user], 200);
    } else {
        return response()->json(['message' => 'User not found'], 404);
    }
}


    /**
     * Metodos para obtener los usuarios segun su rol
     */


    /*Metodo para obtener lo directivos*/
    public function index_directivo()
    {
        $users = User::select('id', 'name','apellido','apellidosegundo','rol')
        ->where('rol','directivo')
        ->orderBy('name')
        ->get();
        return response()->json(['users' => $users], 200);
    }

      /*Metodo para obtener lo entrenador*/
      public function index_entrenador()
      {
          $users = User::select('id', 'name','apellido','apellidosegundo','rol')
          ->where('rol','entrenador')
          ->orderBy('name')
          ->get();
          return response()->json(['users' => $users], 200);
      }
        /*Metodo para obtener lo atletasd*/
    public function index_atleta()
    {
        $users = User::select('id', 'name','apellido','apellidosegundo','rol')
        ->where('rol','atleta')
        ->orderBy('name')
        ->get();
        return response()->json(['users' => $users], 200);
    }



public function store(Request $request, User $user)
{
    try {
        // Validar la solicitud
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'apellidosegundo' => 'nullable|string|max:255',
            'categoria' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'rol' => 'nullable|string|max:50',
            'peso' => 'nullable|numeric|min:0',
            'altura' => 'nullable|numeric|min:0',
            'fechaNacimiento' => 'nullable|date',
        ]);

        // Convertir la fecha al formato adecuado
        if (isset($validatedData['fechaNacimiento'])) {
            try {
                $validatedData['fechaNacimiento'] = Carbon::parse($validatedData['fechaNacimiento'])->format('Y-m-d');
            } catch (\Exception $e) {
                return response()->json(['message' => 'Invalid date format'], 422);
            }
        }

        // Crear un nuevo usuario con los datos validados
        $user = User::create($validatedData);

        // Retornar la respuesta
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Si la validación falla, devolver un mensaje de error con los detalles
        return response()->json(['message' => 'La validación falló'], 422);
    } catch (\Exception $e) {
        // Si ocurre otro error, devolver un mensaje de error genérico
        return response()->json(['message' => 'User creation failed: ' . $e->getMessage()], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Buscar el usuario por ID
        $user = User::findOrFail($id);
    
        // Validar la solicitud
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'apellidosegundo' => 'nullable|string|max:255',
            'categoria' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8', // Permitimos que la contraseña sea opcional
            'rol' => 'nullable|string|max:50',
            'peso' => 'nullable|numeric|min:0',
            'altura' => 'nullable|numeric|min:0',
            'fechaNacimiento' => 'nullable|date',
        ]);

            // Convertir la fecha al formato adecuado
    if (isset($validatedData['fechaNacimiento'])) {
        try {
            $validatedData['fechaNacimiento'] = Carbon::parse($validatedData['fechaNacimiento'])->format('Y-m-d');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid date format'], 422);
        }
    }
    
        // Actualizar los campos del usuario solo si están presentes en la solicitud
        $user->fill($validatedData);
    

        // Guardar los cambios
        $user->save();
    
        // Retornar la respuesta
        return response()->json([
            'message' => 'User updated successfully'
        ], 200);
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Buscar el usuario por su ID
        $user = User::find($id);
    
        // Verificar si el usuario existe
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    
        // Eliminar el usuario
        try {
            $user->delete();
            return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el usuario: ' . $e->getMessage()], 500);
        }
    }
}
