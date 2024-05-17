<form
    action="{{ route("{$currentRouteName}.index") }}"
    method="GET">
    @csrf

    <div class="row">
        <div class="col-sm-3 text-left">
            <a class="btn btn-primary waves-effect modalTarifa"
                data-toggle="modal"
                data-target="#largeModal"
                data-acao="cadastrar"
                data-id="0"
                data-valor_prazo="0"
                data-valor_inicial="0"
                data-valor_final="0"
                data-valor_desconto="0"
                data-valor_condominio="0"
                data-valor_entrada="0"
                data-valor_documentacao="0"
                data-valor_desocupacao="0"
                data-valor_reforma="0"
                data-valor_despesa_venda="0"
                data-valor_despesa_extra="0"
                data-ativo="1"
            >
                <i class="material-icons">save</i>
                <span>CADASTRAR</span>
            </a>
        </div>
    </div>
</form>
