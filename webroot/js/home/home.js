// home

const exibir = 10;
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

$('#editarCarros').on('click', () => {
    $("#modalEditarCarros").modal("toggle");
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
    $("#modalEditarCarros").modal("hide")
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

            const liElement = $(`<div class="part"><div class="img" id="${peca.id}"><img src="img/parts/${peca.image}" alt="${peca.name}"></div><p>${peca.name}</p><span>R$ ${peca.price}</span><a href="https://wa.me/48998404930?text=Olá, gostaria de comprar o produto ${peca.name}, que custa R$ ${peca.price}." target="_blank" class="comprar">Comprar</a></div>`);

            $('#parts').append(liElement);
        }
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

async function pesquisarCarros(carName) {
    const urlPesquisarCarros = `/${urlBase}/cars/pesquisar-carros`;

    return await $.getJSON(
        `${urlPesquisarCarros}?carName=${carName}`);
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

// edit peças

$(document).on('click', '.img', async function () {
    const partId = $(this).attr('id');
    console.log("ID da peça:", partId);

    try {
        const response = await pesquisarPecaPorId(partId);
        console.log("Resposta do servidor (pesquisarPecaPorId):", response);

        if (!response) {
            throw new Error("Resposta inválida ao pesquisar a peça");
        }

        console.log("Chamando pesquisarCarrosRelacionados com partId:", partId);
        const response1 = await pesquisarCarrosRelacionados(partId);
        console.log("Resposta do servidor (pesquisarCarrosRelacionados):", response1);

        if (!response1) {
            throw new Error("Resposta inválida ao pesquisar carros relacionados");
        }

        buscarInformacoesPart(response, response1);

    } catch (error) {
        console.error('Erro capturado:', error.message || error);
    }
});

const buscarInformacoesPart = (response, response1) => {
    if (response.hasError) {
        console.error("Erro ao buscar informações da peça.");
    } else if (response.data.length === 0) {
        alert('Nenhuma peça encontrada!');
    } else {
        const part = response.data[0];
        const cars = response1.data;

        $("#selectedPartId").val(part.id);
        $(".namePart").val(part.name);
        $(".stock").val(part.stock);
        $(".price").val(part.price);
        $("#iconeEdit").hide();

        if (part.image) {
            $(".imagePreview").attr("src", `img/parts/${part.image}`).show();
        } else {
            $(".imagePreview").hide();
        }

        let carsList = '';
        const carsViewLength = $('#cars-viewEdit li').length;
        cars.forEach((car) => {
            carsList += `<li title="${car.name}">
                <input type="hidden" value="${car.id}" name="cars[${carsViewLength}][id]">
                <span>${car.name}</span>
                <i class="fa-solid fa-xmark button-remove" id="${car.id}"></i>
            </li>`;
        });
        console.log(carsList);
        $("#cars-viewEdit").html(carsList);

        $("#modalEditarPecas").modal("show");
    }
};

const dropAreaEdit = document.getElementById('dropAreaEdit');
const inputFileEdit = document.getElementById('image');
const imagePreviewEdit = document.getElementById('imagePreview');
const iconEdit = document.getElementById('iconeEdit');

document.getElementById('image').addEventListener('change', function (event) {
    if (event.target.files && event.target.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreviewEdit.src = '';
            imagePreviewEdit.hidden = true;

            imagePreviewEdit.src = e.target.result;
            imagePreviewEdit.hidden = false;
            iconEdit.style.display = 'none';
        };

        reader.readAsDataURL(event.target.files[0]);
    }
});

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropAreaEdit.addEventListener(eventName, preventDefaultsEdit, false);
});

function preventDefaultsEdit(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropAreaEdit.addEventListener(eventName, () => dropAreaEdit.classList.add('dragover'), false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropAreaEdit.addEventListener(eventName, () => dropAreaEdit.classList.remove('dragover'), false);
});

dropAreaEdit.addEventListener('drop', handleDropEdit, false);

function handleDropEdit(e) {
    const files = e.dataTransfer.files;
    inputFileEdit.files = files;
    handleFileEdit(files[0]);
}

inputFileEdit.addEventListener('change', function (event) {
    if (event.target.files && event.target.files[0]) {
        handleFileEdit(event.target.files[0]);
    }
});

function handleFileEdit(file) {
    const reader = new FileReader();

    reader.onload = function (e) {
        imagePreviewEdit.src = '';
        imagePreviewEdit.hidden = true;

        imagePreviewEdit.src = e.target.result;
        imagePreviewEdit.hidden = false;
        iconEdit.style.display = 'none';
    };

    reader.readAsDataURL(file);
}

$('#nameCarsSearchEdit').on('input', async (event) => {

    console.log('O input é: ', $('#nameCarsSearchEdit').val()); 
    
    try {
        console.log($('#nameCarsSearchEdit'));
        const carsElementEdit = $('#carsResultEdit');
        console.log(carsElementEdit);

        const carName = $(event.target).val();
        if (carName.length > 0) {
            carsElementEdit.empty();
            const response = await pesquisarCarros(carName);
            addCarsEdit(response, carsElementEdit);
        } else {
            carsElementEdit.hide();
        }
    } catch (exception) {

    }
});

$('#nameCarsSearchEdit').on('blur', () => {
    setTimeout(() => {
        $('#carsResultEdit').hide();
    }, 300);
});

$('#nameCarsSearchEdit').on('focus', () => {
    const resultEditCarLength = $('#carsResultEdit').children().length;
    if (resultEditCarLength > 0) {
        $('#carsResultEdit').show();
    }
});

const addCarsEdit = (response, carsElementEdit) => {

    if (response.hasError) {

    } else {


        const carResultEdit = response.data;

        if (carResultEdit.length > 0) {

            carsElementEdit.show();

            for (const car of carResultEdit) {
                const liElementAdd = $(`<li title="${car.name}" data-id="${car.id}" class="car-item">${car.name}</li>`);
                carsElementEdit.append(liElementAdd);
            }
        }
    }
}

$(document).on('click', '.button-remove', async function () {
    const carId = $(this).attr('id');
    const partId = $("#selectedPartId").val();
    console.log(carId, partId);

    try {
        const response = await removerRelacao(carId, partId);

        if (!response.hasError) {

            $(this).closest('li').remove();
        } else {
            console.log('Erro ao remover a relação');
        }
    } catch (exception) {
        console.error('Erro ao tentar remover a relação:', exception);
    }
});

async function removerRelacao(carId, partId) {
    const urlPesquisarPecas = `/${urlBase}/pecasECarros/remover`;

    return await $.getJSON(
        `${urlPesquisarPecas}?carId=${carId}&partId=${partId}`);
}

$('#editar').on('click', () => {
    const partId = $("#selectedPartId").val();
    const action = $("#formPartEdit").attr('action');
    $("#formPartEdit").attr('action', `${action}/${partId}`);
});