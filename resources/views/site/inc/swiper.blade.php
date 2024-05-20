<section class="section">
    <div class="swiper-form-wrap">
        <div class="swiper-container swiper-slider swiper-slider_height-1 swiper-align-left swiper-align-left-custom context-dark bg-gray-darker" data-loop="false" data-autoplay="5500" data-simulate-touch="false" data-slide-effect="fade">
            <div class="swiper-wrapper">
                @foreach($swiper as $s)
                    <div class="swiper-slide" data-slide-bg="{{ url("foto/{$s->imagem}?w=1920&q=1") }}">
                        <div class="swiper-slide-caption">
                            <div class="container container-bigger swiper-main-section">
                                <div class="row row-fix justify-content-sm-center justify-content-md-start">
                                    <div class="col-md-6 col-lg-5 col-xl-4 col-xxl-5 opaque-background">
                                        <h3>{{ "{$s->sigla}, {$s->cidade}" }}</h3>
                                        <div class="divider divider-decorate"></div>
                                        <p class="text-spacing-sm">
                                            {{ "{$s->unidade} - {$s->bairro}" }} <br>
                                            {{ $s->matricula_id }} -
                                            {{ $s->descricao }}
                                        </p>
                                        <a class="button button-default-outline button-nina button-sm" href="{{ url("oportunidade/{$s->slug}") }}">saiba mais</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination-wrap">
                <div class="container container-bigger">
                    <div class="row">
                        <div class="col-12">
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('site.inc.form')
    </div>
</section>
