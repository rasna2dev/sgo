let protocol = window.location.protocol;
let hostname = window.location.hostname;
let port = window.location.port;
let urlDominio = protocol + '//' + hostname + (port.length > 0 ? ':' + port : '');

function atualizarSelect(data, s) {
    let entries = Object.entries(data);
    entries.sort((a, b) => a[1].localeCompare(b[1]));

    let select = document.getElementById(s);

    select.innerHTML = '';
    let option = document.createElement('option');
    option.value = '';
    option.text = 'Selecione';
    select.appendChild(option);

    let st = false;

    for (let [key, value] of entries) {
        let option = document.createElement('option');
        option.value = key;
        option.text = value;

        switch(s) {
            case 'busca_cidade': {
                st = busca_cidade_id == key;
                break;
            }
            case 'busca_bairro': {
                st = busca_bairro_id == key;
                break;
            }
        }

        option.selected = st;
        select.appendChild(option);
    }
}

function getAjax(o, u) {
    let xhr = new XMLHttpRequest();
        u = url + u;

    xhr.open('GET', u, false);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let r = JSON.parse(xhr.responseText);
            return atualizarSelect(r.data, o);
        }
    };
    xhr.send();
}


function carregarCidade(id) {
    return getAjax('busca_cidade', '?req=1&busca_estado=' + id);
}

function carregarBairro(id) {
    return getAjax('busca_bairro', '?req=1&busca_cidade=' + id);
}

document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('busca_estado').addEventListener('change', function() {
        alert(1);
        return carregarCidade(this.value);
    });

    document.getElementById('busca_cidade').addEventListener('change', function() {
        return carregarBairro(this.value);
    });

    if(document.getElementById('combo_paginacao') !== null) {
        document.getElementById('combo_paginacao').addEventListener('change', function() {
            let pagina = this.dataset.url;
                pagina += '&page=' + this.value;
            window.location.href = pagina;
        });
    }

     if(imagens.length > 0) {
        let u = null;
        for(let i = 0; i < imagens.length; i++) {
                u = urlDominio;
                u += '/foto/' + imagens[i];
                u += '?w=570';
            document.getElementById( 'img-' + imagens[i] ).src = u;
        }
    }


    if(busca_estado_id > 0) {
        carregarCidade(busca_estado_id);
    }

    if(busca_cidade_id > 0) {
        carregarBairro(busca_cidade_id);
    }


});
