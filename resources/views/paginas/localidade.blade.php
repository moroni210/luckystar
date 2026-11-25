<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lojas proximas - LuckStar</title>
    @vite(['resources/css/style.css', 'resources/js/localizador.js'])
</head>
<body class="fundo-localidade">

    <header class="cabecalho-localidade">
        <h1>LuckStar</h1>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Início🏠</a></li>
                <li> <a href="{{ url('/produtos') }}">Produtos</a> </li>
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

   <main>

        <section class="introducao">
            <p class="subtitulo">TECNOLOGIA FIEL <strong>AO SEU ESTILO</strong></p>

            <h1>Encontre seu próximo celular.</h1>

            <p>
                Descubra lojas próximas de você e pesquise
                ofertas nas principais lojas online.
            </p>
        </section>

    

     <!-- LOJAS PRÓXIMAS -->

        <section class="secao">

            <h2>Encontre lojas próximas de você</h2>

            <p>
                Descubra lojas de celulares perto da sua localização.
            </p>

            <button id="buscar-localizacao">
                Encontrar lojas próximas
            </button>

            <p id="status"></p>

            <div id="resultado"></div>

        </section>

        <!-- PESQUISA DE CELULARES -->

        <section class="secao">

            <h2>Pesquise ofertas de celulares</h2>

            <p>
                Digite o modelo do celular que deseja encontrar.
            </p>

            <div class="campo-pesquisa">

                <input
                    type="text"
                    id="produto"
                    placeholder="Ex: iPhone 15, Samsung A55..."
                >

                <button id="pesquisar">
                    Pesquisar
                </button>

            </div>

            <p id="mensagem"></p>

        </section>

        <!-- LOJAS ONLINE -->

        <section class="secao">

            <h2>Escolha onde pesquisar</h2>

            <div class="grade-lojas">

                <button class="loja" data-loja="mercadolivre">
                    Mercado Livre
                </button>

                <button class="loja" data-loja="amazon">
                    Amazon
                </button>

                <button class="loja" data-loja="kabum">
                    kabum
                </button>

                <button class="loja" data-loja="magalu">
                    Magazine Luiza
                </button>

            </div>

        </section>

        <!-- COMO FUNCIONA -->

        <section class="secao-explicacao">

            <h2>Como funciona a LuckStar?</h2>

            <p>
                Com a LuckStar você pode encontrar lojas de celulares
                próximas da sua localização e pesquisar modelos
                nas principais plataformas de vendas online.
                Compare as ofertas e encontre o produto que procura.
            </p>

        </section>

    </main>

    <footer class="rodape">
        <p>© 2026 LuckStar - Tecnologia fiel ao seu estilo</p>
    </footer>
</body>
</html>
