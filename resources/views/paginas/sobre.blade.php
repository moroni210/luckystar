<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre | LuckStar</title>

    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body>

    <header class="sobre-header">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo2.png') }}" alt="LuckStar">
        </a>

            <a href="{{ url('/sobre') }}" class="ativo">Sobre</a>
        </nav>
    </header>

    <main>

        <section class="sobre-banner">
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

    <footer class="sobre-footer">
        © {{ date('Y') }} LuckStar — Todos os direitos reservados.
    </footer>

</body>
</html>
