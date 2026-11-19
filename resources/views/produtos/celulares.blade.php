<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Celulares - LuckStar</title>
 @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body class="fundo-produtos">
    <header class="cabecalho-celulares">
        <h1>Celulares</h1>
    <p>Bem-vindo à página de celulares da LuckStar!</p>

    <nav>
        <ul>
            <li><a href="{{ url('/') }}">Início🏠</a></li>
            <li><a href="{{ url('/produtos') }}">Produtos</a></li>
            <li><a href="{{ url('/acessorios') }}">Acessórios🎧</a></li>
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

    <section class="celulares-section">
        <h2>Encontre o seu próximo celular aqui!</h2>
        <p>Escolha o celular ideal para você. Confira nossas opções!.</p>

        
        <nav class="filtro-estado">
                <ul>
                    <a class="filtro-celular ativo" href="{{ url('/celulares') }}">Todos</a>
                
                    <a class="filtro-celular" href="{{ url('/celulares?subcategoria=lacrado') }}">
                        Lacrados
                    </a>
                
                    <a class="filtro-celular" href="{{ url('/celulares?subcategoria=seminovo') }}">
                        Seminovos
                    </a>
                
                </ul>
            </nav>
       

    <div class="barra-pesquisa">

            <input type="text" placeholder="Pesquisar produtos..." id="pesquisar">
            <button type="button" id="botao-pesquisar">Pesquisar</button>

            </div>


</div>

    <div class="container-produtos">

    @forelse($produtos as $produto)

        <div class="card-produto">

            @if($produto->imagem)
                <img src="{{ asset('storage/' . $produto->imagem) }}"
                     alt="{{ $produto->nome }}">
            @endif

            <h3>{{ $produto->nome }}</h3>

             <h6 class="{{ $produto->subcategoria == 'lacrado' ? 'subcategoria-lacrado' : 'subcategoria-seminovo' }}">{{ $produto->subcategoria }}</h6>

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

        <p>Nenhum celular cadastrado no momento.</p>

    @endforelse

</div>

 </section>
 <footer class="rodape">

    <p>© 2026 LuckStar - Tecnologia fiel ao seu estilo.</p>

</footer>
</body>
</html>