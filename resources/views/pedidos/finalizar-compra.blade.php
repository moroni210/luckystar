
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Finalizar compra | LuckStar</title>

    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>

<body class="fundo">

<main class="finalizacao">

    <h1>Finalizar compra</h1>

    <p>Preencha seus dados para concluir seu pedido.</p>

    @if ($errors->any())
        <div class="erro-finalizacao">
            @foreach ($errors->all() as $erro)
                <p>{{ $erro }}</p>
            @endforeach
        </div>
    @endif

    <div id="resumo-finalizacao"></div>

    <form
        action="{{ route('pedidos.salvar') }}"
        method="POST"
        id="form-finalizacao"
    >

        @csrf

        <input
            type="text"
            name="nome_cliente"
            placeholder="Nome completo"
            value="{{ old('nome_cliente', session('usuario_nome')) }}"
            required
        >

        <input
            type="email"
            name="email"
            placeholder="E-mail"
            value="{{ old('email', session('usuario_email')) }}"
        >

        <input
            type="tel"
            name="telefone"
            placeholder="Telefone com DDD"
            value="{{ old('telefone') }}"
            required
        >

        <textarea
            name="endereco"
            placeholder="Endereço completo para entrega"
            required
        >{{ old('endereco') }}</textarea>

        <input type="hidden" name="itens" id="itens">

        <p>Frete: A combinar com a loja.</p>

        <button type="submit" class="botao-finalizar">
            Confirmar pedido
        </button>

    </form>

</main>

<script>
    const carrinhoFinal = JSON.parse(
        localStorage.getItem('luckstar_carrinho')
    ) || [];

    const resumo = document.getElementById('resumo-finalizacao');
    const campoItens = document.getElementById('itens');
    const formulario = document.getElementById('form-finalizacao');

    let subtotal = 0;

    carrinhoFinal.forEach(produto => {

        const quantidade = Number(produto.quantidade);
        const preco = Number(produto.preco);

        if (!Number.isInteger(quantidade) || quantidade < 1 ||
            !Number.isFinite(preco) || preco < 0) {
            return;
        }

        subtotal += preco * quantidade;

        const linha = document.createElement('p');

        linha.textContent = produto.nome + ' x ' + quantidade;

        resumo.appendChild(linha);
    });

    const total = document.createElement('h3');

    total.textContent = 'Subtotal: ' + subtotal.toLocaleString(
        'pt-BR',
        { style: 'currency', currency: 'BRL' }
    );

    resumo.appendChild(total);

    formulario.addEventListener('submit', function(event) {

        if (carrinhoFinal.length === 0) {
            event.preventDefault();
            alert('Seu carrinho está vazio!');
            return;
        }

        campoItens.value = JSON.stringify(
            carrinhoFinal.map(produto => ({
                id: produto.id,
                quantidade: produto.quantidade
            }))
        );

    });
</script>

</body>
</html>
