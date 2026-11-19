<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - LuckStar</title>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body class="fundo-produtos">

    <header class="cabecalho-produtos">
        <h1>Nossos Produtos</h1>
        <p>Bem-vindo à página de produtos da LuckStar!</p>

        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Início🏠</a></li>
                <li><a href="{{ url('/celulares') }}">Celulares📱</a></li>
                <li><a href="{{ url('/acessorios') }}">Acessórios🎧</a></li>
                <li><a href="{{ url('/smartwatches') }}">Relógios Inteligentes ⌚</a></li>
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

    <section class="produtos-section">

        <h2>Encontre o seu próximo produto aqui!</h2>
        <p>Descubra uma ampla seleção de produtos incríveis na LuckStar.</p>

        <div class="barra-pesquisa">
            <input type="text" id="pesquisar" placeholder="Pesquisar produtos...">
            <button type="button" id="botao-pesquisar">Pesquisar</button>
        </div>

    </section>

    <section class="lista-produtos">

        <h2>Produtos disponíveis</h2>
        

        <div class="container-produtos">

            @forelse($produtos as $produto)

                <div class="card-produto">

                    @if($produto->imagem)
                        <img src="{{ asset('storage/' . $produto->imagem) }}"
                             alt="{{ $produto->nome }}">
                    @endif

                   <h6 class="{{ $produto->subcategoria == 'lacrado' ? 'subcategoria-lacrado' : 'subcategoria-seminovo' }}">{{ $produto->subcategoria }}</h6>

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
    data-estoque="{{ $produto->estoque }}"
    data-imagem="{{ $produto->imagem ? asset('storage/' . $produto->imagem) : '' }}"
    data-categoria="{{ $produto->categoria }}"
    data-subcategoria="{{ $produto->subcategoria }}">

    Comprar

</button>

                    
                </div>

            @empty

                <p>Nenhum produto cadastrado no momento.</p>

            @endforelse

        </div>

    </section>
    <footer class="rodape">

    <p>© 2026 LuckStar - Tecnologia fiel ao seu estilo.</p>

</footer>
</body>
</html>
