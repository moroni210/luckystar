<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'nome_cliente',
        'email',
        'telefone',
        'endereco',
        'subtotal',
        'frete',
        'total',
        'status',
    ];

   public function itens()
{
    return $this->hasMany(PedidoItem::class, 'pedido_id');
}
}