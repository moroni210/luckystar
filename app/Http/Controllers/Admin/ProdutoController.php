<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    // Listar produtos
    public function index()
    {
        $produtos = Produto::orderByDesc('id')->get();

        return view('admin.produtos.index', compact('produtos'));
    }

    // Mostrar formulário de cadastro
    public function create()
    {
        return view('admin.produtos.criar');
    }

    // Salvar produto no banco
    public function store(Request $request)
    {
       $dados = $request->validate([
    'nome' => 'required|string|max:255',
    'descricao' => 'required|string',
    'preco' => 'required|numeric|min:0',
    'imagem' => 'nullable|image|max:2048',
    'categoria' => 'required|string|max:100',
    'estoque' => 'required|integer|min:0',
    'subcategoria' => 'nullable|required_if:categoria,celulares|in:lacrado,seminovo',
    'marca' => 'nullable|string|max:100',
    'tipo_acessorio' => 'nullable|string|max:100',
]);

        if ($request->hasFile('imagem')) {
            $dados['imagem'] = $request->file('imagem')
                ->store('produtos', 'public');
        }

        Produto::create($dados);

        return redirect()
            ->route('admin.produtos.index')
            ->with('sucesso', 'Produto cadastrado com sucesso!');
    }

    // Mostrar formulário de edição
    public function edit(Produto $produto)
    {
        return view('admin.produtos.editar', compact('produto'));
    }

    // Atualizar produto
    public function update(Request $request, Produto $produto)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'nullable|image|max:2048',
            'categoria' => 'required|string|max:100',
            'estoque' => 'required|integer|min:0',
            'subcategoria' => 'nullable|required_if:categoria,celulares|in:lacrado,seminovo',
            'marca' => 'nullable|string|max:100',
            'tipo_acessorio' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('imagem')) {

            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }

            $dados['imagem'] = $request->file('imagem')
                ->store('produtos', 'public');
        } else {
            unset($dados['imagem']);
        }

        $produto->update($dados);

        return redirect()
            ->route('admin.produtos.index')
            ->with('sucesso', 'Produto atualizado com sucesso!');
    }

    // Excluir produto
    public function destroy(Produto $produto)
    {
        if ($produto->imagem) {
            Storage::disk('public')->delete($produto->imagem);
        }

        $produto->delete();

        return redirect()
            ->route('admin.produtos.index')
            ->with('sucesso', 'Produto excluído com sucesso!');
    }
}
