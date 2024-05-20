
@php $images = [] @endphp

<section class="section section-variant-1 bg-default novi-background bg-cover">
    <div class="container container-wide">
        <div class="row row-50">
            @if($imoveis->total() > 0)
                @foreach($imoveis as $row)
                    <div class="col-md-6 col-xl-4">
                        <article class="event-default-wrap">
                            <div class="event-default">
                                <figure class="event-default-image">
                                    @if(!is_null($row->imagem) && $row->imagem <> '#')
                                        <div class="foto-imovel">
                                            @php $images[] = $row->imagem @endphp
                                            <img id="img-{{ $row->imagem }}" alt="{{ "{$row->sigla}, {$row->cidade} - {$row->matricula_id}" }}">
                                        </div>
                                    @else
                                        <img src="{{ url('foto/indisponivel.png') }}" alt="{{ "{$row->sigla} - {$row->cidade}" }}" class="sem-foto-imovel">
                                    @endif
                                </figure>
                                <div class="event-default-caption">
                                    <a class="button button-xs button-secondary button-nina" href="{{ url( "oportunidade/{$row->slug}" ) }}">saiba mais</a>
                                </div>
                            </div>
                            <div class="event-default-inner">
                                <h5>
                                    <a class="event-default-title" href="{{ url( "oportunidade/{$row->slug}" ) }}">
                                        {{ $row->sigla }}, {{ $row->cidade }}
                                    </a>
                                </h5>
                                <span class="heading-5">{{ $row->matricula_id }}</span>
                            </div>
                        </article>
                    </div>
                @endforeach

                <div class="col-12 text-center pb-2">
                    @include('site.inc.paginacao', ['item' => $imoveis])
                </div>
            @else
                <div class="col-12">
                    <h1 class="text-center text-red">Nenhum imóvel encontrado.</h1>
                </div>
            @endif
        </div>
    </div>
</section>

<script>
    var imagens = {!! json_encode($images) !!}
</script>
