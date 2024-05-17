<?php

use Illuminate\Support\Str;
use Symfony\Component\VarDumper\VarDumper;

if (! function_exists('dd_sem_die')) {
    function dd_sem_die(...$vars) {
        foreach ($vars as $v) {
            VarDumper::dump($v);
        }
    }
}

if (!function_exists('dd_sql_raw')) {
    function dd_sql_raw($qb, $died = true) {
        $sql = str_replace("?", "'?'", $qb->toSql());
        if (!empty($qb->getBindings())) {
            $sqlWithBindings = vsprintf(str_replace('?', '%s', $sql), $qb->getBindings());
            dump($sqlWithBindings);
        } else {
            dump($sql);
        }
        if ($died) {
            die();
        }
    }
}

if (!function_exists('getLinhaImovelCSV')) {
    function getLinhaImovelCSV($linha)
    {
        $colunas = [
            'matricula',
            'estado_id',
            'cidade_id',
            'bairro_id',
            'endereco',
            'valor_venda',
            'valor_avaliacao',
            'valor_desconto',
            'descricao',
            'modalidade_id',
            'link'
        ];
        $linha = str_replace(['"', "'"], '', $linha);
        $linha = is_array($linha) ? implode('', $linha) : $linha;

        $linha = explode(';', $linha);

        $output = (object)[];
        $i = 0;

        foreach($colunas as $coluna) {
            $output->{$coluna} = empty($linha[$i]) ? null : mb_strtoupper(trim($linha[$i]));
            $i++;
        }

        $output->link = mb_strtolower($output->link);
        $output->unidade_id = null;

        foreach([
            'apartamento' => 'Apartamento'
            ,'casa' => 'Casa'
            ,'comercial' => 'Comercial'
            ,'galpao' => 'Galpão'
            ,'gleba' => 'Gleba'
            ,'imovel-rural' => 'Imóvel Rural'
            ,'loja' => 'Loja'
            ,'outros' => 'Outros'
            ,'predio' => 'Prédio'
            ,'sala' => 'Sala'
            ,'sobrado' => 'Sobrado'
            ,'terreno' => 'Terreno'
        ] as $key => $valor) {
            if(
                substr_count(Str::slug($output->descricao), Str::slug($key)) > 0 &&
                is_null($output->unidade_id)
            ) {
                $output->unidade_id = mb_strtoupper(trim($valor));
                break;
            }
        }

        return $output;
    }
}

if (!function_exists('validarColunas')) {
    function validarColunas($output)
    {
        $output->link = mb_strtolower($output->link);
        $output->valor_venda = formatarValor($output->valor_venda);
        $output->valor_avaliacao = formatarValor($output->valor_avaliacao);
        $output->valor_desconto = formatarValor($output->valor_desconto);

        $output->matricula = null;
        if (preg_match('/hdnimovel=(\d+)/', $output->link, $matches)) {
            $output->matricula = $matches[1];
        }

        $output->link_matricula = "https://venda-imoveis.caixa.gov.br/sistema/detalhe-imovel.asp?hdnorigem=index&hdnimovel=".$output->matricula."#";


        $output->imagem = null;
        $output->area_total = 0;
        $output->area_privativa = 0;
        $output->area_terreno = 0;
        $output->quartos = 0;
        $output->banheiros = 0;
        $output->salas = 0;
        $output->vagas_garagem = 0;

        $pattern_area_total = '/(\d+\.\d+) DE ÁREA TOTAL/';
        $pattern_area_privativa = '/(\d+\.\d+) DE ÁREA PRIVATIVA/';
        $pattern_area_terreno = '/(\d+\.\d+) DE ÁREA DO TERRENO/';
        $pattern_quartos = '/(\d+) QTO\(S\)/';
        // $pattern_banheiros = '/(\d+) WC/';
        $pattern_salas = '/(\d+) SALA\(S\)/';
        $pattern_vagas_garagem = '/(\d+) VAGA\(S\) DE GARAGEM/';

        foreach([
            'area_total'
            ,'area_privativa'
            ,'area_terreno'
            ,'quartos'
            // ,'banheiros'
            ,'salas'
            ,'vagas_garagem'
        ] as $p){
            $a = "pattern_{$p}";
            $b = "matches_{$p}";
            if (preg_match(${$a}, $output->descricao, ${$b})) {
                if(is_numeric(${$b}[1])) {
                    $output->{$p} = ${$b}[1];
                }
            }
        }

        $output->banheiros = preg_match_all('/\bWC\b/', $output->descricao, $matches);
        $output->area_total = is_null($output->area_total) ? 0 : floatval($output->area_total);
        $output->area_privativa = is_null($output->area_privativa) ? 0 : floatval($output->area_privativa);
        $output->area_terreno = is_null($output->area_terreno) ? 0 : floatval($output->area_terreno);
        $output->quartos = is_null($output->quartos) ? 0 : intval($output->quartos);
        // $output->banheiros = is_null($output->banheiros) ? 0 : intval($output->banheiros);
        $output->salas = is_null($output->salas) ? 0 : intval($output->salas);
        $output->vagas_garagem = is_null($output->vagas_garagem) ? 0 : intval($output->vagas_garagem);

        return $output;
    }
}


