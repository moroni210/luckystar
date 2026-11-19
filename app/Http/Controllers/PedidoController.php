<?php

namespace App\Http\Controllers;


use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PedidoController extends Controller
{
    public function finalizar()
    {
        if (!session()->has('usuario_id')) {
            return redirect('/login');
        }

        return view('pedidos.finalizar-compra');
    }

    public function salvar(Request $request)
    {
        if (!session()->has('usuario_id')) {
            return redirect('/login');
        }

        $dados = $request->validate([
            'nome_cliente' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefone' => 'required|string|max:30',
            'endereco' => 'required|string',
            'itens' => 'required|json',
        ]);

        $itens = json_decode($dados['itens'], true);

        if (!is_array($itens) || empty($itens)) {
            throw ValidationException::withMessages([
                'itens' => 'Seu carrinho está vazio.',
            ]);
        }

        $pedido = DB::transaction(function () use ($dados, $itens) {

            $subtotal = 0;
            $produtosPedido = [];

            foreach ($itens as $item) {

                $id = filter_var(
                    $item['id'] ?? null,
                    FILTER_VALIDATE_INT
                );

                $quantidade = filter_var(
                    $item['quantidade'] ?? null,
                    FILTER_VALIDATE_INT
                );

                if (!$id || !$quantidade || $quantidade < 1) {
                    throw ValidationException::withMessages([
                        'itens' => 'Produto ou quantidade inválida.',
                    ]);
                }

                $produto = \App\Models\Produto::where('id', $id)
                    ->lockForUpdate()
                    ->first();

                if (!$produto) {
                    throw ValidationException::withMessages([
                        'itens' => 'Produto não encontrado.',
                    ]);
                }

                if ($quantidade > $produto->estoque) {
                    throw ValidationException::withMessages([
                        'itens' => 'Estoque insuficiente para ' . $produto->nome,
                    ]);
                }

                $preco = (float) $produto->preco;

                $subtotal += $preco * $quantidade;

                $produtosPedido[] = [
                    'produto' => $produto,
                    'quantidade' => $quantidade,
                    'preco' => $preco,
                ];
            }

            $pedido = \App\Models\Pedido::create([
                'usuario_id' => session('usuario_id'),
                'nome_cliente' => $dados['nome_cliente'],
                'email' => $dados['email'] ?? null,
                'telefone' => $dados['telefone'],
                'endereco' => $dados['endereco'],
                'subtotal' => $subtotal,
                'frete' => 0,
                'total' => $subtotal,
                'status' => 'aguardando',
            ]);

            foreach ($produtosPedido as $item) {

                \App\Models\PedidoItem::create([
                    'pedido_id' => $pedido->id,
                    'produto_id' => $item['produto']->id,
                    'nome_produto' => $item['produto']->nome,
                    'quantidade' => $item['quantidade'],
                    'preco' => $item['preco'],
                ]);

                $item['produto']->estoque -= $item['quantidade'];
                $item['produto']->save();
            }

            return $pedido;
        });

        $pedido->load('itens');

        $whatsappNumero = '';

        $mensagem = "Olá! Gostaria de confirmar meu pedido na LuckStar.\n";
        $mensagem .= "Pedido: #" . $pedido->id . "\n";
        $mensagem .= "Cliente: " . $pedido->nome_cliente . "\n";

        foreach ($pedido->itens as $item) {
            $mensagem .= "\n" . $item->nome_produto;
            $mensagem .= " - Quantidade: " . $item->quantidade;
        }

        $mensagem .= "\nTotal: R$ " .
            number_format($pedido->total, 2, ',', '.');

        $whatsappUrl = 'https://wa.me/75981691080' .
            $whatsappNumero .
            '?text=' . urlencode($mensagem);

        return view('pedidos.confirmado', compact(
            'pedido',
            'whatsappUrl'
        ));
    }
}