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

// $('#nameCarsSearch').on('blur', (event) => {
//     event.preventDefault();
//     $('#carsResult').hide();
//     $(event).blur();
// })

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