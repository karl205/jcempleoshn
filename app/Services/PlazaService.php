<?php

namespace App\Services;

use App\Repositories\StoredProcedures\PlazaSPRepository;

class PlazaService
{
    protected $repo;

    public function __construct(PlazaSPRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listar()
    {
        return $this->repo->listar();
    }

    public function obtener($id)
    {
        return $this->repo->obtener($id);
    }

    public function crear(array $data)
    {
        return $this->repo->crear($data);
    }
}
