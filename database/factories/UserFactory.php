<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'apellido' =>fake()->lastName(),
            'apellidosegundo' =>fake()->lastName(),
            'telefono'=>fake()->randomNumber(9,true),
            'fechaNacimiento'=>fake()->date('Y-m-d','now'),
            'peso'=> null,
            'altura'=>null,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Str::random(10),
            'remember_token' => Str::random(10),
            'rol'=>'directivo'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    public function crearAtleta(): static
    {
        return $this->state(fn (array $attributes) => [
            'rol' => 'atleta',
            'peso'=>fake()->randomFloat(2, 60, 100),
            'altura'=>fake()->randomFloat(2, 1.5, 2),
        ]);
    }
    
    public function crearEntrenador(): static
    {
        return $this->state(fn (array $attributes) => [
            'rol' =>'entrenador',
            'peso'=>null,
            'altura'=>null,
        ]);
    }
}
/// Para crear user usar el comando desde tinker
/* 
php artisan tinker
App/Models/User::factory()->create()
Luego usar otro metodo para crear con unos parametros especificos
como por ejemplo
App\Models\User::factory()->crearAtleta()->create();

Ver capitulo 10 dondes se crean los factorys


*/