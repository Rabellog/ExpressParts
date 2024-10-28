$(document).on('click', '.fa-solid.fa-xmark.excluirPeca', function () {
    const partId = $(this).data('id'); 
    console.log(partId);  

    $('#modalConfirmacaoExclusao').find('#excluir').data('part-id', partId);
    
    $('#modalConfirmacaoExclusao').modal("toggle");
});

$('#excluir').on('click', function () {
    const partId = $(this).data('part-id'); 

    if (partId) {
        const action = $("#formPartDelete").attr('action');
        $("#formPartDelete").attr('action', `${action}/${partId}`);
    } else {
        console.log("Part ID não encontrado");
    }
});
