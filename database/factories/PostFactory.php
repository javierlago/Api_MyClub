<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence,
            'descripcion' => $this->faker->paragraph,
            'fecha' => $this->faker->date,
        ];
    }

    public function aviso()
{
    return $this->state([
        'titulo' => 'aviso',
    ]);
}

}
