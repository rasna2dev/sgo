<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Services\ImovelService;
use App\Services\RegraService;
use App\Services\TaxaService;


class AtualizaImoveisLotController extends AbstractController
{

    protected $imovelService
                , $regraService
                , $taxaService
    ;


    public function __construct(
        ImovelService $imovelService
        ,RegraService $regraService
        ,TaxaService $taxaService

    )
    {
        $this->imovelService = $imovelService;
        $this->regraService = $regraService;
        $this->taxaService = $taxaService;
        $this->currentRouteName = dir_blade($this->getNomeRota());
    }

    public function index()
    {
        return view( $this->currentRouteName . ".index", [
            'title' => 'Imóveis / Atualizar Cadastrados'
            ,'currentRouteName' => $this->currentRouteName
        ]);
    }


    public function update(int $id)
    {
        $contador = 0;
        $atualizados = 0;
        $vendidos = 0;

        $params = ['vendido' => 0];
        if(Auth::user()->id <> 1) {
            $params['modo'] = 'pesquisa';
            $params['pesquisar_uf'] = Auth::user()->uf;
        }

        foreach($this->imovelService->buscarImovel($params)->get() as $imovel) {
            $contador++;

            $taxas = aplicarTaxas($imovel, $this->regraService);
            if(!is_null($taxas)) {
                $atualizados++;
                $this->taxaService->updateOrCreate([
                    'imovel_id' => $imovel->id
                ], $taxas);
            }
        }

        foreach($this->imovelService->buscarImovel([
            'vendido' => 0,
            'baixar_vendido' => Carbon::now()->subDays(120)->format('Y-m-d H:i:s')
        ])->get() as $imovel) {
            $a = $imovel->update(['vendido' => 1]);
            $vendidos++;
        }


        return redirect()->route($this->currentRouteName . '.index')->with([
            'contador' => $contador,
            'atualizados' => $atualizados,
            'vendidos' => $vendidos
        ]);
    }

}
