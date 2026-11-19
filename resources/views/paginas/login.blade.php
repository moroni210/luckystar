
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LuckStar</title>

    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body class="login-pagina">

    <div class="login">
        <h1>Login</h1>

        @if ($errors->has('login'))
            <p style="color:red">
                {{ $errors->first('login') }}
            </p>
        @endif
        
@if (session('sucesso'))
    <p class="sucesso">{{ session('sucesso') }}</p>
@endif
        <form action="{{ url('/login') }}" method="POST">
            @csrf

            <label>E-mail</label>
            <input
                type="email"
                name="usuario"
                placeholder="Digite seu e-mail"
                value="{{ old('usuario') }}"
                required
            >

            <br><br>

            <label>Senha</label>
            <input
                type="password"
                name="password"
                placeholder="Digite sua senha"
                required
            >

            <br><br>

            <button type="submit" class="button">
                Entrar
            </button>
        </form>

        <br>

        <a href="{{ url('/cadastro') }}" class="link">
            Criar uma conta
        </a>
    </div>

</body>
</html>