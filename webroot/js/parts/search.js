$('#btnSearch').on('click', async () => {
    const searchParts = $('#searchParts').val();
    try {
        const response = await pesquisarPecasCatalogo(searchParts);
        addPartsCatalogo(response);
    } catch (exception) {

    }
})

const pesquisarPecasCatalogo = async (searchParts) => {
    const urlBase = window.location.pathname.split("/")[1];
    const urlPesquisarPecas = `/${urlBase}/parts/pesquisar-pecas-catalogo`;

    return await $.getJSON(
        `${urlPesquisarPecas}?partName=${searchParts}`);
}

const addPartsCatalogo = (response) => {

    if (response.hasError) {

    } else {
        $('.parts').empty();

        for (const part of response.data) {

            const elementPart = $(`<div class="part"><div class= "img"><img src="img/parts/${part.image}" alt="${part.image}"></div><p>${part.name}</p><span>R$ ${part.price}</span><button type="button" class="comprar">Comprar</button></div>`);

            $('.parts').append(elementPart);
        }

        const catalogo = document.getElementById('catalogo');

        const catalogoPosicao = catalogo.getBoundingClientRect().top + window.scrollY;

        window.scrollTo({
            top: catalogoPosicao - 50,
            behavior: 'smooth'
        });
    }
}