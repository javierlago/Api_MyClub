<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
         // Recuperar el post con sus ejercicios
         $post = Post::with('ejercicios')->findOrFail($id);
         return response()->json($post);

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
