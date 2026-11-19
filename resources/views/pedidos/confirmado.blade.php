<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pedido confirmado | LuckStar</title>

    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>

<body class="fundo">

    <main class="confirmacao">

        <h1>Pedido registrado!</h1>

        <p>Obrigado por comprar na LuckStar.</p>

        <h2>Pedido #{{ $pedido->id }}</h2>

        <p>Cliente: {{ $pedido->nome_cliente }}</p>

        <h3>Produtos:</h3>

        @foreach ($pedido->itens as $item)

            <p>
                {{ $item->nome_produto }}
                — {{ $item->quantidade }} unidade(s)
            </p>

        @endforeach

        <p>
            Subtotal:
            R$ {{ number_format($pedido->subtotal, 2, ',', '.') }}
        </p>

        <p>Frete: A combinar</p>

        <h2>
            Total sem frete:
            R$ {{ number_format($pedido->total, 2, ',', '.') }}
        </h2>

        <p>
            Para combinar pagamento e entrega,
            entre em contato com a LuckStar pelo WhatsApp.
        </p>

        <a
            href="{{ $whatsappUrl }}"
            target="_blank"
            rel="noopener noreferrer"
            class="botao-whatsapp"
        >
            Conversar pelo WhatsApp
        </a>

        <a href="/produtos" class="voltar">
            Continuar comprando
        </a>

    </main>

    <script>
        localStorage.removeItem('luckstar_carrinho');
    </script>

</body>
</html>