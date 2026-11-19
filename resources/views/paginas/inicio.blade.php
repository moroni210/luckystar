<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuckStar</title>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>

<body class="fundo-inicio">
    

<header class="cabecalho">

    <div class="logo">
        <img
            src="{{ asset('images/logo2.png') }}"
            alt="LuckStar"
            class="logo-img"
        >
        <h1>LuckStar</h1>
    </div>

    <nav>
        <ul>
            <li> <a href="{{ url('/produtos') }}">Produtos</a> </li>
            <li><a href="#contato" onclick="irParaContato(event)">Contato</a></li>
            <li> <a href="#sobre" onclick="irParasobre(event)">Sobre</a></li>
            <li> <a href="{{ url('/localidade') }}">Localidade</a></li>
        </ul>
    </nav>

    <div class="conta">

    {{-- BOTÃO DO ADMIN --}}
   @if (session()->has('usuario_id') && session('usuario_tipo') === 'admin')
        <a href="{{ url('/admin/produtos') }}" class="botao-admin">
            ⚙ Painel Administrativo
        </a>
    @endif

    {{-- CONTA DO USUÁRIO --}}
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
</header>


<main class="conteudo">

    <h1>LuckStar</h1>

    @if (session('usuario_nome'))

        <h2>
            Bem-vindo(a), {{ session('usuario_nome') }}!
        </h2>

    @else

        <h2>
            Bem-vindo(a) ao nosso site!
        </h2>

    @endif

    <p>
        Você está acessando o site da LuckStar sua loja de celulares.
    </p>

    <p>
        Aqui você encontrará uma variedade de celulares de última geração,
        acessórios e muito mais para explorar nossos produtos e descobrir
        o que temos a oferecer. Ou procure lojas próximas a você com
        descontos especiais!
    </p>

</main>


<!-- INÍCIO -->

<section class="inicio">

    <div class="inicio-conteudo">

        <div class="inicio-texto">

            <p><strong>TECNOLOGIA FIEL</strong> AO SEU ESTILO</p>

            <h1>
                SEU <strong>PROXIMO</strong> CELULAR ESTÁ <strong>AQUI!</strong>
            </h1>

            <a href="{{ url('/produtos') }}" class="botao">
                Ver produtos
            </a>

        </div>

        <div class="inicio-produto">

            @php
                $produto = $produtos->first();
            @endphp

            @if($produto)

                <div class="card-produto">

                    <img
                        src="{{ asset('storage/' . $produto->imagem) }}"
                        alt="{{ $produto->nome }}"
                    >

                    <h3>{{ $produto->nome }}</h3>

                    <p>
                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                    </p>

                </div>

            @endif

        </div>

    </div>

</section>

<!-- SOBRE -->

    <main>

        <section id="sobre" class="sobre-banner">
            <div class="sobre-conteudo">
                <span>CONHEÇA NOSSA HISTÓRIA</span>

                <h1>
                    Muito além da<br>
                    <strong>tecnologia.</strong>
                </h1>

                <p>
                    Conectamos você à inovação, qualidade
                    e tecnologia que combina com seu estilo.
                </p>

                <a href="{{ url('/produtos') }}" class="sobre-botao">
                    Conheça nossos produtos
                </a>
            </div>
        </section>

       <section class="sobre-apresentacao">

            <div class="sobre-texto">
                <span class="sobre-legenda">QUEM SOMOS</span>

                <h2>
                    Tecnologia fiel ao <strong>seu estilo.</strong>
                </h2>

                <p>
                    A LuckStar nasceu com o propósito de conectar
                    pessoas à tecnologia, oferecendo produtos que
                    unem inovação, qualidade e estilo.
                </p>

                <p>
                    Somos uma loja dedicada ao universo dos
                    smartphones e acessórios, buscando proporcionar
                    uma experiência de compra simples, transparente
                    e satisfatória.
                </p>

                <p>
                    Aqui, cada detalhe importa. Queremos ajudar você
                    a encontrar a tecnologia ideal para acompanhar
                    seu dia a dia.
                </p>
            </div>

            <div class="sobre-imagem">
                <img
                    src="{{ asset('images/tecnologia.jpg') }}"
                    alt="Tecnologia LuckStar"
                >
            </div>

        </section>

        <section class="sobre-valores">

            <div class="sobre-titulo">
                <span>O QUE NOS MOVE</span>
                <h2>Nossos <strong>princípios</strong></h2>
                <p>Os valores que fazem parte da nossa essência.</p>
            </div>

            <div class="sobre-cards">

                <div class="sobre-card">
                    <div class="sobre-icone">✦</div>
                    <h3>Nossa missão</h3>
                    <p>
                        Oferecer tecnologia, praticidade e inovação,
                        ajudando cada cliente a encontrar o produto
                        ideal.
                    </p>
                </div>

                <div class="sobre-card">
                    <div class="sobre-icone">◈</div>
                    <h3>Nossa visão</h3>
                    <p>
                        Ser reconhecida pela confiança, qualidade
                        dos produtos e compromisso com os clientes.
                    </p>
                </div>

                <div class="sobre-card">
                    <div class="sobre-icone">♛</div>
                    <h3>Nossos valores</h3>
                    <p>
                        Trabalhar com transparência, responsabilidade,
                        inovação e respeito em cada atendimento.
                    </p>
                </div>

            </div>
        </section>

    </main>


<!-- CONTATO -->

<section class="contato" id="contato">

    <div class="contato-intro">

        <p>ESTAMOS AQUI PARA AJUDAR</p>

        <h1>Entre em contato</h1>

        <span>
            Tem alguma dúvida ou precisa de ajuda?
            Estamos prontos para atender você.
        </span>

    </div>

    <div class="contato-container">

        <!-- INFORMAÇÕES -->

        <div class="contato-info">

            <h2>Fale com a LuckStar</h2>

            <p>
                Sua satisfação é importante para nós.
                Entre em contato e tire suas dúvidas.
            </p>

            <div class="contato-item">

                <h3>WhatsApp</h3>

                <p>
                    Atendimento rápido e personalizado.
                </p>

                <a href="https://wa.me/5575981691080" target="_blank" aria-placeholder="dw">
                    Falar pelo WhatsApp
                </a>

            </div>

            <div class="contato-item">

                <h3>E-mail</h3>

                <p>
                    Envie suas dúvidas para nossa equipe.
                </p>

                <a href="mailto:luckstar981@gmail.com" target="_blank">
                    Enviar e-mail
                </a>

            </div>

        </div>


        <!-- FORMULÁRIO -->

        <div class="contato-formulario">

            <h2>Envie uma mensagem</h2>

            <form>

                <input
                    type="text"
                    placeholder="Seu nome"
                    required
                >

                <input
                    type="email"
                    placeholder="Seu e-mail"
                    required
                >

                <input
                    type="text"
                    placeholder="Assunto"
                    required
                >

                <textarea
                    placeholder="Escreva sua mensagem..."
                    required
                ></textarea>

                <button type="submit">
                    Enviar mensagem
                </button>

            </form>

        </div>

    </div>

</section>


<!-- RODAPÉ -->

<footer class="rodape">

    <p>© 2026 LuckStar - Tecnologia fiel ao seu estilo.</p>

</footer>
</body>
</html>
