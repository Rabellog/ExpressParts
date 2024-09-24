$('#adicionarPecas').on('click', () => {
    $("#modalAdicionarPecas").modal("toggle");
});

$('#nameCarsSearch').on('input', async (e) => {
    const carName = $(e.target).val();
    const response = await pesquisarCarros(carName);
})

async function pesquisarCarros (carName){
    const urlBase = window.location.pathname.split("/")[1];
    const urlPesquisarCarros = `/${urlBase}/parts/pesquisar-carros`;

    return await $.getJSON(
        `${urlPesquisarCarros}?carName=${carName}`); 
}

$(document).ready(function() {
    $('#nameCarsSearch').on('input', function() {
        if ($(this).val().trim() !== '') {
            $('.carsResult').removeClass('hidden').css('display', 'flex');
        } else {
            $('.carsResult').addClass('hidden').css('display', 'none');
        }
    });

    $(document).on('click', function(event) {
        if (!$(event.target).closest('.carsSearch').length) {
            $('.carsResult').addClass('hidden').css('display', 'none');
        }
    });
});
