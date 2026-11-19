<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/style.css', 'resources/js/app.js'])

    <title>Cadastro - LuckStar</title>
</head>

<body class="cadastro-pagina">

    <div class="cadastro">
        <h1>Cadastro <strong>LuckStar</strong></h1>
        
        @if ($errors->any())
            <div class="erro">
                @foreach ($errors->all() as $erro)
                    <p>{{ $erro }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ url('/cadastro') }}">
            @csrf

            <label for="nome">Nome:</label>
            <input
                type="text"
                id="nome"
                name="nome"
                value="{{ old('nome') }}"
                placeholder="Digite seu nome"
                required
            >

            <label for="email">E-mail:</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Digite seu e-mail"
                required
            >

            <label for="email_confirm">Confirme seu e-mail:</label>
            <input
                type="email"
                id="email_confirm"
                name="email_confirm"
                placeholder="Digite seu e-mail novamente"
                required
            >

            <label for="senha">Senha:</label>
            <input
                type="password"
                id="senha"
                name="senha"
                placeholder="Crie uma senha"
                required
            >

            <label for="senha_confirm">Confirme sua senha:</label>
            <input
                type="password"
                id="senha_confirm"
                name="senha_confirm"
                placeholder="Digite sua senha novamente"
                required
            >

            <button type="submit" class="butao_cadastro">
                Cadastrar
            </button>
        </form>

        <p>Já tem uma conta? <a href="{{ url('/login') }}">Entrar</a></p>

        <p><a href="{{ url('/') }}">Voltar ao início</a></p>
    </div>

</body>
</html>

