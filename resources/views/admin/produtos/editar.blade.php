<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto - LuckStar</title>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body class="painel-admin">

    <h1>Editar produto</h1>

    <a href="{{ route('admin.produtos.index') }}">Voltar ao painel</a>

    @if($errors->any())
        @foreach($errors->all() as $erro)
            <p>{{ $erro }}</p>
        @endforeach
    @endif

    <form action="{{ route('admin.produtos.update', $produto->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <label>Nome:</label>
        <input type="text" name="nome"
               value="{{ old('nome', $produto->nome) }}" required>

        <br><br>

        <label>Descrição:</label>
        <textarea name="descricao" required>{{ old('descricao', $produto->descricao) }}</textarea>

        <br><br>

        <label>Preço:</label>
        <input type="number" name="preco" step="0.01" min="0"
               value="{{ old('preco', $produto->preco) }}" required>

        <br><br>

        <label>Imagem atual:</label>

        @if($produto->imagem)
            <br>
            <img src="{{ asset('storage/' . $produto->imagem) }}"
                 width="120" alt="Imagem do produto">
        @endif

        <br><br>

        <label>Nova imagem:</label>
        <input type="file" name="imagem" accept="image/*">

        <br><br>

        <label>Categoria:</label>
        <select name="categoria" required>
            <option value="celulares" @selected($produto->categoria == 'celulares')>Celulares</option>
            <option value="acessorios" @selected($produto->categoria == 'acessorios')>Acessórios</option>
            <option value="smartwatches" @selected($produto->categoria == 'smartwatches')>Smartwatches</option>
        </select>
        
    <br><br>

        <label>Subcategoria:</label>

        <select name="subcategoria">
            <option value="">Selecione</option>

            <option value="lacrado" @selected($produto->subcategoria == 'lacrado')>
                Lacrado
            </option>

            <option value="seminovo" @selected($produto->subcategoria == 'seminovo')>
                Seminovo
            </option>
        </select>
        <br><br>

    <div class="campo">
    <label for="marca">Marca:</label>

    <select name="marca" id="marca">
        <option value="">Selecione a marca</option>
        <option value="Apple">Apple</option>
        <option value="Samsung">Samsung</option>
        <option value="Xiaomi">Xiaomi</option>
        <option value="Huawei">Huawei</option>
        <option value="Amazfit">Amazfit</option>
        <option value="Garmin">Garmin</option>
    </select>
</div>


    <label for="tipo_acessorio">Tipo de Acessório:</label>
    <select name="tipo_acessorio" id="tipo_acessorio">
        <option value="">Selecione o tipo</option>
        <option value="fones">Fone de Ouvido</option>
        <option value="carregador">Carregador</option>
        <option value="capa">Capa</option>
        <option value="pelicula">Pelicula</option>
    </select>

        <label>Estoque:</label>
        <input type="number" name="estoque" min="0"
               value="{{ old('estoque', $produto->estoque) }}" required>

        <br><br>

        <button type="submit">Salvar alterações</button>

    </form>

</body>
</html>
