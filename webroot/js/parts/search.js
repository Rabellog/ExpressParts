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

            const elementPart = $(`<div class="part"><div class= "img"><img src="img/parts/${part.image}" alt="${part.image}"></div><p>${part.name}</p><span>R$ ${part.price}</span><a href="https://wa.me/48998404930?text=Olá, gostaria de comprar o produto ${part.name}, que custa R$ ${part.price}." target="_blank" class="comprar">Comprar</a></div>`);
            
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