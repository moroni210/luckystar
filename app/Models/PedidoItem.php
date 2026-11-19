<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;

class PedidoItem extends Model
{
    protected $table = 'pedido_itens';

    public $timestamps = false;

    protected $fillable = [
        'pedido_id',
        'produto_id',
        'nome_produto',
        'quantidade',
        'preco',
    ];

   public function pedido()
{
    return $this->belongsTo('App\\Models\\Pedido', 'pedido_id');
}
}