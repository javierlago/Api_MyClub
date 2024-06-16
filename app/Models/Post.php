<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'post';

    protected $fillable = [
        'titulo', 'descripcion', 'fecha',
    ];

    // Relación uno a muchos con Ejercicio
    public function ejercicios()
    {
        return $this->hasMany(Ejercicio::class, 'postId');
    }

}
