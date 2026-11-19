<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    protected $table = 'carrinhos';

    protected $fillable = [
        'usuario_id',
        'produto_id',
        'quantidade',
        'preco',
    ];

    public $timestamps = true;
}
