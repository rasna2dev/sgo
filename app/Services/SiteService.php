<?php

namespace App\Services;

// use App\Repositories\BairroRepository;
// use Illuminate\Support\Str;
use App\Services\ImovelService;
use App\Services\EstadoService;
use App\Services\CidadeService;
use App\Services\BairroService;
// use App\Repositories\ModalidadeRepository;
use App\Services\UnidadeService;

class SiteService
{

    protected
        $imovelService
        , $estadoService
        , $cidadeService
        , $bairroService
        // ,$modalidadeRepository
        , $unidadeService
        ;

    public function __construct(
        ImovelService $imovelService
        , UnidadeService $unidadeService
        , EstadoService $estadoService
        , CidadeService $cidadeService
        , BairroService $bairroService
        // ,ModalidadeRepository $modalidadeRepository
        // ,UnidadeRepository $unidadeRepository
    )
    {
        $this->imovelService = $imovelService;
        $this->estadoService = $estadoService;
        $this->cidadeService = $cidadeService;
        $this->bairroService = $bairroService;
        // $this->modalidadeRepository = $modalidadeRepository;
        $this->unidadeService = $unidadeService;
    }

    public function getEstados(array $data = [])
    {
        return $this->estadoService->getEstado($data);
    }

    public function getCidades(array $data = [])
    {
        return $this->cidadeService->getCidade($data);
    }

    public function getBairros(array $data = [])
    {
        return $this->bairroService->getBairro($data);
    }

    public function getUnidades(array $data = [])
    {
        return $this->unidadeService->getUnidade($data);
    }

    public function getImoveis(array $data = [])
    {
        return $this->imovelService->buscarImovel($data)->paginate(18);
    }

    public function getTopSwiper()
    {
        return $this->imovelService->search([
                'modo' => 'pesquisa',
                'vendido' => 0,
                'principal' => 1,
                'cfoto' => 1
            ])->inRandomOrder()->take(3)->get();
    }
}
