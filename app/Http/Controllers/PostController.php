<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Ejercicio;

class PostController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Cargar todos los posts con sus ejercicios
         return Post::with('ejercicios')->get();
    }
    // Cargar todos los posts que no tienen ejercicios asociados
    public function indexWithoutExercises()
    {
        return Post::doesntHave('ejercicios')->get();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos
            $validatedData = $request->validate([
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'fecha' => 'required|string',
            ]);

            // Convertir la fecha al formato adecuado
            try {
                $validatedData['fecha'] = Carbon::parse($validatedData['fecha'])->format('Y-m-d');
            } catch (\Exception $e) {
                return response()->json(['message' => 'Invalid date format'], 422);
            }

            // Crear el nuevo post
            $post = Post::create($validatedData);

            // Retornar la respuesta
            return response()->json([
                'message' => 'Post guardado correctamente',
                'post' => $post
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Si la validación falla, devolver un mensaje de error con los detalles
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Si ocurre otro error, devolver un mensaje de error genérico
            return response()->json(['message' => 'Post creation failed: ' . $e->getMessage()], 500);
        }
    }
    public function storeWithExercises(Request $request)
    {
        try {
            // Validar los datos
            $validatedData = $request->validate([
                'titulo' => 'required|string|max:255',
                'descripcion' => 'nullable|string',
                'fecha' => 'required|string',
                'ejercicios' => 'required|array',
                'ejercicios.*.nombre' => 'required|string|max:255',
                'ejercicios.*.descripcionUnidades' => 'required|string', // Agregamos la validación
                'ejercicios.*.intensidad' => 'required|string', // Agregamos la validación
                'ejercicios.*.serie' => 'required|integer', // Agregamos la validación
                'ejercicios.*.unidades' => 'required|integer', // Agregamos la validación
            ]);
    
            // Convertir la fecha al formato adecuado
            try {
                $validatedData['fecha'] = Carbon::parse($validatedData['fecha'])->format('Y-m-d');
            } catch (\Exception $e) {
                return response()->json(['message' => 'Invalid date format'], 422);
            }
    
            // Crear el nuevo post
            $post = Post::create($validatedData);
    
            // Crear los ejercicios y asociarlos con el post
            foreach ($validatedData['ejercicios'] as $ejercicioData) {
                $ejercicio = new Ejercicio($ejercicioData);
                $post->ejercicios()->save($ejercicio);
            }
    
            // Retornar la respuesta
            return response()->json([
                'message' => 'Entrenamiento guardado',
                'post' => $post->load('ejercicios') // Cargar los ejercicios con el post
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Si la validación falla, devolver un mensaje de error con los detalles
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Si ocurre otro error, devolver un mensaje de error genérico
            return response()->json(['message' => 'Post and exercises creation failed: ' . $e->getMessage()], 500);
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
         

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
