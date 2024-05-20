<?php

namespace App\Http\Controllers;

use SplFileObject;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\UploadImoveisRequest;
use App\Services\EstadoService;
use App\Services\CidadeService;
use App\Services\BairroService;
use App\Services\ModalidadeService;
use App\Services\UnidadeService;
use App\Services\ImovelService;
use App\Services\TaxaService;
use App\Services\RegraService;


class UploadImoveisController extends AbstractController
{

    protected $estadoService
              , $cidadeService
              , $bairroService
              , $modalidadeService
              , $unidadeService
              , $imovelService
              , $taxaService
              , $regraService
    ;


    public function __construct(
        EstadoService $estadoService
        ,CidadeService $cidadeService
        ,BairroService $bairroService
        ,ModalidadeService $modalidadeService
        ,UnidadeService $unidadeService
        ,ImovelService $imovelService
        ,TaxaService $taxaService
        ,RegraService $regraService

    )
    {
        $this->estadoService = $estadoService;
        $this->cidadeService = $cidadeService;
        $this->bairroService = $bairroService;
        $this->modalidadeService = $modalidadeService;
        $this->unidadeService = $unidadeService;
        $this->imovelService = $imovelService;
        $this->taxaService = $taxaService;
        $this->regraService = $regraService;
        $this->currentRouteName = dir_blade($this->getNomeRota());
    }

    public function index()
    {
        return view( $this->currentRouteName . ".index", [
            'title' => 'Imóveis / Anexar Novos'
            ,'currentRouteName' => $this->currentRouteName
        ]);
    }

