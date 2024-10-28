const exibir = 15;
var searchPart = "";
let paginaAtual = 1;

$(document).ready(function () {
    gerenciarExibicaoUsuario();
    $("li").first().addClass("active");
    buscarPaginas(exibir);
    carregarPaginaPrimeiraVez();
});

$('#adicionarPecas').on('click', () => {
    $("#modalAdicionarPecas").modal("toggle");
});

$('#adicionarDesconto').on('click', () => {
    $("#modalAdicionarPromos").modal("toggle");
});

$('#adicionarCarros').on('click', () => {
    $("#modalAdicionarCarros").modal("toggle");
});

$('#editarPecas').on('click', () => {
    $("#modalEditarPecas").modal("toggle");
});


$('#aadicionarPecas').on('click', () => {
    $("#modalAdicionarPecas").modal("toggle");
    $("#modalEditarPecas").modal("hide")
});

$('#aadicionarCarros').on('click', () => {
    $("#modalAdicionarCarros").modal("toggle");
});

function gerenciarExibicaoUsuario() {
    if (usuarioExiste) {
        $("#adicionarCarros, #adicionarDesconto, #adicionarPecas, #editarPecas").show();
        $(".login").hide();
        $(".logout, .botao").show();
    } else {
        $("#adicionarCarros, #adicionarPecas, #adicionarDesconto, #editarCarros, #editarPecas").hide();
        $(".logout, .botao").hide();
    }
    console.log($(".botao").length > 0 ? 'Botão existe no DOM' : 'Botão não existe no DOM');
}

const buscarPaginas = async (exibir) => {
    try {
        const response = await buscarQuantidadeTotalPaginas(exibir);
        adicionarPaginas(response);
    } catch (exception) {

    }
};

async function buscarQuantidadeTotalPaginas(exibir) {
    const urlPesquisarPecas = `/${urlBase}/parts/buscar-quantidade-total-paginas`;

    return await $.getJSON(
        `${urlPesquisarPecas}?exibir=${exibir}&searchPart=${searchPart}`);
}

const adicionarPaginas = (response) => {

    if (response.hasError) {

    } else {
        const paginas = response.data;
        $('#pagination').empty;
        for (let i = 1; i <= paginas.length; i++) {
            const liElement = $(`<li class="pagination"><span>${i}</span></li>`);

            criarEventoOnClick(liElement)

            $('#pagination').append(liElement);
        }
        $("li.pagination").first().addClass("active");
    }
}

const carregarPaginaPrimeiraVez = async () => {
    try {
        const response = await buscarPecas(exibir, paginaAtual);
        adicionarPecas(response);
    } catch (exception) {

    }
}

const criarEventoOnClick = (liElement) => {

    liElement.on('click', async (event) => {
        $("li.active").removeClass("active");

        paginaAtual = $(event.target).text();

        $(event.target).closest('li').addClass("active");

        try {
            const response = await buscarPecas(exibir, paginaAtual);
            adicionarPecas(response);
        } catch (exception) {

        }

    });
}

async function buscarPecas(exibir, paginaAtual) {
    const urlPesquisarPecas = `/${urlBase}/parts/buscar-pecas`;

    return await $.getJSON(
        `${urlPesquisarPecas}?exibir=${exibir}&pagina=${paginaAtual}&searchPart=${searchPart}`);
}

const adicionarPecas = (response) => {

    if (response.hasError) {

    } else {
        const pecas = response.data;

        $('#parts').empty();

        for (const peca of pecas) {

            const liElement = $(`<div class="part"><div class="botao"><button class="excluir"><i class="fa-solid fa-xmark excluirPeca" data-id="${peca.id}"></i></button></div><div class="img" id="${peca.id}"><img src="img/parts/${peca.image}" alt="${peca.name}"></div><p>${peca.name}</p><span>R$ ${peca.price}</span><a href="https://wa.me/48998404930?text=Olá, gostaria de comprar o produto ${peca.name}, que custa R$ ${peca.price}." target="_blank" class="comprar">Comprar</a></div>`);

            $('#parts').append(liElement);
        }
        gerenciarExibicaoUsuario();
    }
}

$('#btnSearch').on('click', async () => {
    searchPart = $('#searchParts').val();
    paginaAtual = 1;
    try {
        $('#pagination').empty();

        buscarPaginas(exibir);
        const response = await buscarPecas(exibir, paginaAtual);
        adicionarPecas(response);
        rolarTela();
    } catch (exception) {

    }
})

$('#searchParts').on('keyup', async (event) => {
    if (event.key === "Enter") {
        searchPart = $('#searchParts').val();
        paginaAtual = 1;
        try {
            $('#pagination').empty();

            buscarPaginas(exibir);
            const response = await buscarPecas(exibir, paginaAtual);
            adicionarPecas(response);
            rolarTela();
        } catch (exception) {

        }
    }
})

$('#buttonCatalogo').on('click', () => {
    rolarTela();
})

$('#buttonPromocoes').on('click', () => {
    rolarTelaPromo();
})

const rolarTela = () => {
    const catalogo = document.getElementById('catalogo');

    const catalogoPosicao = catalogo.getBoundingClientRect().top + window.scrollY;

    window.scrollTo({
        top: catalogoPosicao - 50,
        behavior: 'smooth'
    });
}

const rolarTelaPromo = () => {
    const promo = document.getElementById('sale');

    const promoPosicao = promo.getBoundingClientRect().top + window.scrollY;

    window.scrollTo({
        top: promoPosicao - 85,
        behavior: 'smooth'
    });
}

async function pesquisarCarros(carName) {
    const urlPesquisarCarros = `/${urlBase}/cars/pesquisar-carros`;

    return await $.getJSON(
        `${urlPesquisarCarros}?carName=${carName}`);
}