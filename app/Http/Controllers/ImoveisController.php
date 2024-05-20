<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImovelService;
use App\Services\CidadeService;

class ImoveisController extends AbstractController
{

    protected $imovelService
        , $cidadeService
    ;

    public function __construct(
        ImovelService $imovelService
        , CidadeService $cidadeService
    )
    {
        $this->imovelService = $imovelService;
        $this->cidadeService = $cidadeService;
        $this->currentRouteName = dir_blade($this->getNomeRota());
    }

    public function index(Request $request)
    {
        if($request->has('remover_foto') && is_numeric($request->get('remover_foto'))) {
            $this->imovelService->updateOrCreate([
                'id' => $request->get('remover_foto')
            ], [
                'imagem' => '#'
            ]);
            return redirect()->back()->with('success', 'Foto removida com sucesso.');
        }

        if($request->has('add_principal') && is_numeric($request->get('add_principal'))) {

            $this->imovelService->updateOrCreate([
                'id' => $request->get('add_principal')
            ], [
                'principal' => 1
            ]);
            return redirect()->back()->with('success', 'Foto adicionada ao carrossel.');
        }

        if($request->has('remover_principal') && is_numeric($request->get('remover_principal'))) {

            $this->imovelService->updateOrCreate([
                'id' => $request->get('remover_principal')
            ], [
                'principal' => 0
            ]);
            return redirect()->back()->with('success', 'Foto removida do carrossel.');
        }






        return view( $this->currentRouteName . ".index", [
            'title' => 'Imóveis / Lista de Cadastrados'
            ,'currentRouteName' => $this->currentRouteName
            ,'imoveis' => $this->imovelService->buscarImovel(array_merge(
                $request->all(),['modo' => 'pesquisa'])
            )->paginate(20)
            ,'cidades' => $this->cidadeService->buscarCidade()->get()
            ,'estados' => config('estados')
        ]);
    }

}
