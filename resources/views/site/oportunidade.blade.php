
@extends('site')

@section('title', $tags->title)
@section('description', $tags->description)
@section('keywords',  $tags->keywords)

@section('content')

    @section('content')
    @include('site.inc.swiper')

    @php $images = [] @endphp

    <section class="section section-lg bg-gray-lighter text-center novi-background bg-cover" style="padding-top: 0">
        <div class="container container-bigger form-request-wrap form-request-wrap-modern">
            <div class="row">
                <iframe  width="100%" height="315" src="https://www.youtube.com/embed/SEtX6pvWn00" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="row row-fix justify-content-sm-center justify-content-lg-end">
                <div class="col-12">
                    <div class="row form-request form-request-modern bg-gray-lighter novi-background background-white">
                        <div class="row">
                            <div class="col-xs-12 text-left">
                                <h3>
                                    &nbsp;{{ $imovel->sigla }}, {{ $imovel->cidade }}
                                    <span class="hidden-xs">- {{ $imovel->matricula_id }}</span>
                                </h3>
                                <hr class="divider divider-left divider-secondary">
                            </div>
                            <div class="col-xs-12 text-center">
                                <figure class="event-default-image">
                                    @if(!is_null($imovel->imagem) && $imovel->imagem <> '#')
                                        @php $images[] = $imovel->imagem @endphp
                                        <img id="img-{{ $imovel->imagem }}" alt="{{ "{$imovel->sigla}, {$imovel->cidade} - {$imovel->matricula_id}" }}" class="img-fluid">
                                    @else
                                        <img src="{{ url('foto/indisponivel.png') }}" alt="{{ "{$imovel->sigla}, {$imovel->cidade} - {$imovel->matricula_id}" }}" class="img-fluid">
                                    @endif
                                </figure>
                            </div>

                            <div class="col-xs-12 col-md-6 text-left">
                                <strong>Matrícula:</strong><br>
                                <a href="{{ is_null($imovel->link_matricula) ? $imovel->link : $imovel->link_matricula  }}" target="_blank">
                                    {{ $imovel->matricula_id }}
                                </a>
                            </div>
                            <div class="col-xs-12 col-md-6 text-left">
                                <strong>Estado:</strong><br>
                                {{ $imovel->estado }}
                            </div>
                            <div class="col-12 text-left">
                                <strong>Cidade:</strong><br>
                                {{ $imovel->cidade }}
                            </div>
                            <div class="col-xs-12 col-md-3 text-left">
                                <strong>Tipo:</strong><br>
                                {{ $imovel->unidade }}
                            </div>
                            <div class="col-xs-12 col-md-9 text-left">
                                <strong>Bairro:</strong><br>
                                {{ $imovel->bairro }}
                            </div>
                            <div class="col-xs-12 col-md-12 text-left">
                                <strong>Endereço:</strong><br>
                                {{ $imovel->endereco }}
                            </div>

                            {{-- <div class="col-xs-12 col-md-3 text-left">
                                <strong>Área Privativa:</strong><br>
                                @if($imovel->area_privativa > 0)
                                    {{ $imovel->area_privativa }}
                                @else
                                    Não informada
                                @endif
                            </div>
                            <div class="col-xs-12 col-md-3 text-left">
                                <strong>Área Terreno:</strong><br>
                                @if($imovel->area_terreno > 0)
                                    {{ $imovel->area_terreno }}
                                @else
                                    Não informada
                                @endif
                            </div>
                            <div class="col-xs-12 col-md-3 text-left">
                                <strong>&nbsp;</strong><br>
                                &nbsp;
                            </div>
                            <div class="col-xs-12 col-md-3 text-left">
                                <strong>Quarto:</strong><br>
                                @if($imovel->quartos > 0)
                                    {{ str_pad(intval($imovel->quartos), 2, '0', STR_PAD_LEFT) }}
                                @else
                                    Não informado
                                @endif
                            </div>
                            <div class="col-xs-12 col-md-3 text-left">
                                <strong>Banheiro:</strong><br>
                                @if($imovel->banheiros > 0)
                                    {{ str_pad(intval($imovel->banheiros), 2, '0', STR_PAD_LEFT) }}
                                @else
                                    Não informado
                                @endif
                            </div>
                            <div class="col-xs-12 col-md-3 text-left">
                                <strong>Sala:</strong><br>
                                @if($imovel->salas > 0)
                                    {{ str_pad(intval($imovel->salas), 2, '0', STR_PAD_LEFT) }}
                                @else
                                    Não informada
                                @endif
                            </div>
                            <div class="col-xs-12 col-md-3 text-left">
                                <strong>Vagas de Garagem:</strong><br>
                                @if($imovel->vagas_garagem > 0)
                                    {{ str_pad(intval($imovel->vagas_garagem), 2, '0', STR_PAD_LEFT) }}
                                @else
                                    Não informada
                                @endif
                            </div>  --}}


                            <div class="col-xs-12 col-md-12 text-justify">
                                <strong>Descrição:</strong><br>
                                {{ $imovel->descricao }}
                            </div>
                            <div class="col-xs-12 col-md-6 text-left">
                                <strong>Valor de Mercado:</strong><br>
                                {{ formatarValorReal($imovel->valor_mercado) }}
                                <br><strong>Valor de Avaliação:</strong><br> {{ formatarValorReal($imovel->valor_avaliacao) }}
                                <br><strong>Valor de Arremate:</strong><br> {{ formatarValorReal($imovel->valor_arremate) }}
                                <br><strong>Desconto:</strong><br> {{ formatarValorReal($imovel->valor_desconto) }}
                                <br><strong>Condominio:</strong><br> {{ formatarValorReal($imovel->valor_condominio_mensal) }}
                                <br><strong>IPTU / Mensal:</strong><br> {{ formatarValorReal($imovel->valor_iptu_mensal) }}
                                <br><strong>Prestação do Financiamento:</strong><br> {{ formatarValorReal($imovel->valor_prestacao_mensal) }}
                                <br><strong>Entrada:</strong><br> {{ formatarValorReal($imovel->valor_entrada) }}
                                <br><strong>Documentação:</strong><br> {{ formatarValorReal($imovel->valor_documentacao) }}
                            </div>
                            <div class="col-xs-12 col-md-6 text-left">
                                <strong>Desocupação:</strong><br> {{ formatarValorReal($imovel->valor_desocupacao) }}
                                <br><strong>Reforma:</strong><br> {{ formatarValorReal($imovel->valor_reforma) }}
                                <br><strong>Depósito Inicial:</strong><br> {{ formatarValorReal($imovel->valor_deposito_inicial) }}
                                <br><strong>Prazo de venda / meses:</strong><br> {{ intval($imovel->valor_prazo) }}
                                <br><strong>Prestação:</strong><br> {{ formatarValorReal($imovel->valor_prestacao) }}
                                <br><strong>Condominio:</strong><br> {{ formatarValorReal($imovel->valor_condominio_anual) }}
                                <br><strong>IPTU:</strong><br> {{ formatarValorReal($imovel->valor_iptu_anual) }}
                                <br><strong>Despesa de Venda:</strong><br> {{ formatarValorReal($imovel->valor_despesa_venda) }}
                                <br><strong>Despesas Extras / Geral:</strong><br> {{ formatarValorReal($imovel->valor_despesa_extra) }}
                            </div>
                            <div class="col-xs-12 col-md-6 text-left">
                                <strong>Investimento Total:</strong><br>
                                <h3 class="team-classic-title"> {{ formatarValorReal($imovel->valor_investimento) }}</h3>
                                <br><strong>Saldo devedor:</strong><br>
                                <h3 class="team-classic-title">{{ formatarValorReal($imovel->valor_saldo_devedor) }}</h3>
                            </div>
                            <div class="col-xs-12 col-md-6 text-left">
                                <strong>Reembolso:</strong><br>
                                <h3 class="team-classic-title">{{ formatarValorReal($imovel->valor_reembolso) }}</h3>
                                <br><strong>Saldo da Operação:</strong><br>
                                <h3 class="team-classic-title">{{ formatarValorReal($imovel->valor_saldo_operacao) }}</h3>
                            </div>
                            <div class="col-xs-12 col-md-6 text-center">
                                <br><a class="btn-voltar" href="{{ is_null($link_busca) ? 'javascript:window.history.back()' : $link_busca }}">
                                    <i class="fab fa-arrow-left"></i>
                                    Página anterior
                                </a>
                            </div>
                            <div class="col-xs-12 col-md-6 text-center">
                                <br><a href="{{ route('saibamais', $imovel->matricula_id) }}" target="_blank" class="btn-entre-contato">
                                    <i class="fab fa-whatsapp"></i>
                                    Entre em contato
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var imagens = {!! json_encode($images) !!}
    </script>

@endsection

@section('script')
    @include('site.inc.script')
@endsection
