<?php

namespace App\Repositories;

use App\Models\ImovelModel;
// use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImovelRepository
{

    protected $imovelModel;

    public function __construct(ImovelModel $imovelModel)
    {
        $this->imovelModel = $imovelModel;
    }

    public function updateOrCreate(array $conditions, array $data)
    {
        return $this->imovelModel->updateOrCreate($conditions, $data);
    }

    public function search(array $data)
    {
        if(isset($data['modo']) && $data['modo'] == 'pesquisa') {

            $query = $this->imovelModel->select(
                'imoveis.id'
                ,'usuarios.nome as usuario'
                ,'usuarios.telefone'
                ,'imoveis.matricula_id'
                ,'estados.sigla'
                ,'estados.nome as estado'
                ,'cidades.nome as cidade'
                ,'bairros.nome as bairro'
                ,'modalidades.nome as modalidade'
                ,'unidades.nome as unidade'
                ,'imoveis.endereco'
                ,DB::RAW('imoveis.valor_venda as valor_venda_caixa')
                ,DB::RAW('imoveis.valor_avaliacao as valor_avaliacao_caixa')
                ,DB::RAW('imoveis.valor_desconto as valor_desconto_caixa')
                ,'imoveis.descricao'
                ,'imoveis.link'
                ,'imoveis.link_matricula'
                ,'imoveis.vendido'
                ,'imoveis.principal'
                ,'imoveis.imagem'
                ,'imoveis.slug'
                ,'imoveis.area_total'
                ,'imoveis.area_privativa'
                ,'imoveis.area_terreno'
                ,'imoveis.quartos'
                ,'imoveis.banheiros'
                ,'imoveis.salas'
                ,'imoveis.vagas_garagem'
                ,"taxas.valor_mercado"
                ,"taxas.valor_avaliacao"
                ,"taxas.valor_arremate"
                ,"taxas.valor_prazo"
                ,"taxas.valor_desconto"
                ,"taxas.valor_entrada"
                ,"taxas.valor_documentacao"
                ,"taxas.valor_desocupacao"
                ,"taxas.valor_reforma"
                ,"taxas.valor_deposito_inicial"
                ,"taxas.valor_despesa_venda"
                ,"taxas.valor_despesa_extra"
                ,"taxas.valor_saldo_devedor"
                ,"taxas.valor_condominio_mensal"
                ,"taxas.valor_condominio_anual"
                ,"taxas.valor_iptu_mensal"
                ,"taxas.valor_iptu_anual"
                ,"taxas.valor_prestacao_mensal"
                ,"taxas.valor_prestacao"
                ,"taxas.valor_investimento"
                ,"taxas.valor_reembolso"
                ,"taxas.valor_saldo_operacao"
                ,DB::RAW("strftime('%d/%m/%Y %H:%M:%S', imoveis.data_criacao) as data_criacao")
                ,DB::RAW("strftime('%d/%m/%Y %H:%M:%S', imoveis.data_atualizacao) as data_atualizacao")
            );

            $query->leftJoin('estados', 'estados.id', '=', 'imoveis.estado_id')
                ->leftJoin('cidades', 'cidades.id', '=', 'imoveis.cidade_id')
                ->leftJoin('bairros', 'bairros.id', '=', 'imoveis.bairro_id')
                ->leftJoin('unidades', 'unidades.id', '=', 'imoveis.unidade_id')
                ->leftJoin('modalidades', 'modalidades.id', '=', 'imoveis.modalidade_id')
                ->leftJoin('usuarios', 'usuarios.id', '=', 'imoveis.usuario_id')
                ->leftJoin('taxas', 'taxas.imovel_id', '=', 'imoveis.id')
            ;

            if(!isset($data['modo'])) {
                if(Auth::user()->id <> 1) {
                    $query->where('estados.sigla', Auth::user()->uf);
                }
            }
        } else {
            $query = $this->imovelModel->select('*');
        }

        foreach(['matricula','pesquisar_matricula'] as $matricula) {
            if(isset($data[$matricula]) && strlen($data[$matricula]) > 0) {
                $query->where('imoveis.matricula_id', $data[$matricula]);
            }
        }

        if(isset($data['pesquisar_uf']) && $data['pesquisar_uf'] > 0) {
            $query->where('estados.sigla', $data['pesquisar_uf']);
        }

        if(isset($data['pesquisar_cidade']) && strlen($data['pesquisar_cidade']) > 0) {
            $query->where('cidades.id', $data['pesquisar_cidade']);
        }

        if(isset($data['pesquisar']) && strlen($data['pesquisar']) > 0) {
            $query->where(function($filter) use ($data) {
                $filter->where('imoveis.endereco', 'like', '%'.$data['pesquisar'].'%');
                $filter->orWhere('imoveis.descricao', 'like', '%'.$data['pesquisar'].'%');
            });
        }

        if(isset($data['vendido'])) {
            $query->where('imoveis.vendido', $data['vendido']);
        }

        if(isset($data['principal'])) {
            $query->where('imoveis.principal', $data['principal']);
        }

        if(isset($data['baixar_vendido'])) {
            $query->where('imoveis.data_atualizacao', '<=', $data['baixar_vendido']);
        }

        if(isset($data['sfoto'])) {
            $query->whereNull('imoveis.imagem');
        }

        if(isset($data['cfoto'])) {
            $query->where(function($filter) {
                $filter->whereNotNull('imoveis.imagem');
                $filter->orWhere('imoveis.imagem', '<>', '#')
                ;
            });
        }

        if(isset($data['modo']) && $data['modo'] == 'pesquisa') {

            if(isset($data['busca_estado'])) {
                $query->where('estados.id', is_numeric($data['busca_estado']) ? $data['busca_estado'] : -1);
            }

            if(isset($data['busca_cidade'])) {
                $query->where('cidades.id', is_numeric($data['busca_cidade']) ? $data['busca_cidade'] : -1);
            }

            if(isset($data['busca_bairro'])) {
                $query->where('bairros.id', is_numeric($data['busca_bairro']) ? $data['busca_cidade'] : -1);
            }

            if(isset($data['busca_tipo'])) {
                $query->where('unidades.id', is_numeric($data['busca_tipo']) ? $data['busca_tipo'] : -1);
            }

            if(isset($data['busca_quarto'])) {
                if(is_numeric($data['busca_quarto'])) {
                    if($data['busca_quarto'] <= 3) {
                        $query->where('imoveis.quartos', $data['busca_quarto']);
                    } else {
                        $query->where('imoveis.quartos', '>=', 4);
                    }
                } else {
                    $query->where('imoveis.quartos', -1);
                }
            }

            if(isset($data['busca_sala'])) {
                if(is_numeric($data['busca_sala'])) {
                    if($data['busca_sala'] <= 3) {
                        $query->where('imoveis.salas', $data['busca_sala']);
                    } else {
                        $query->where('imoveis.salas', '>=', 4);
                    }
                } else {
                    $query->where('imoveis.salas', -1);
                }
            }

            if(isset($data['busca_banheiro'])) {
                if(is_numeric($data['busca_banheiro'])) {
                    if($data['busca_banheiro'] <= 3) {
                        $query->where('imoveis.banheiros', $data['busca_banheiro']);
                    } else {
                        $query->where('imoveis.banheiros', '>=', 4);
                    }
                } else {
                    $query->where('imoveis.banheiros', -1);
                }
            }

            if(isset($data['busca_garagem'])) {
                if(is_numeric($data['busca_garagem'])) {
                    if($data['busca_garagem'] <= 3) {
                        $query->where('imoveis.vagas_garagem', $data['busca_garagem']);
                    } else {
                        $query->where('imoveis.vagas_garagem', '>=', 4);
                    }
                } else {
                    $query->where('imoveis.vagas_garagem', -1);
                }
            }

            if(
                isset($data['busca_valor_min']) ||
                isset($data['busca_valor_max'])
            ) {
                if(
                    isset($data['busca_valor_min']) &&
                    isset($data['busca_valor_max']) &&
                    is_numeric($data['busca_valor_min']) &&
                    is_numeric($data['busca_valor_max']) &&
                    $data['busca_valor_min'] > 0 &&
                    $data['busca_valor_max'] > 0
                ) {
                    $query->whereBetween('taxas.valor_saldo_operacao', [$data['busca_valor_min'],$data['busca_valor_max']]);
                } elseif(
                    isset($data['busca_valor_min']) &&
                    !isset($data['busca_valor_max']) &&
                    is_numeric($data['busca_valor_min'])&&
                    $data['busca_valor_min'] > 0
                ) {
                    $query->where('taxas.valor_saldo_operacao', '>=', $data['busca_valor_min']);
                }  elseif(
                    isset($data['busca_valor_max']) &&
                    !isset($data['busca_valor_min']) &&
                    is_numeric($data['busca_valor_max'])&&
                    $data['busca_valor_max'] > 0
                ) {
                    $query->where('taxas.valor_saldo_operacao', '<=', $data['busca_valor_max']);
                } else {
                    $query->where('taxas.valor_saldo_operacao', -1);
                }
            }


            if(
                isset($data['busca_area_min']) ||
                isset($data['busca_area_max'])
            ) {
                if(
                    isset($data['busca_area_min']) &&
                    isset($data['busca_area_max']) &&
                    is_numeric($data['busca_area_min']) &&
                    is_numeric($data['busca_area_max']) &&
                    $data['busca_area_min'] > 0 &&
                    $data['busca_area_max'] > 0
                ) {
                    $query->whereBetween('imoveis.area_total', [$data['busca_area_min'],$data['busca_area_max']]);
                } elseif(
                    isset($data['busca_area_min']) &&
                    !isset($data['busca_area_max']) &&
                    is_numeric($data['busca_area_min'])&&
                    $data['busca_area_min'] > 0
                ) {
                    $query->where('imoveis.area_total', '>=', $data['busca_area_min']);
                }  elseif(
                    isset($data['busca_area_max']) &&
                    !isset($data['busca_area_min']) &&
                    is_numeric($data['busca_area_max'])&&
                    $data['busca_area_max'] > 0
                ) {
                    $query->where('imoveis.area_total', '<=', $data['busca_area_max']);
                } else {
                    $query->where('imoveis.area_total', -1);
                }
            }
        }

        // dd_sql_raw($query);
        return $query;
    }


    public function site(array $data)
    {
        $query = null;
        if(isset($data['grupo'])) {

            switch($data['grupo']) {
                case 'uf': {
                    $query = $this->imovelModel->select(
                          DB::RAW('estados.sigla as estado')
                        , DB::RAW('COUNT(imoveis.id) as total')
                    )
                    ->groupBy(
                        DB::RAW('estados.sigla')
                    )
                    ->whereNotNull('estados.id')
                    ->orderBy('estados.sigla');
                    break;
                }

                case 'cidade': {
                    $query = $this->imovelModel->select(
                          DB::RAW('estados.sigla as estado')
                        , DB::RAW('cidades.nome as cidade')
                        , DB::RAW('COUNT(imoveis.id) as total')
                    )
                    ->groupBy(
                          DB::RAW('estados.sigla')
                        , DB::RAW('cidades.nome')
                    )
                    ->whereNotNull('cidades.id')
                    ->orderBy('cidades.nome');
                    break;
                }

                case 'bairro': {
                    $query = $this->imovelModel->select(
                          DB::RAW('estados.sigla as estado')
                        , DB::RAW('cidades.nome as cidade')
                        , DB::RAW('bairros.nome as bairro')
                        , DB::RAW('COUNT(imoveis.id) as total')
                    )
                    ->groupBy(
                          DB::RAW('estados.sigla')
                        , DB::RAW('cidades.nome')
                        , DB::RAW('bairros.nome')
                    )
                    ->whereNotNull('bairros.id')
                    ->orderBy('bairros.nome');
                    break;
                }

                case 'unidade': {
                    $query = $this->imovelModel->select(
                        //   DB::RAW('estados.sigla as estado')
                        // , DB::RAW('cidades.nome as cidade')
                        // , DB::RAW('bairros.nome as bairro')
                         DB::RAW('unidades.nome as unidade')
                        , DB::RAW('COUNT(imoveis.id) as total')
                    )
                    ->groupBy(
                        //  DB::RAW('estados.sigla')
                        // , DB::RAW('cidades.nome')
                        // , DB::RAW('bairros.nome')
                         DB::RAW('unidades.nome')
                    )
                    ->whereNotNull('unidades.id')
                    ->orderBy('unidades.nome');
                    break;
                }
            }

            if(!is_null($query)) {
                $query->leftJoin('estados', 'estados.id', '=', 'imoveis.estado_id')
                    ->leftJoin('cidades', 'cidades.id', '=', 'imoveis.cidade_id')
                    ->leftJoin('bairros', 'bairros.id', '=', 'imoveis.bairro_id')
                    ->leftJoin('unidades', 'unidades.id', '=', 'imoveis.unidade_id')
                    ->leftJoin('modalidades', 'modalidades.id', '=', 'imoveis.modalidade_id')
                    ->leftJoin('usuarios', 'usuarios.id', '=', 'imoveis.usuario_id')
                    ->leftJoin('taxas', 'taxas.imovel_id', '=', 'imoveis.id')
                ;
            }
        }

        return $query;
    }
}
