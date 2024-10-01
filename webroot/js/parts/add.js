const addCars = (response, carsElement) => {

    if (response.hasError) {

    } else {


        const carResult = response.data;

        if (carResult.length > 0) {

            carsElement.show();

            for (const car of carResult) {
                const liElement = $(`<li title="${car.name}" data-id="${car.id}" class="car-item">${car.name}</li>`);
                carsElement.append(liElement);
            }
        }
    }

}

async function pesquisarCarros(carName) {
    const urlBase = window.location.pathname.split("/")[1];
    const urlPesquisarCarros = `/${urlBase}/cars/pesquisar-carros`;

    return await $.getJSON(
        `${urlPesquisarCarros}?carName=${carName}`);
}

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

console.log($('#modalAdicionarCarros'));

$('#nameCarsSearch').on('input', async (event) => {

    try {
        const carsElement = $('#carsResult');


        const carName = $(event.target).val();
        if (carName.length > 0) {
            carsElement.empty();
            const response = await pesquisarCarros(carName);
            addCars(response, carsElement);
        } else {
            carsElement.hide();
        }
    } catch (exception) {

    }

});

$('#nameCarsSearch').on('blur', (event) => {
    setTimeout(()=>{
      $('#carsResult').hide();
    },300)
});

$('#nameCarsSearch').on('focus', () => {
    const carsResultLength = $('#carsResult').children().length;
    if (carsResultLength > 0) {
        $('#carsResult').show();
    }
})

$('#carsResult').on('click', (event) => {

    const liSelected = $(event.target);

    if(liSelected.is('li')){

        if($(`.cars-view input[value="${liSelected.attr('data-id')}"]`).length > 0){
            return;
        }

        const carsViewLength = $('.cars-view li').length;
        const liElement = $(
            `<li title="${liSelected.text()}">
            <input type="hidden" value="${liSelected.attr('data-id')}" name="cars[${carsViewLength}][id]">
            <span>${liSelected.text()}</span>
            <i class="fa-solid fa-xmark button-remove"></i>
        </li>`
        );


        liElement.find('.button-remove').on('click', () => {
            liElement.remove();
        })

        $('.cars-view').append(liElement);
        $('#carsResult').hide();
    }
});

$(".anexo").change((event) => {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').attr('src', e.target.result).show();
        };
        reader.readAsDataURL(input.files[0]);
    }
});

////////////////////////////////////////////////////////////////////////////

const addPart = (response) => {

    if (response.hasError) {

    } else {

        const partResult = response.data[0];

        const formSale = ($('#formSale').attr('action'));
        const name = $('#partDiscountName');
        const price = $('#partDiscountPrice');
        const stock = $('#partDiscountStock');
        const discount = $('#partDiscountValue');
        const applyDiscount = $('#applyDiscount');
        
        $('#formSale').attr('action', `${formSale}/${partResult.id}`)
        name.val(partResult.name);
        price.val(partResult.price);
        discount.val(partResult.discount);
        stock.val(partResult.stock);
        applyDiscount.text(partResult.applyDiscount);


    }
}

async function pesquisarPecas(partName) {
    const urlBase = window.location.pathname.split("/")[1];
    const urlPesquisarPecas = `/${urlBase}/parts/pesquisar-pecas`;

    return await $.getJSON(
        `${urlPesquisarPecas}?partName=${partName}`);
}

$('#namePartsSearch').on('input', async (event) => {

    try {
        const partsElement = $('#partsResult');
        const partName = $(event.target).val();
        if (partName.length > 0) {
            partsElement.empty();
            const response = await pesquisarPecas(partName);
            addParts(response, partsElement);
        } else {
            partsElement.hide();
        }
    } catch (exception) {
    }
});

$('#namePartsSearch').on('blur', (event) => {
    setTimeout(()=>{
      $('#partsResult').hide();
    },300)
});

$('#namePartsSearch').on('focus', () => {
    const partsResultLength = $('#partsResult').children().length;
    if (partsResultLength > 0) {
        $('#partsResult').show();
    }
})

 $('#partsResult').on('click',async (event) => {

    const lipSelected = $(event.target);

    if(lipSelected.is('li')){
        const partId = lipSelected.data('id');
       
        const response = await pesquisarPecaPorId(partId);
        addPart(response);
        $('#partsResult').hide();
    }
});

async function pesquisarPecaPorId(partId){
    const urlBase = window.location.pathname.split("/")[1];
    const urlPesquisaPecaPorId = `/${urlBase}/parts/pesquisar-pecas-por-id`;

    return await $.getJSON(
        `${urlPesquisaPecaPorId}?partId=${partId}`);
}

const addParts = (response,partsElement) => {

    if (response.hasError) {

    } else {


        const partResult = response.data;

        if (partResult.length > 0) {

            partsElement.show();

            for (const part of partResult) {
                const lipElement = $(`<li title="${part.name}" data-id="${part.id}" class="part-item">${part.name}</li>`);
                partsElement.append(lipElement);
            }
        }
    }
}

