<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Ejercicio;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
               // Crear 10 usuarios generales
               User::factory()->count(10)->create();

               // Crear 10 usuarios con el rol de 'atleta'
               User::factory()->crearAtleta()->count(10)->create();
       
               // Crear 5 usuarios con el rol de 'entrenador'
               User::factory()->crearEntrenador()->count(5)->create();
       

              // Crear 10 posts cada uno con 5 ejercicios
              Post::factory()
              ->count(10)
              ->has(Ejercicio::factory()->count(5), 'ejercicios')
              ->create();
    }
}