    public function store(UploadImoveisRequest $request)
    {
        $imoveis = [];
        $contador = 0;
        $descartados = 0;
        $cadastrados = 0;
        $atualizados = 0;
        $vendidos = 0;
        $slug = null;
        $data = (object)[];

        if ($request->hasFile('arquivo')) {

            $estadosItems = config('estados');

            $file = $request->file('arquivo');
            $fileObject = new SplFileObject($file->getPathname(), 'r');

            while (!$fileObject->eof()) {

                $contador++;
                $descartados++;

                $linha = getLinhaImovelCSV($fileObject->fgetcsv());

                if($contador < 10) {
                    continue;
                }

                //pre carregadas
                $col_uf = is_null($linha->estado_id) ? '' : $linha->estado_id;
                $col_cidade = is_null($linha->cidade_id) ? '' : $linha->cidade_id;
                $col_bairro = is_null($linha->bairro_id) ? '' : $linha->bairro_id;
                $col_modalidade = is_null($linha->modalidade_id) ? '' : $linha->modalidade_id;
                $col_unidade = is_null($linha->unidade_id) ? '' : $linha->unidade_id;

                //uf
                $uf = null;
                if(strlen($col_uf) > 0) {
                    $uf = $estadosItems[$col_uf];
                    if(strlen($uf) > 0) {
                        $uf = $this->estadoService->updateOrCreate([
                            'slug' => mb_strtolower(Str::slug($col_uf)),
                            'sigla' => mb_strtoupper($col_uf),
                            'nome' => mb_strtoupper($uf)
                        ]);
                    }
                }

                //cidade
                $cidade = null;
                if(isset($uf->id) && strlen($col_cidade) > 0) {
                    $cidade = $this->cidadeService->updateOrCreate([
                        'estado_id' => $uf->id
                        ,'slug' => Str::slug("{$col_uf}-{$col_cidade}")
                        ,'nome' => $col_cidade
                    ]);
                }

                //bairro
                $bairro = null;
                if(
                    isset($uf->id) &&
                    isset($cidade->id) &&
                    strlen($col_bairro) > 0
                ) {
                    $bairro = $this->bairroService->updateOrCreate([
                         'estado_id' => $uf->id
                        ,'cidade_id' => $cidade->id
                        ,'slug'  => Str::slug("{$col_uf}-{$col_cidade}-{$col_bairro}")
                        ,'nome' => $col_bairro

                    ]);
                }

                //modalidade
                $modalidade = null;
                if(strlen($col_modalidade) > 0) {
                    $modalidade = $this->modalidadeService->updateOrCreate([
                        'slug'  => Str::slug("{$col_modalidade}")
                       ,'nome' => $col_modalidade
                   ]);
                }

                //unidade
                $unidade = null;
                if(strlen($col_unidade) > 0){
                    $unidade = $this->unidadeService->updateOrCreate([
                        'slug'  => Str::slug("{$col_unidade}")
                       ,'nome' => $col_unidade
                   ]);
                }

                if(
                    isset($modalidade->id) &&
                    in_array($modalidade->slug, [
                        'venda-direta-online'
                    ])
                ) {
                    $linha = validarColunas($linha);

                    if(
                        isset($linha->matricula)
                        && is_numeric($linha->matricula)
                        && $linha->matricula > 0
                    ) {

                        $exec = Auth::user()->id == 1 ? 1 : 0;

                        if(
                            $exec == 0 &&
                            Auth::user()->id <> 1 &&
                            isset($uf->id) &&
                            Str::slug( Auth::user()->uf ) == $uf->slug
                        ) {
                            $exec = 1;
                        }

                        if($exec == 1) {
                            $slug = '';
                            $slug .= (isset($uf->id)) ? "{$uf->sigla} " : "";
                            $slug .= (isset($cidade->id)) ? "{$cidade->nome} " : "";
                            $slug .= (isset($bairro->id)) ? "{$bairro->nome} " : "";
                            $slug .= (isset($unidade->id)) ? "{$unidade->nome} " : "";
                            $slug .= (isset($linha->endereco)) ? "{$linha->endereco} " : "";
                            $slug .= (isset($linha->matricula)) ? "matricula-{$linha->matricula}" : "";
                            $slug = Str::slug( $slug );

                            $imovel = $this->imovelService->updateOrCreate([
                                'matricula_id' => $linha->matricula
                            ], [
                                'usuario_id' => Auth::user()->id
                                ,'matricula_id' => intval($linha->matricula)
                                ,'estado_id' => isset($uf->id) ? $uf->id : 0
                                ,'cidade_id' => isset($cidade->id) ? $cidade->id : 0
                                ,'bairro_id' => isset($bairro->id) ? $bairro->id : 0
                                ,'modalidade_id' => isset($modalidade->id) ? $modalidade->id : 0
                                ,'unidade_id' => isset($unidade->id) ? $unidade->id : 0
                                ,'slug' => $slug
                                ,'endereco' => $linha->endereco
                                ,'valor_venda' => $linha->valor_venda
                                ,'valor_avaliacao' => $linha->valor_avaliacao
                                ,'valor_desconto' => $linha->valor_desconto
                                ,'area_total' => $linha->area_total
                                ,'area_privativa' => $linha->area_privativa
                                ,'area_terreno' => $linha->area_terreno
                                ,'quartos' => $linha->quartos
                                ,'banheiros' => $linha->banheiros
                                ,'salas' => $linha->salas
                                ,'vagas_garagem' => $linha->vagas_garagem
                                ,'descricao' => $linha->descricao
                                ,'link' => $linha->link
                                ,'link_matricula' => $linha->link_matricula
                            ]);

                            $taxas = aplicarTaxas($imovel, $this->regraService);
                            if(!is_null($taxas)) {
                                $this->taxaService->updateOrCreate([
                                    'imovel_id' => $imovel->id
                                ], $taxas);
                            }

                            $descartados--;
                            if($imovel->wasRecentlyCreated) {
                                $cadastrados++;
                                $imovel->update([
                                    'data_criacao' => date('Y-m-d H:i:s'),
                                    'data_atualizacao' => date('Y-m-d H:i:s')
                                ]);
                            } else {
                                $atualizados++;
                                $imovel->update([
                                    'data_atualizacao' => date('Y-m-d H:i:s')
                                ]);
                            }


                        }
                    }
                }
            }

            $fileObject = null;

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
                'cadastrados' => $cadastrados,
                'descartados' => $descartados,
                'vendidos' => $vendidos
            ]);


        } else {
            // Se nenhum arquivo foi enviado, retorne uma mensagem de erro
            return redirect()->back()
                ->withErrors(['Por favor, selecione um arquivo CSV.']);
        }
    }

}