if (!function_exists('aplicarTaxas')) {
    function aplicarTaxas($imovel, $taxas)
    {
        $valores = null;

        $taxa = $taxas->buscarRegra(['existe_inicial' => $imovel->valor_avaliacao])->first();
        if($taxa) {


            $valores = [
                'usuario_id' => $imovel->usuario_id
                , 'imovel_id' => $imovel->id
                , 'ativo' => 1
                , 'regra' => json_encode( $taxa->toArray() )
                , 'data_criacao' => date('Y-m-d H:i:s')
                , 'data_atualizacao' => date('Y-m-d H:i:s')
                , 'valor_mercado' => (float) $imovel->valor_avaliacao
                , 'valor_avaliacao' => (float) $imovel->valor_avaliacao
                , 'valor_arremate' => (float) $imovel->valor_venda
                , 'valor_prazo' => $taxa->valor_prazo
            ];

            $valores['valor_desconto'] = ($valores['valor_avaliacao'] / 100) * $taxa->valor_desconto;
            $valores['valor_entrada'] = ($valores['valor_arremate'] / 100) * $taxa->valor_entrada;
            $valores['valor_documentacao'] = ($valores['valor_mercado'] / 100) * $taxa->valor_documentacao;
            $valores['valor_desocupacao'] = ($valores['valor_mercado'] / 100) * $taxa->valor_desocupacao;
            $valores['valor_reforma'] = ($valores['valor_mercado'] / 100) * $taxa->valor_reforma;
            $valores['valor_deposito_inicial'] = $valores['valor_entrada'] +
                $valores['valor_documentacao'] +
                $valores['valor_desocupacao'] +
                $valores['valor_reforma'];
            $valores['valor_despesa_venda'] = ($valores['valor_mercado'] / 100) * $taxa->valor_despesa_venda;
            $valores['valor_despesa_extra'] = ($valores['valor_mercado'] / 100) * $taxa->valor_despesa_extra;
            $valores['valor_saldo_devedor'] = $valores['valor_arremate'] -
                $valores['valor_entrada'];

            $valores['valor_condominio_mensal'] = ($valores['valor_mercado'] / 100) * $taxa->valor_condominio;
            $valores['valor_condominio_anual'] = $valores['valor_condominio_mensal'] * $taxa->valor_prazo;
            $valores['valor_iptu_mensal'] = ($valores['valor_mercado'] / 100) * $taxa->valor_iptu;
            $valores['valor_iptu_anual'] = $valores['valor_iptu_mensal'] * $taxa->valor_prazo;
            $valores['valor_prestacao_mensal'] = ($valores['valor_arremate'] / 100) * $taxa->valor_prestacao_financiamento;
            $valores['valor_prestacao'] = $valores['valor_prestacao_mensal'] * $taxa->valor_prazo;

            $valores['valor_investimento'] = $valores['valor_deposito_inicial'] +
                $valores['valor_prestacao'] +
                $valores['valor_condominio_anual'] +
                $valores['valor_iptu_anual'] +
                $valores['valor_despesa_venda'] +
                $valores['valor_despesa_extra']
                ;
            $valores['valor_reembolso'] = $valores['valor_investimento'];
            $valores['valor_saldo_operacao'] = $valores['valor_avaliacao'] - (
                $valores['valor_saldo_devedor'] +
                $valores['valor_reembolso']
            );
        }

        return $valores;

    }
}

