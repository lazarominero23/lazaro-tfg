<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Pedido;
use App\Models\Resena;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'correo',
        'direccion',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'idUsuario');
    }

    public function resenas()
    {
        return $this->hasMany(Resena::class, 'idUsuario');
    }

    public $timestamps = false;
}
