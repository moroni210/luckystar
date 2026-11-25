<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acessórios - LuckStar</title>
     @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body class="fundo-produtos">
    <header class="cabecalho-acessorios">
        <h1>Acessórios</h1>
        <p>Bem-vindo à página de acessórios da LuckStar!</p>

        <nav>
        <ul>
            <li><a href="{{ url('/') }}">Início🏠</a></li>
            <li><a href="{{ url('/produtos') }}">Produtos</a></li>
            <li><a href="{{ url('/celulares') }}">Celulares📱</a></li>
            <li><a href="{{ url('/smartwatches') }}">Relogios Inteligentes ⌚</a></li>
            <li><a href="{{ url('/carrinho') }}">Carrinho🛒</a></li>
            <div class="conta">

        @if (session()->has('usuario_id'))

            <button class="botao-conta" onclick="abrirConta()">

                <span class="usuario-icon">
                    <span class="cabeca"></span>
                    <span class="corpo"></span>
                </span>

                {{ session('usuario_nome') }}

            </button>

            <div class="menu-conta" id="menuConta">

                <a href="{{ url('/minha-conta') }}">
                    Minha conta
                </a>

                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit">Sair</button>
                </form>

            </div>

        @else

            <a href="{{ url('/login') }}" class="botao-conta">

                <span class="usuario-icon">
                    <span class="cabeca"></span>
                    <span class="corpo"></span>
                </span>

                Entrar

            </a>

        @endif

    </div>
        </ul>

    </nav>
    </header>
    <section class="acessorios-section">
        <h2>Encontre os melhores acessórios para o seu celular!</h2>
        <p>Confira nossa seleção de acessórios de alta qualidade.</p>

        <nav class="filtro-estado">
         <ul>
                <a class="filtro-acessorios ativo" href="{{ url('/acessorios') }}">Todos</a>
                <a class="filtro-acessorios" href="{{ url('/acessorios?tipo_acessorio=capa') }}">capinhas</a>
                <a class="filtro-acessorios" href="{{ url('/acessorios?tipo_acessorio=pelicula') }}">peliculas</a>
                <a class="filtro-acessorios" href="{{ url('/acessorios?tipo_acessorio=carregador') }}">carregadores</a>
                <a class="filtro-acessorios" href="{{ url('/acessorios?tipo_acessorio=fones') }}">fones de ouvido</a>
            </ul>
        </nav>
         <div class="barra-pesquisa">

            <input type="text" placeholder="Pesquisar produtos..." id="pesquisar">
            <button type="button" id="botao-pesquisar">Pesquisar</button>

            </div>

        <div class="container-produtos">

    @forelse($produtos as $produto)

        <div class="card-produto" data-subcategoria="{{ $produto->subcategoria }}">

            @if($produto->imagem)
                <img src="{{ asset('storage/' . $produto->imagem) }}"
                     alt="{{ $produto->nome }}">
            @endif

            <h3>{{ $produto->nome }}</h3>
            

            <p>{{ $produto->descricao }}</p>

            <p>
                R$ {{ number_format($produto->preco, 2, ',', '.') }}
            </p>

            <p>Estoque: {{ $produto->estoque }}</p>

<button class="botao-comprar"
    data-id="{{ $produto->id }}"
    data-nome="{{ $produto->nome }}"
    data-preco="{{ $produto->preco }}"
    data-estoque="{{ $produto->estoque }}"
    data-imagem="{{ $produto->imagem ? asset('storage/' . $produto->imagem) : '' }}"
    data-categoria="{{ $produto->categoria }}"
    data-subcategoria="{{ $produto->subcategoria }}">

    Comprar

</button>

        </div>

    @empty

        <p>Nenhum acessório cadastrado no momento.</p>

    @endforelse

</div>

    </section>
    <footer class="rodape">

    <p>© 2026 LuckStar - Tecnologia fiel ao seu estilo.</p>

</footer>
</body>
</html>