if (! function_exists('dir_blade')) {
    function dir_blade($string) {
        $textosParaRemover = ['.index', '.update', '.show', '.store'];

        foreach ($textosParaRemover as $texto) {
            $string = str_replace($texto, '', $string);
        }

        return $string;
    }
}

if (! function_exists('formatarValor')) {
    function formatarValor($valor) {

        $valor = str_replace(',', '', $valor);
        $valor = str_replace('.', '', $valor);

        if(
            !empty($valor)
            && is_numeric($valor)
        ) {
            $valor = intval($valor);
            $valor = $valor / 100;
            $valor = number_format($valor, 2, '.', '');

            return $valor;
        }

        return null;
    }
}

if (! function_exists('formatarValorReal')) {
    function formatarValorReal($valor) {

        return number_format($valor, 2, ',', '.');
    }
}

if (! function_exists('getMetaTags')) {
    function getMetaTags($imovel) {

        $imovel->quartos = intval($imovel->quartos);
        $imovel->banheiros = intval($imovel->banheiros);
        $imovel->salas = intval($imovel->salas);
        $imovel->vagas_garagem = intval($imovel->vagas_garagem);

        $title = 'Imóvel em ';
        $title .= strlen($imovel->bairro) > 0 ? "{$imovel->bairro}, " : "";
        $title .= "{$imovel->cidade} - {$imovel->sigla}";
        $title .= " | VIP Imóveis da Caixa";
        $title = ucwords(mb_strtolower($title));

        $keywords = [
            'imóvel'
            ,ucwords(mb_strtolower($imovel->unidade))
            ,ucwords(mb_strtolower($imovel->cidade))
            ,ucwords(mb_strtolower($imovel->endereco))
            ,'venda de imóveis'
            ,'análise de investimento'
            ,'imóveis da Caixa',
        ];

        if(strlen($imovel->bairro) > 0) {
            $keywords[] = ucwords(mb_strtolower($imovel->bairro));
        }

        if(strlen($imovel->quartos) > 0) {
            $keywords[] = $imovel->quartos > 1 ? "{$imovel->quartos} quartos" : "quarto";
        }

        if(strlen($imovel->banheiros) > 0) {
            $keywords[] = $imovel->banheiros > 1 ? "{$imovel->banheiros} banheiros" : "banheiro";
        }

        if(strlen($imovel->salas) > 0) {
            $keywords[] = $imovel->salas > 1 ? "{$imovel->salas} salas" : "sala";
        }

        if(strlen($imovel->vagas_garagem) > 0) {
            $keywords[] = $imovel->vagas_garagem > 1 ? "{$imovel->vagas_garagem} vagas de garagem" : "vaga de garagem";
        }

        $keywords[] = $imovel->matricula_id;

        $keywords = implode(', ', $keywords);


        $description = '';
        if(strlen($imovel->bairro) > 0) {
            $description .= "Confira este ". mb_strtolower($imovel->unidade) ." localizado ";
            $description .= "no bairro ".ucwords(mb_strtolower($imovel->bairro));
            $description .= " em ". ucwords(mb_strtolower($imovel->cidade));
            $description .= " - {$imovel->sigla}.";
            $description .= "O imóvel está situado na " . ucwords(mb_strtolower($imovel->endereco)).".";

            $area = [];
            if($imovel->area_total > 0) {
                $area[] = "área total de {$imovel->area_total}m²";
            }

            if($imovel->area_privativa > 0) {
                $area[] = "área privativa de {$imovel->area_privativa}m²";
            }

            if($imovel->area_terreno > 0) {
                $area[] = "área de terreno de {$imovel->area_terreno}m²";
            }

            if(count($area) > 0){
                $area = implode(' e ', $area);
                $description .= "Com {$area}. ";
            }

            $unidades = [];
            if($imovel->quartos > 0) {
                $unidades[] = $imovel->quartos > 1 ? "{$imovel->quartos} quartos" : "quarto";
            }

            if($imovel->banheiros > 0) {
                $unidades[] = $imovel->banheiros > 1 ? "{$imovel->banheiros} banheiros" : "banheiro";
            }

            if($imovel->salas > 0) {
                $unidades[] = $imovel->salas > 1 ? "{$imovel->salas} salas" : "sala";
            }

            if($imovel->vagas_garagem > 0) {
                $unidades[] = $imovel->vagas_garagem > 1 ? "{$imovel->vagas_garagem} vagas de garagem" : "garagem";
            }

            if(count($unidades) > 0) {
                $unidades = implode(', ', $unidades);
                $description .= "Possui {$unidades}. ";
            }

            $description .= "Não perca essa oportunidade de investimento!";
        }

        $tags = (object) [
            'title' => $title,
            'keywords' => $keywords,
            'description' => $description
        ];

        return $tags;
    }
}

