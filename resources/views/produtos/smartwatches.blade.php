<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relogios Inteligentes - LuckStar</title>
         @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body class="fundo-produtos">
    <header class="cabecalho-relogios">
        <h1>Relógios Inteligentes</h1>
        <p>Descubra nossa seleção de relógios inteligentes!</p>
        <nav>
            <ul>
                 <li><a href="{{ url('/') }}">Início🏠</a></li>
                 <li><a href="{{ url('/produtos') }}">Produtos</a></li>
                 <li><a href="{{ url('/celulares') }}">Celulares📱</a></li>
                 <li><a href="{{ url('/acessorios') }}">Acessórios🎧</a></li>
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

    <section class="relogios-section">
        <h2>Encontre o seu próximo relógio inteligente aqui!</h2>
        <p>Escolha o relógio ideal para você na qual se encaixa nos seus pulsos. Confira nossas opções!</p>

        <nav class="filtro-estado">
            <ul>
                <a class="filtro-relogios ativo" href="{{ url('/smartwatches') }}">Todos</a>
                <a class="filtro-relogios" href="{{ url('/smartwatches?marca=Apple') }}">Apple Watch</a>
                <a class="filtro-relogios" href="{{ url('/smartwatches?marca=Garmin') }}">Garmin</a>
                <a class="filtro-relogios" href="{{ url('/smartwatches?marca=Xiaomi') }}">Xiaomi Watch</a>
                <a class="filtro-relogios" href="{{ url('/smartwatches?marca=Huawei') }}">Huawei Watch</a>
                <a class="filtro-relogios" href="{{ url('/smartwatches?marca=Samsung') }}">Galaxy Watch</a>
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
                    
                    <h6 class="marca">{{ $produto->marca }}</h6>

                    <p>{{ $produto->descricao }}</p>

                    <p>
                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                    </p>

                    <p>Estoque: {{ $produto->estoque }}</p>


<button class="botao-comprar"
    data-id="{{ $produto->id }}"
    data-nome="{{ $produto->nome }}"
    data-preco="{{ $produto->preco }}"
    data-marca="{{ $produto->marca }}"
    data-estoque="{{ $produto->estoque }}"
    data-imagem="{{ $produto->imagem ? asset('storage/' . $produto->imagem) : '' }}"
    data-categoria="{{ $produto->categoria }}"
    data-subcategoria="{{ $produto->subcategoria }}">

    Comprar

</button>

                </div>

            @empty

                <p>Nenhum relógio inteligente cadastrado no momento.</p>

            @endforelse

        </div>

    </section>
    <footer class="rodape">

    <p>© 2026 LuckStar - Tecnologia fiel ao seu estilo.</p>

</footer>
</body>
</html>