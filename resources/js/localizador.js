/* ==============================
LOCALIZADOR DE SITES COM OFERTAS
============================== */
document.addEventListener("DOMContentLoaded", function () {

    const produto = document.getElementById("produto");
    const mensagem = document.getElementById("mensagem");
    const pesquisar = document.getElementById("pesquisar");

    const lojas = {
        mercadolivre: function (nome) {
            return "https://lista.mercadolivre.com.br/" + encodeURIComponent(nome);
        },

        amazon: function (nome) {
            return "https://www.amazon.com.br/s?k=" + encodeURIComponent(nome);
        },

        kabum: function (nome) {
            return "https://www.kabum.com.br/busca/" + encodeURIComponent(nome);
        },

        magalu: function (nome) {
            return "https://www.magazineluiza.com.br/busca/" + encodeURIComponent(nome) + "/";
        }
    };

    function buscarNaLoja(nomeLoja) {

        const nome = produto.value.trim();

        if (nome === "") {
            mensagem.innerText = "Digite o nome do celular!";
            produto.focus();
            return;
        }

        if (!lojas[nomeLoja]) {
            mensagem.innerText = "Loja não encontrada!";
            return;
        }

        const url = lojas[nomeLoja](nome);

        mensagem.innerText = "Abrindo pesquisa...";

        window.open(url, "_blank");
    }

    pesquisar.addEventListener("click", function () {
        buscarNaLoja("mercadolivre");
    });

    document.querySelectorAll(".loja").forEach(function (botao) {

        botao.addEventListener("click", function () {
            buscarNaLoja(botao.dataset.loja);
        });

    });

    produto.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            buscarNaLoja("mercadolivre");
        }
    });

    console.log("LuckStar carregada com sucesso!");

});


/* ==============================
LOCALIZADOR DE LOJAS PROXIMAS A VOÇÊ
============================== */

const botao = document.getElementById("buscar-localizacao");

const status = document.getElementById("status");

const resultado = document.getElementById("resultado");

// Clica para encontrar os mercadinhos
botao.addEventListener("click", function () {

    status.innerText = "Obtendo sua localização...";

    navigator.geolocation.getCurrentPosition(

        async function (posicao) {

            const latitude = posicao.coords.latitude;
            const longitude = posicao.coords.longitude;

            status.innerText = "Procurando loja de Celulares próximos...";

            const consulta = `
                [out:json][timeout:25];
                (
                    nwr["shop"="mobile_phone"](around:10000,${latitude},${longitude});
                    
                    nwr["shop"="electronics"](around:10000,${latitude},${longitude});
                );
                out center tags;
            `;

            try {

                const resposta = await fetch(
                    "https://overpass-api.de/api/interpreter",
                    {
                        method: "POST",
                        body: new URLSearchParams({
                            data: consulta
                        })
                    }
                );

                if (!resposta.ok) {
                    throw new Error("Erro na pesquisa");
                }

                const dados = await resposta.json();

                const lojas = dados.elements.map(loja => {

                    const lat = loja.lat ?? loja.center?.lat;
                    const lon = loja.lon ?? loja.center?.lon;

                    if (lat == null || lon == null) return null;

                    return {
                        nome: loja.tags.name || "loja de celulares sem nome",
                        latitude: lat,
                        longitude: lon,
                        distancia: calcularDistancia(
                            latitude,
                            longitude,
                            lat,
                            lon
                        )
                    };

                }).filter(Boolean);

                lojas.sort((a, b) => a.distancia - b.distancia);

                resultado.innerHTML = "";

                if (lojas.length === 0) {
                    status.innerText = "Nenhuma loja de celulares encontrado em 5 km.";
                    return;
                }

                status.innerText = lojas.length + " estabelecimentos encontrados.";

                lojas.forEach((loja, indice) => {

                    const card = document.createElement("div");
                    card.className = "card";

                    const titulo = document.createElement("h3");
                    titulo.innerText = indice === 0
                        ? "Mais próximo de você"
                        : "Estabelecimento";

                    const nome = document.createElement("p");
                    nome.innerText = loja.nome;

                    const distancia = document.createElement("p");
                    distancia.innerText = loja.distancia < 1
                        ? Math.round(loja.distancia * 1000) + " metros"
                        : loja.distancia.toFixed(2) + " km";

                    const link = document.createElement("a");
                    link.innerText = "Ver localização";
                    link.href = `https://www.openstreetmap.org/?mlat=${loja.latitude}&mlon=${loja.longitude}#map=17/${loja.latitude}/${loja.longitude}`;
                    link.target = "_blank";
                    link.rel = "noopener";

                    card.append(titulo, nome, distancia, link);

                    resultado.appendChild(card);

                });

            } catch (erro) {

                status.innerText = "Erro ao buscar estabelecimentos. Tente novamente.";

            }

        },

        function () {
            status.innerText = "Permita o acesso à sua localização para continuar.";
        }

    );

});

// Calcula distância entre duas coordenadas
function calcularDistancia(lat1, lon1, lat2, lon2) {

    const R = 6371;

    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;

    const a =
        Math.sin(dLat / 2) ** 2 +
        Math.cos(lat1 * Math.PI / 180) *
        Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLon / 2) ** 2;

    return R * 2 * Math.atan2(
        Math.sqrt(a),
        Math.sqrt(1 - a)
    );
}
