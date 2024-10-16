const exibir = 10;
var searchPart = "";
let paginaAtual = 1;

$(document).ready(function () {
    gerenciarExibicaoUsuario();
    $("li").first().addClass("active");
    buscarPaginas(exibir);
    carregarPaginaPrimeiraVez();
});

function gerenciarExibicaoUsuario() {
    if (usuarioExiste) {
        $("#adicionarCarros").show();
        $("#adicionarDesconto").show();
        $("#adicionarPecas").show();
        $(".login").hide();
        $(".logout").show();
        $("#editarCarros").show();
        $("#editarPecas").show();
    } else {
        $("#adicionarCarros").hide();
        $("#adicionarPecas").hide();
        $("#adicionarDesconto").hide();
        $(".logout").hide();
        $("#editarCarros").hide();
        $("#editarPecas").hide();
    }
}

const buscarPaginas = async (exibir) => {

    try {
        const response = await buscarQuantidadeTotalPaginas(exibir);
        adicionarPaginas(response);
    } catch (exception) {

    }
};

async function buscarQuantidadeTotalPaginas(exibir) {
    const urlBase = window.location.pathname.split("/")[1];
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
    const urlBase = window.location.pathname.split("/")[1];
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

            const liElement = $(`<div class="part"><div class="img"><img src="img/parts/${peca.image}" alt="${peca.name}"></div><p>${peca.name}</p><span>R$ ${peca.price}</span><a href="https://wa.me/48998404930?text=Olá, gostaria de comprar o produto ${peca.name}, que custa R$ ${peca.price}." target="_blank" class="comprar">Comprar</a></div>`);

            $('#parts').append(liElement);
        }
    }
}

//search

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

$('#catalogoNav').on('click', () => {
    rolarTela();
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

// add peças

const dropArea = document.getElementById('dropArea');
const inputFile = document.getElementById('image');
const imagePreview = document.getElementById('imagePreview');
const icon = document.getElementById('icone');

document.getElementById('image').addEventListener('change', function (event) {

    if (event.target.files && event.target.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            icon.style.display = 'none';
        };

        reader.readAsDataURL(event.target.files[0]);
    }
});

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, () => dropArea.classList.add('dragover'), false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, () => dropArea.classList.remove('dragover'), false);
});

dropArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const files = e.dataTransfer.files;
    inputFile.files = files;
    handleFile(files[0]);
}

inputFile.addEventListener('change', function (event) {
    if (event.target.files && event.target.files[0]) {
        handleFile(event.target.files[0]);
    }
});

function handleFile(file) {
    const reader = new FileReader();

    reader.onload = function (e) {
        imagePreview.src = e.target.result;
        imagePreview.hidden = false;
        icon.style.display = 'none';
    };

    reader.readAsDataURL(file);
}