<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\RegraService;
use App\Http\Requests\RegraRequest;

class TarifasController extends AbstractController
{

    protected $regraService;

    protected $columns = [
        'valor_prazo', 'valor_inicial', 'valor_final', 'valor_desconto',
        'valor_condominio', 'valor_entrada', 'valor_documentacao',
        'valor_iptu', 'valor_prestacao_financiamento',
        'valor_desocupacao', 'valor_reforma', 'valor_despesa_venda',
        'valor_despesa_extra', 'ativo'
    ];

    public function __construct(
        RegraService $regraService
    )
    {
        $this->regraService = $regraService;
        $this->currentRouteName = dir_blade($this->getNomeRota());
    }


    public function index()
    {
        return view( $this->currentRouteName . ".index", [
            'title' => 'Imóveis / Tarifas'
            ,'currentRouteName' => $this->currentRouteName
            ,'tarifas' => $this->regraService->listar()
        ]);
    }

    public function store(RegraRequest $request)
    {
        $request = $request->only( $this->columns );

        $existe = $this->regraService->existe([
            'existe_prazo' => $request['valor_prazo']
        ]);

        if($existe) {
            return response()->json([
                'message' => 'Ja existe uma tafifa com o prazo informado.'
                ,'errors' => ['Ja existe uma tafifa com o prazo informado.']
            ], 422);
        }

        $existe = $this->regraService->existe([
            'existe_inicial' => $request['valor_inicial']
            ,'existe_final' => $request['valor_final']
        ]);

        if($existe) {
            return response()->json([
                'message' => "O valor inicial ou final está dentro da margem do prazo {$existe->valor_prazo}."
                ,'errors' => ["O valor inicial ou final está dentro da margem do prazo {$existe->valor_prazo}."]
            ], 422);
        }

        $this->regraService->cadastrar($request);

        return response()->json([
            'success' => true,
            'message' => 'Tarifa cadastrada com sucesso.',
        ]);
    }

    public function update(RegraRequest $request, int $id)
    {
        $request = $request->only( $this->columns );

        $this->regraService->atualizar($id, $request);

        return response()->json([
            'success' => true,
            'message' => 'Tarifa atualizada com sucesso.',
        ]);
    }

    public function destroy(int $id)
    {
        try {
            $this->regraService->deletar($id);

            return response()->json([
                'success' => true,
                'message' => 'Tarifa removida com sucesso.',
            ]);
        } catch(Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao remover esta tarifa.',
                'errors' => ['Ocorreu um erro ao remover esta tarifa.']
            ], 422);
        }
    }
}
