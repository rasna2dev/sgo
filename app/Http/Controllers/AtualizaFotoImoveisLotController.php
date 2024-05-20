<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Services\ImovelService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class AtualizaFotoImoveisLotController extends AbstractController
{

    protected $imovelService
    ;


    public function __construct(
        ImovelService $imovelService

    )
    {
        $this->imovelService = $imovelService;
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
        $erros = 0;

        $params = [
            'vendido' => 0,
            'sfoto' => 1
        ];
        if(Auth::user()->id <> 1) {
            $params['pesquisar_uf'] = Auth::user()->uf;
        }

        $client = new Client();

        foreach($this->imovelService->buscarImovel($params)->get() as $imovel) {
            $contador++;

            try {
                $matricula = $imovel->matricula_id;
                $matricula = str_pad((string)$matricula, 13, '0', STR_PAD_LEFT);
                $matricula = "F{$matricula}21.jpg";

                $imageUrl = "https://venda-imoveis.caixa.gov.br/fotos/{$matricula}";

                $response = $client->get($imageUrl);

                if ($response->getStatusCode() === 200) {
                    $atualizados++;

                    $imageContent = $response->getBody()->getContents();
                    $path = "public/imagem/$matricula";
                    Storage::put($path, $imageContent);

                    $imovel->updateOrCreate([
                        'id' => $imovel->id
                    ], ['imagem' => $matricula]);

                }
            } catch (\Exception $e) {
                $erros++;
            }
        }

        return redirect()->route($this->currentRouteName . '.index')->with([
            'contador' => $contador,
            'atualizados' => $atualizados,
            'erros' => $erros
        ]);
    }

}
