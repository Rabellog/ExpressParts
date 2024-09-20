if (usuarioExiste) {
    $("adicionarCarros").show();
    $("adicionarCarros").show();
    $(".login").hide();
    $(".logout").show();
} else {
    $("#adicionarCarros").hide();
    $("#adicionarPecas").hide();
    $(".logout").hide();
}