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

$(".anexoEdit").change((event) => {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreviewEdit').attr('src', '').hide();
            $('#imagePreviewEdit').attr('src', e.target.result).show();
        };
        reader.readAsDataURL(input.files[0]);
    }
});

const dropAreaEdit = document.getElementById('dropAreaEdit');
const inputFileEdit = document.getElementById('imageEdit'); 
const imagePreviewEdit = document.getElementById('imagePreviewEdit');
const iconEdit = document.getElementById('iconeEdit');

function handleFile(file) {
    const reader = new FileReader();

    reader.onload = function (e) {
        imagePreviewEdit.src = e.target.result;
        imagePreviewEdit.hidden = false;
        iconEdit.style.display = 'none';
    };

    reader.readAsDataURL(file);
}

inputFileEdit.addEventListener('change', function (event) {
    if (event.target.files && event.target.files[0]) {
        handleFile(event.target.files[0]);
    }
});

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropAreaEdit.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropAreaEdit.addEventListener(eventName, () => dropAreaEdit.classList.add('dragover'), false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropAreaEdit.addEventListener(eventName, () => dropAreaEdit.classList.remove('dragover'), false);
});

dropAreaEdit.addEventListener('drop', function (e) {
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        inputFileEdit.files = files; 
        handleFile(files[0]); 
    }
}, false);


$('.nameCarsSearchEdit').on('input', async (event) => {

    console.log('O input é: ', $('.nameCarsSearchEdit').val()); 
    
    try {
        console.log($('.nameCarsSearchEdit'));
        const carsElementEdit = $('.carsResultEdit');
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

$('.nameCarsSearchEdit').on('blur', () => {
    setTimeout(() => {
        $('.carsResultEdit').hide();
    }, 300);
});

$('.nameCarsSearchEdit').on('focus', () => {
    const resultEditCarLength = $('.carsResultEdit').children().length;
    if (resultEditCarLength > 0) {
        $('.carsResultEdit').show();
    }
});

$('.carsResultEdit').on('click', (event) => {
console.log($('.carsResultEdit'));
    const liSelected = $(event.target);

    if(liSelected.is('li')){

        if($(`.cars-viewEdit input[value="${liSelected.attr('data-id')}"]`).length > 0){
            return;
        }

        const carsViewLength = $('.cars-viewEdit li').length;
        const liElementCars = $(
            `<li title="${liSelected.text()}">
            <input type="hidden" value="${liSelected.attr('data-id')}" name="cars[${carsViewLength}][id]">
            <span>${liSelected.text()}</span>
            <i class="fa-solid fa-xmark button-remove"></i>
        </li>`
        );

        $('.cars-viewEdit').append(liElementCars);
        $('.carsResultEdit').hide();
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