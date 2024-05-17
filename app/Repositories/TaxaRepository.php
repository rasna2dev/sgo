<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\TaxaModel;

class TaxaRepository
{

    protected $taxaModel;

    public function __construct(TaxaModel $taxaModel)
    {
        $this->taxaModel = $taxaModel;
    }

    public function updateOrCreate(array $conditions, array $data)
    {
        return $this->taxaModel->updateOrCreate($conditions, $data);
    }

}
