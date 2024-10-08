const urlBase = window.location.pathname.split("/")[1];
const addPart = (response) => {
    if (response.hasError) {
    } else {
        const partResult = response.data[0];
        console.log(partResult.name);
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
    const urlPesquisarPecas = `/${urlBase}/parts/pesquisar-pecas-desconto`;
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
    setTimeout(() => {
        $('#partsResult').hide();
    }, 300)
});
$('#namePartsSearch').on('focus', () => {
    const partsResultLength = $('#partsResult').children().length;
    if (partsResultLength > 0) {
        $('#partsResult').show();
    }
})
$('#partsResult').on('click', async (event) => {
    const lipSelected = $(event.target);
    if (lipSelected.is('li')) {
        const partId = lipSelected.data('id');
        const response = await pesquisarPecaPorId(partId);
        addPart(response);
        $('#partsResult').hide();
    }
});
async function pesquisarPecaPorId(partId) {
    const urlBase = window.location.pathname.split("/")[1];
    const urlPesquisaPecaPorId = `/${urlBase}/parts/pesquisar-pecas-por-id`;
    return await $.getJSON(
        `${urlPesquisaPecaPorId}?partId=${partId}`);
}
const addParts = (response, partsElement) => {
    if (response.hasError) {
    }
    const partResult = response.data;
    if (partResult.length > 0) {
        partsElement.show();
        partsElement.empty();
        for (const part of partResult) {
            const liElement = $(`<li title="${part.name}" data-id="${part.id}" class="part-item">${part.name}</li>`);
            partsElement.append(liElement);
        }
    } else {
        partsElement.hide();
    }
}
const addDesconto = async (partId, discount) => {
    try {
        const response = await $.ajax({
            type: "POST",
            url: `/${urlBase}/parts/add-desconto/${partId}`,
            data: { discount: discount },
            dataType: "json"
        });
        if (response.hasError) {
            alert(response.message);
        } else {
            alert('Desconto adicionado com sucesso!');
        }
    } catch (error) {
        console.error("Erro ao adicionar desconto:", error);
        alert("Erro ao adicionar desconto. Tente novamente.");
    }
};
$('#applyDiscount').on('click', async (event) => {
    event.preventDefault();
    const discount = $('#partDiscountValue').val();
    const partId = $('#partsResult').data('id');
    const $button = $(event.currentTarget);
    if (!partId) {
        alert("Por favor, selecione uma peça antes de aplicar o desconto.");
        return;
    }
    if (!discount) {
        alert("Por favor, preencha o campo do desconto (0 - 100).");
        return;
    }
    $button.prop('disabled', true).text('Aplicando...');
    try {
        await addDesconto(partId, discount);
        alert("Desconto aplicado com sucesso.");
    } catch (error) {
        console.error("Erro ao aplicar desconto:", error);
        alert("Erro ao aplicar desconto. Tente novamente.");
    } finally {
        $button.prop('disabled', false).text('Aplicar Desconto');
    }
});