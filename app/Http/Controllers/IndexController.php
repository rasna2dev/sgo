<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Services\SiteService;


class IndexController extends AbstractController
{
    protected $siteService;

    public function __construct(
        SiteService $siteService
    )
    {
        $this->siteService = $siteService;
    }

    public function index(
        Request $request
    )
    {
        if($request->has('req')) {
            $data = [];

            if($request->has('busca_estado') && is_numeric($request->get('busca_estado'))) {
                $data = $this->siteService->getCidades(['estado_id' => $request->get('busca_estado')]);
            }

            if($request->has('busca_cidade') && is_numeric($request->get('busca_cidade'))) {
                $data = $this->siteService->getBairros(['cidade_id' => $request->get('busca_cidade')]);
            }

            return response()->json([
                'success' => true,
                'message' => 'OK',
                'data' => $data,
            ]);
        }

        Session::put('busca', url()->full());

        $tags = (object) [
            'title' => 'Análise de Investimento Imobiliário | VIP Imóveis da Caixa'
            ,'description' => 'VIP Imóveis da Caixa oferece análises detalhadas para ajudar você a decidir se vale a pena investir em imóveis retomados pela Caixa Econômica Federal. Não vendemos nem financiamos imóveis, mas fornecemos informações valiosas para orientar suas decisões de investimento imobiliário.'
            , 'keywords' => 'imóveis da caixa, análise de investimento imobiliário, investir em imóveis, imóveis para investimento, imóveis para compra, imóveis para aluguel, imóveis retomados, imóveis para venda, avaliação de imóveis, imóveis desocupados'
        ];

        $data = $request->all();
        $data['modo'] = 'pesquisa';
        $req = request_valor( $request->all() );

        return view( 'site.index', [
              'unidades' => $this->siteService->getUnidades()
            , 'estados' => $this->siteService->getEstados()
            , 'imoveis' => $this->siteService->getImoveis($data)
            , 'swiper' => $this->siteService->getTopSwiper()
            , 'req' => $req
            , 'tags' => $tags
        ]);
    }

    public function oportunidade(Request $request, $matricula)
    {
        if (preg_match('/matricula-(\d+)/', $matricula, $matches)) {
            $matricula = $matches[1];
        } else {
            $matricula = '******xxxxxxxx******';
        }

        $data = [
            'matricula' => $matricula
            , 'modo' => 'pesquisa'
            , 'vendido' => 0
        ];

        $imovel = $this->siteService->getImoveis($data);
        $total = $imovel->total();

        if($total == 0) {
            return redirect()->route('erro_404');
        }


        $tags = (object) [
            'title' => ''
            ,'description' => ''
            , 'keywords' => ''
        ];


        $imovel = $imovel->first();
        $tags = getMetaTags($imovel);

        $req = null;
        if(Session::has('busca')) {
            $params = parse_url( Session::get('busca'), PHP_URL_QUERY);
            parse_str($params, $parametros);
            $req = request_valor( $parametros );
        }

        return view( 'site.oportunidade', [
            'total' => $total
          , 'unidades' => $this->siteService->getUnidades()
          , 'estados' => $this->siteService->getEstados()
          , 'imovel' => $imovel
          , 'tags' => $tags
          , 'link_busca' => Session::has('busca') ? Session::get('busca') : null
          , 'swiper' => $this->siteService->getTopSwiper()
          , 'req' => $req
      ]);
    }

    public function saibamais($matricula)
    {
        if (is_numeric($matricula)) {
            $matricula = $matricula;
        } else {
            $matricula = '******xxxxxxxx******';
        }

        $data = [
            'matricula' => $matricula
            , 'modo' => 'pesquisa'
            , 'vendido' => 0
        ];

        $imovel = $this->siteService->getImoveis($data);
        $total = $imovel->total();

        if($total == 0) {
            return redirect()->route('erro_404');
        }
        $imovel = $imovel->first();


        $phone = $imovel->telefone;
        $text = '';
        $text .= "Olá Gostaria de mais informações sobre o imóvel ";
        $text .= $imovel->endereco;
        $text .= " - {$imovel->bairro}";
        $text .= " - {$imovel->cidade}";
        $text .= " / {$imovel->sigla}";
        $text = urlencode( $text );

        $link = "https://api.whatsapp.com/send?phone={$phone}&text={$text}";
        if(!is_null($imovel->imagem) && $imovel->imagem <> '#') {
            $link .= "&image=" . url("foto/{$imovel->imagem}");
        }

        return redirect($link);
    }

    public function erro404()
    {
        $tags = (object) [
            'title' => ''
            ,'description' => ''
            , 'keywords' => ''
        ];


        return view( 'errors.404', [
            'swiper' => $this->siteService->getTopSwiper()
            , 'unidades' => $this->siteService->getUnidades()
            , 'estados' => $this->siteService->getEstados()
            , 'tags' => $tags
      ]);
    }
}
