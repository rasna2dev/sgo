
let retornoSucesso = function(r) {
    $('._resposta').removeClass('hide');
    $('._resposta > div').removeClass('alert-danger');
    $('._resposta > div').addClass('alert-success');
    $('._resposta > div > ul').remove();

    let ul = $('<ul/>');
    let li = $('<li>'+ r.message +'</li>');
    ul.append(li);
    $('._resposta > div').append(ul);

    let url = window.location.href;
    let parametros = url.split("?")[1];
    let tempoEspera = 4000;

    setTimeout(function() {
        if (typeof parametros === 'undefined') {
            window.location.href = url;
        } else {
            window.location.href = url + parametros;
        }
    }, tempoEspera);
}

let retornoErro = function(xhr, status, error) {
    $('._resposta').removeClass('hide');
    $('._resposta > div').removeClass('alert-success');
    $('._resposta > div').addClass('alert-danger');
    $('._resposta > div > ul').remove();

    var ul = $('<ul/>');

    $.each(xhr.responseJSON.errors, function(chave, valor) {
        if (Array.isArray(valor)) {
            $.each(valor, function(index, mensagem) {
                var li = $('<li>'+ mensagem +'</li>');
                ul.append(li);
            });
        } else {
            var li = $('<li>'+ valor +'</li>');
            ul.append(li);
        }
    });

    $('._resposta > div').append(ul);

    var tempoEspera = 4000;

    setTimeout(function() {
        $('._resposta').addClass('hide');
        $('._resposta > div').removeClass('alert-success');
    }, tempoEspera);
}




