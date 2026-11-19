<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Models\Produto;
use App\Http\Controllers\PedidoController;


Route::get('/produtos', function () {
    $produtos = Produto::orderByDesc('id')->get();

    return view('produtos.produtos', compact('produtos'));
});

Route::get('/sobre', function () {
    return view('paginas.sobre');
});

Route::get('/', function () {
    
    $produtos = Produto::orderByDesc('id')->get();
    return view('paginas.inicio', compact('produtos'));
    });

    
Route::post('/logout', function () {
    session()->forget([
    'usuario_id', 
    'usuario_nome',
    'usuario_email',
    'usario_tipo'
    ]);
    return redirect('/');
    })->name('logout');
    

route::get('/carrinho', function () {
    return view('produtos.carrinho');
    });



Route::get('/celulares', function (\Illuminate\Http\Request $request) {

    $consulta = Produto::where('categoria', 'celulares');

    if ($request->filled('subcategoria')) {
        $consulta->where('subcategoria', $request->subcategoria);
    }

    $produtos = $consulta->orderByDesc('id')->get();

    return view('produtos.celulares', compact('produtos'));

});

Route::get('/acessorios', function () {

    $tipo = request('tipo_acessorio');

    $produtos = Produto::where('categoria', 'acessorios')
        ->when($tipo, function ($query) use ($tipo) {
            $query->where('tipo_acessorio', $tipo);
        })
        ->orderByDesc('id')
        ->get();

    return view('produtos.acessorios', compact('produtos'));

})->name('acessorios');

Route::get('/smartwatches', function () {
  
$marca = request('marca');

$produtos = Produto::where('categoria', 'smartwatches')
    ->when($marca, function ($query) use ($marca) {
        $query->where('marca', $marca);
    })
    ->get();

    return view('produtos.smartwatches', compact('produtos'));
}   );





Route::get('/contato', function () {
    return view('paginas.contato');
    });

Route::get('/localidade', function () {

    return view('paginas.localidade');
    });
    

Route::get('/login', [LoginController::class, 'mostrarLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'entrar']);


Route::get('/cadastro', [CadastroController::class, 'mostrarCadastro']);
Route::post('/cadastro', [CadastroController::class, 'cadastrar']);


// Painel administrativo
Route::prefix('admin')
    ->name('admin.')
    ->middleware(\App\Http\Middleware\AdminMiddleware::class)
    ->group(function () {
        Route::resource('produtos', ProdutoController::class);
    });

    Route::get('/finalizar-compra', [PedidoController::class, 'finalizar'])
    ->name('pedidos.finalizar');

Route::post('/pedidos', [PedidoController::class, 'salvar'])
    ->name('pedidos.salvar');