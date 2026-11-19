/*ABRIR CONTA*/
window.abrirConta = function () {

    const menu = document.getElementById("menuConta");

    if (!menu) {
        console.log("Menu da conta não encontrado!");
        return;
    }

    if (window.getComputedStyle(menu).display === "none") {
        menu.style.display = "block";
    } else {
        menu.style.display = "none";
    }

};


/*IR PARA CONTATO*/

window.irParaContato = function(event) {

    event.preventDefault();

    const contato = document.getElementById('contato');

    if(!contato) return;

    contato.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });

};



/*IR PARA SOBRE*/
window.irParasobre = function(event) {

    event.preventDefault();

    const sobre = document.getElementById('sobre');

    if(!sobre) return;

    sobre.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });

}





/*=======PESQUISA DE PRODUTOS=======*/
document.addEventListener('DOMContentLoaded', function () {

    const campoPesquisa = document.getElementById('pesquisar');
    const botaoPesquisa = document.getElementById('botao-pesquisar');

    if (!campoPesquisa) return;

    function pesquisarProdutos() {
        const nome = campoPesquisa.value.toLowerCase().trim();

        const produtos = document.querySelectorAll('.card-produto');

        produtos.forEach(function (produto) {
            const texto = produto.textContent.toLowerCase();

            produto.style.display = texto.includes(nome) ? '' : 'none';
        });
    }

    campoPesquisa.addEventListener('input', pesquisarProdutos);

    botaoPesquisa?.addEventListener('click', pesquisarProdutos);

    campoPesquisa.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            pesquisarProdutos();
        }
    });

});
/*=======PESQUISA DE PRODUTOS=======*/

/*=======FILTRAGEM DE PRODUTOS=======*/
function filtrarProdutos(tipo) {

    const produtos = document.querySelectorAll('.produto-card');

    produtos.forEach(produto => {

        const subcategoria = produto.dataset.subcategoria;

        if (tipo === 'todos' || subcategoria === tipo) {
            produto.style.display = '';
        } else {
            produto.style.display = 'none';
        }

    });

}

function mostrarNotificacao(mensagem) {

    const aviso = document.createElement('div');

    aviso.textContent = '✓ ' + mensagem;

    aviso.style.position = 'fixed';
    aviso.style.top = '25px';
    aviso.style.right = '25px';
    aviso.style.background = '#172B3B';
    aviso.style.color = '#FFFFFF';
    aviso.style.border = '1px solid #C8A96B';
    aviso.style.padding = '18px 25px';
    aviso.style.borderRadius = '10px';
    aviso.style.zIndex = '9999';
    aviso.style.boxShadow = '0 4px 15px rgba(0,0,0,0.3)';
    aviso.style.fontSize = '14px';

    document.body.appendChild(aviso);

    setTimeout(() => {
        aviso.remove();
    }, 3000);

}
// Recupera os produtos salvos
let carrinho = JSON.parse(
    localStorage.getItem('luckstar_carrinho')
) || [];


// ADICIONAR PRODUTOS
document.querySelectorAll('.botao-comprar').forEach(botao => {

    botao.addEventListener('click', function () {

        const produto = {
            id: this.dataset.id,
            nome: this.dataset.nome,
            preco: Number(this.dataset.preco),
            imagem: this.dataset.imagem,
            marca: this.dataset.marca,
            estoque: Number(this.dataset.estoque),
            categoria: this.dataset.categoria,
            subcategoria: this.dataset.subcategoria,
            quantidade: 1
        };

        // Verifica se já existe no carrinho
        const existente = carrinho.find(
            item => String(item.id) === String(produto.id)
        );

        const quantidadeAtual = existente
            ? existente.quantidade
            : 0;

        // Verifica o limite do estoque
        if (quantidadeAtual >= produto.estoque) {

            mostrarNotificacao(
                'Estoque insuficiente! Disponível: ' + produto.estoque
            );

            return;
        }

        // Adiciona ou aumenta a quantidade
        if (existente) {
            existente.quantidade++;
        } else {
            carrinho.push(produto);
        }

        // Salva no navegador
        localStorage.setItem(
            'luckstar_carrinho',
            JSON.stringify(carrinho)
        );

        mostrarNotificacao('Produto adicionado ao carrinho!');

    });

});


// MOSTRAR PRODUTOS NO CARRINHO
const lista = document.getElementById('itens-carrinho');

if (lista) {

    const totalElemento =
        document.getElementById('total-carrinho');

    const subtotalElemento =
        document.getElementById('subtotal-carrinho');

    function atualizarCarrinho() {

        lista.innerHTML = '';

        let total = 0;

        if (carrinho.length === 0) {

            lista.textContent = 'Seu carrinho está vazio.';

        }

        carrinho.forEach((produto, index) => {

            const subtotal =
                produto.preco * produto.quantidade;

            total += subtotal;

            const item = document.createElement('article');

            item.className = 'item-carrinho';

            const nome = document.createElement('h3');
            nome.textContent = produto.nome;
            
            const preco = document.createElement('p');
            preco.textContent = subtotal.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });

            const quantidade = document.createElement('p');
            quantidade.textContent =
            'Quantidade: ' + produto.quantidade;
            
          const remover = document.createElement('button');

          remover.style.background = '#8B3030';
          remover.style.color = '#FFFFFF';
          remover.style.border = 'none';
          remover.style.padding = '9px 16px';
          remover.style.borderRadius = '6px';
          remover.style.cursor = 'pointer';
          remover.style.fontWeight = 'bold';
          remover.style.transition = '0.3s';
          
          remover.addEventListener('mouseenter', () => {
              remover.style.background = '#B94040';
            });
            
            remover.addEventListener('mouseleave', () => {
                remover.style.background = '#8B3030';
            });
            remover.textContent = '✕ Remover';
            
            remover.addEventListener('click', () => {

    carrinho.splice(index, 1);

    localStorage.setItem(
        'luckstar_carrinho',
        JSON.stringify(carrinho)
    );

    atualizarCarrinho();

    mostrarNotificacao('Produto removido do carrinho!');

});
            
            item.appendChild(nome);
            item.appendChild(preco);
            item.appendChild(quantidade);
            item.appendChild(remover);
            lista.appendChild(item);

        });

        const valorFormatado = total.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });

        totalElemento.textContent = valorFormatado;
        subtotalElemento.textContent = valorFormatado;

    }

    atualizarCarrinho();

}




const secaoContato = document.querySelector('.contato');

const observador = new IntersectionObserver((entradas) => {

    entradas.forEach((entrada) => {

        if (entrada.isIntersecting) {

            entrada.target.classList.add('animar');

            observador.unobserve(entrada.target);

        }

    });

}, {
    threshold: 0.15
});

observador.observe(secaoContato);
