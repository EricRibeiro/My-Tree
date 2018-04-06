jQuery(function ($) {
    mudarInfoAbaAtiva();
});

function mudarInfoAbaAtiva() {
    var nomeDoCaminho = window.location.pathname;
    nomeDoCaminho = nomeDoCaminho.substring(nomeDoCaminho.lastIndexOf('/') + 1);

    if(nomeDoCaminho === "investidor" || nomeDoCaminho === "concedente" || nomeDoCaminho === "concedente" ||
        nomeDoCaminho === "plantador")
        nomeDoCaminho = "dashboard";

    var $abas = $('.aba');
    $abas.removeClass('active');

    var $abaAtual = $('.' + nomeDoCaminho);
    $abaAtual.addClass('active');

    $('.navbar-brand').text(nomeDoCaminho).css('textTransform', 'capitalize');
}