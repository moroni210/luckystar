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
<main class="sobre-pagina">

    <!-- BANNER PRINCIPAL -->
    <section id="sobre" class="sobre-banner">
        <div class="sobre-banner-conteudo">
            <span class="sobre-etiqueta">CONHEÇA NOSSA HISTÓRIA</span>

            <h1>
                Muito além da
                <span>tecnologia.</span>
            </h1>

            <p>
                Conectamos você à inovação, qualidade e tecnologia
                que combina com seu estilo.
            </p>

            <a href="/produtos" class="sobre-botao">
                Conheça nossos produtos
            </a>
        </div>
    </section>

    <!-- QUEM SOMOS -->
    <section class="sobre-apresentacao">
        <div class="sobre-texto">
            <span class="sobre-etiqueta">QUEM SOMOS</span>

            <h2>Tecnologia fiel ao seu estilo.</h2>

            <p>
                A LuckStar nasceu com o propósito de aproximar
                pessoas da tecnologia, oferecendo produtos que
                unem inovação, qualidade e praticidade.
            </p>

            <p>
                Acreditamos que cada pessoa tem seu próprio estilo.
                Por isso, buscamos oferecer soluções tecnológicas
                que acompanhem o dia a dia e facilitem a conexão
                com o mundo.
            </p>

            <p>
                Mais do que oferecer produtos, queremos proporcionar
                uma experiência de compra simples, confiável e
                conectada às necessidades de cada cliente.
            </p>
        </div>

        <div class="sobre-imagem">
            <img src="{{ asset('images/tecnologia.jpg') }}" alt="LuckStar">
        </div>
    </section>

    <!-- NOSSA HISTÓRIA -->
    <section class="sobre-historia">
        <div class="sobre-historia-conteudo">
            <span class="sobre-etiqueta">NOSSA ESSÊNCIA</span>

            <h2>Uma conexão com o futuro.</h2>

            <p>
                A tecnologia está presente em todos os momentos
                da nossa vida. Na LuckStar, queremos tornar essa
                conexão mais acessível, prática e especial.
            </p>

            <p>
                Nosso compromisso é continuar evoluindo,
                acompanhando as novidades do mercado e buscando
                oferecer produtos que façam a diferença.
            </p>
        </div>
    </section>

    <!-- MISSÃO, VISÃO E VALORES -->
    <section class="sobre-valores">
        <div class="sobre-titulo">
            <span class="sobre-etiqueta">O QUE NOS MOVE</span>
            <h2>Nossos princípios</h2>
            <p>Os valores que fazem parte da nossa identidade.</p>
        </div>

        <div class="sobre-cards">

            <article class="sobre-card">
                <div class="sobre-icone">✦</div>
                <h3>Missão</h3>
                <p>
                    Aproximar pessoas da tecnologia por meio de
                    produtos que ofereçam qualidade, praticidade
                    e inovação.
                </p>
            </article>

            <article class="sobre-card">
                <div class="sobre-icone">◎</div>
                <h3>Visão</h3>
                <p>
                    Crescer como uma marca de confiança,
                    acompanhando a evolução tecnológica e as
                    necessidades dos nossos clientes.
                </p>
            </article>

            <article class="sobre-card">
                <div class="sobre-icone">◇</div>
                <h3>Valores</h3>
                <p>
                    Trabalhar com compromisso, transparência,
                    respeito, qualidade e dedicação em cada
                    experiência.
                </p>
            </article>

        </div>
    </section>

    <!-- CHAMADA FINAL -->
    <section class="sobre-final">
        <span class="sobre-etiqueta">FAÇA PARTE DESSA CONEXÃO</span>

        <h2>O futuro está mais perto do que você imagina.</h2>

        <p>
            Descubra produtos que combinam com você e acompanham
            seu estilo de vida.
        </p>

        <a href="/produtos" class="sobre-botao">
            Explorar produtos
        </a>
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
