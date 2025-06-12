<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'idUsuario',
        'fecha',
        'precio_total',
    ];

    // public function detalles()
    // {
    //     return $this->hasMany(DetallePedido::class, 'id_pedido');
    // }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'idPedido');
    }

    public $timestamps = true;
}