if (! function_exists('paginacao')) {
    function paginacao($pagina = 0) {

        $url_complete = url()->full();
        $url = strtok($url_complete, '?');

        $params = parse_url( $url_complete, PHP_URL_QUERY);
        parse_str($params, $parametros);

        if(strlen($pagina) > 0) {
            $parametros['page'] = $pagina;
        }

        $p = [];

        foreach($parametros as $key => $value) {
            switch($key) {
                case 'page': {
                    if($pagina == 0) {

                    } else {
                        $p[] = "{$key}={$value}";
                    }
                    break;
                }

                default: $p[] = "{$key}={$value}";
            }
        }

        $p = implode('&', $p);

        return "{$url}?{$p}";
    }
}

if (! function_exists('request_valor')) {
    function request_valor($parametros = []) {

        $req = (object) [];

        foreach($parametros as $key => $value) {
            $req->{ $key } = $value;
        }

        return $req;
    }
}

if (! function_exists('criarImagemTexto')) {
    function criarImagemTexto($largura, $altura, $texto) {

        $image = imagecreatetruecolor($largura, $altura);
        $corFundo = imagecolorallocate($image, 204, 204, 204);
        imagefill($image, 0, 0, $corFundo);

        // Definir cor para o texto (preto)
        $corTexto = imagecolorallocate($image, 153, 153, 153);

        // Caminho para a fonte
        $fonte = storage_path("app/fonts/Arial.ttf");

        // Tamanho do texto
        $tamanhoTexto = 20;

        // Obter as dimensões do texto
        $bbox = imagettfbbox($tamanhoTexto, 0, $fonte, $texto);

        // Calcular as coordenadas para centralizar o texto horizontalmente
        $textWidth = $bbox[2] - $bbox[0]; // largura do texto
        $textHeight = $bbox[1] - $bbox[7]; // altura do texto
        $textX = ($largura - $textWidth) / 2; // coordenada X para centralizar horizontalmente

        // Calcular as coordenadas para centralizar o texto verticalmente
        $textY = ($altura + $textHeight) / 2; // coordenada Y para centralizar verticalmente

        // Adicionar texto à imagem
        imagettftext($image, $tamanhoTexto, 0, $textX, $textY, $corTexto, $fonte, $texto);

        // Configurar cabeçalho para imagem JPEG
        header('Content-Type: image/jpeg');

        // Exibir imagem
        imagejpeg($image);

        // Liberar recursos da imagem
        imagedestroy($image);

    }
}
