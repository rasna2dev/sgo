<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\RegraModel;

class RegraRepository
{

    protected $regraModel;

    public function __construct(RegraModel $regraModel)
    {
        $this->regraModel = $regraModel;
    }

    public function create(array $data)
    {
        return $this->regraModel->create($data);
    }

    public function update($id, array $data)
    {
        $tarifa = $this->find($id);
        if ($tarifa) {
            $tarifa->update($data);
            return $tarifa;
        }
        return null;
    }

    public function destroy(int $id)
    {
        return $this->regraModel->destroy($id);
    }

    public function find($id)
    {
        return $this->regraModel->find($id);
    }

    public function get()
    {
        return $this->regraModel->orderBy('valor_inicial');
    }

    public function search(int $id, array $data)
    {
        $query = $this->regraModel->select('*');

        if(isset($data['existe_prazo'])) {
            $query->where('valor_prazo', $data['existe_prazo']);
        }

        $query->where(function($filter) use ($data) {
            if(
                isset($data['existe_inicial']) &&
                isset($data['existe_final'])
            ) {
                $filter->whereRaw($data['existe_inicial'] . ' BETWEEN valor_inicial AND valor_final');
                $filter->orWhereRaw($data['existe_final'] . ' BETWEEN valor_inicial AND valor_final');
            } elseif(isset($data['existe_inicial'])) {
                $filter->whereRaw($data['existe_inicial'] . ' BETWEEN valor_inicial AND valor_final');
            } elseif(isset($data['existe_final'])) {
                $filter->orWhereRaw($data['existe_final'] . ' BETWEEN valor_inicial AND valor_final');
            }
        });

        return $query;
    }

    public function chechExists(int $id, array $data)
    {
        return $this->search($id, $data);
    }

}
