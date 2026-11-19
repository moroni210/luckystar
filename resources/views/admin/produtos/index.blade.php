<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - LuckStar</title>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body class="painel-admin">

    <h1>Painel Administrativo - LuckStar</h1>

    <a href="{{ route('admin.produtos.create') }}">Cadastrar novo produto</a>

    @if(session('sucesso'))
        <p>{{ session('sucesso') }}</p>
    @endif
    
    <h2>Produtos cadastrados</h2>
    <a href="{{ url('/produtos') }}">Ver todos os produtos</a>
    <a href="{{ url('/') }}">Voltar para inicio</a>
    @forelse($produtos as $produto)
        <div>
            <h3>{{ $produto->nome }}</h3>
            <p>Preço: R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
            <p>Categoria: {{ $produto->categoria }}</p>
            <p>Estoque: {{ $produto->estoque }}</p>

            <a href="{{ route('admin.produtos.edit', $produto->id) }}">Editar</a>

            <form action="{{ route('admin.produtos.destroy', $produto->id) }}"
                  method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Excluir</button>
            </form>
        </div>
        <hr>
    @empty
        <p>Nenhum produto cadastrado.</p>
    @endforelse

</body>
</html>
