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

const addCarsEdit = (response) => {
    if (response.hasError) {

    } else {
        const carResultEdit = response.data;

        if (carResultEdit.length > 0) {
            carResultEdit.forEach(car => {
                const liElementEdit = $(`<li title="${car.name}"><input type="hidden" value="${car.id}" name="cars[${$('.cars-viewEdit li').length}][id]"><span>${car.name}</span><div><i class="fa-solid fa-trash"></i><span type="button" id="aadicionarCarros"><i class="fa-solid fa-pen"></i></span></div></li>`);

                $('.cars-viewEdit').append(liElementEdit);

                liElementEdit.find('.fa-trash').on('click', () => {
                    liElementEdit.remove();
                });
            });
        }
    }
}

async function pesquisarCarros(carName) {
    const urlBase = window.location.pathname.split("/")[1];
    const urlPesquisarCarros = `/${urlBase}/cars/pesquisar-carros`;
    console.log(`URL being called: ${urlPesquisarCarros}?carName=${carName}`);

    return await $.getJSON(`${urlPesquisarCarros}?carName=${carName}`)
}

$('#nameCarsSearchEdit').on('input', async (event) => {
    try {
        const carName = $(event.target).val().trim();

        $('.cars-viewEdit').empty();

        if (carName.length > 0) {
            const response = await pesquisarCarros(carName);
            addCarsEdit(response); 
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

const addCars = (response, carsElement) => {

    if (response.hasError) {

    } else {


        const carResult = response.data;

        if (carResult.length > 0) {

            carsElement.show();

            for (const car of carResult) {
                const liElementAdd = $(`<li title="${car.name}" data-id="${car.id}" class="car-item">${car.name}</li>`);
                carsElement.append(liElementAdd);
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
        const liElementCars = $(
            `<li title="${liSelected.text()}">
            <input type="hidden" value="${liSelected.attr('data-id')}" name="cars[${carsViewLength}][id]">
            <span>${liSelected.text()}</span>
            <i class="fa-solid fa-xmark button-remove"></i>
        </li>`
        );

        $('.cars-view').append(liElementCars);
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
