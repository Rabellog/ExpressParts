if (usuarioExiste) {
    $("#adicionarCarros").show();
    $("#adicionarCarros").show();
    $(".login").hide();
    $(".logout").show();
    $("#adicionarDesconto").show();
} else {
    $("#adicionarCarros").hide();
    $("#adicionarPecas").hide();
    $(".logout").hide();
    $("#adicionarDesconto").hide();
}