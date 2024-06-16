<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ejercicio;
use App\Models\Post;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ejercicio>
 */
class EjercicioFactory extends Factory
{
    protected $model = Ejercicio::class;

    public function definition()
    {
        return [
            'postId' => Post::factory(), // Crea un nuevo Post y asócialo
            'nombre' => $this->faker->randomElement(['Ergometro', 'Pesas', 'Carrera']),
            'descripcionUnidades' => $this->faker->randomElement(['Metros', 'Rondas', 'Minutos', 'Repeticiones']),
            'intensidad' => $this->faker->randomElement(['Baja', 'Media', 'Alta']),
            'serie' => $this->faker->numberBetween(1, 5),
            'unidades' => $this->faker->numberBetween(10, 30),
        ];
    }
}
