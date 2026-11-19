<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - LuckStar</title>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body class="pagina-carrinho">

    <header class="cabecalho-carrinho">

        <a href="{{ url('/') }}">LuckStar</a>
        
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Início🏠</a></li>
                <li><a href="{{ url('/produtos') }}">Voltar</a></li>
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
    
    <main class="container-carrinho">
        <section class="titulo-carrinho">
            
        <h1>🛒Meu Carrinho</h1>

        <p>Confira os produtos que você adicionou ao seu carrinho antes de finalizar.</p>   

    </section>

<div class="conteudo-carrinho">

            <!-- LISTA DE PRODUTOS -->

            <section class="lista-carrinho">

                <h2>Seus produtos</h2>

                <div id="itens-carrinho">
                    <p>Carregando carrinho...</p>
                </div>

            </section>

            <!-- RESUMO DA COMPRA -->

            <aside class="resumo-carrinho">

                <h2>Resumo do pedido</h2>

                <div class="linha-resumo">
                    <span>Subtotal</span>
                    <span id="subtotal-carrinho">
                        R$ 0,00
                    </span>
                </div>

                <div class="linha-resumo">
                    <span>Frete</span>
                    <span>A combinar</span>
                </div>

                <div class="linha-total">
                    <span>Total</span>

                    <strong id="total-carrinho">
                        R$ 0,00
                    </strong>
                </div>

                <a href="{{ route('pedidos.finalizar') }}" class="botao-finalizar">

                    Finalizar compra →

                </a>

                <a href="{{ url('/produtos') }}" class="continuar-comprando">

                    ← Continuar comprando

                </a>

            </aside>

        </div>

    </main>

    <footer class="rodape">

    <p>© 2026 LuckStar - Tecnologia fiel ao seu estilo.</p>

</footer>

</body>
</html>
