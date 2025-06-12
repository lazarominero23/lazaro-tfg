<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{   
    use HasFactory;

    protected $table = 'resenas';

    protected $fillable = [
        'idUsuario',
        'idProducto',
        'puntuacion',
        'comentario',
    ];

    public $timestamps = true;

    // Relación con el usuario que hizo la reseña
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    // Relación con el producto reseñado
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }
}
