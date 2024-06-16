<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use HasFactory;

    protected $table = 'ejercicio';

    protected $fillable = [
        'postId', 'nombre', 'descripcionUnidades', 'intensidad', 'serie', 'unidades',
    ];

    // Relación inversa con Post
    public function post()
    {
        return $this->belongsTo(Post::class, 'postId');
    }



    
}
