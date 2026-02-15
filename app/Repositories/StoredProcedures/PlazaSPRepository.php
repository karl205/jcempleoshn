<?php

namespace App\Repositories\StoredProcedures;

class PlazaSPRepository extends BaseSPRepository
{
    public function listar()
    {
        return $this->call('sp_plazas_listar');
    }

    public function obtener(int $id)
    {
        $result = $this->call('sp_plazas_obtener', [$id]);
        return $result[0] ?? null;
    }

    public function crear(array $data)
    {
        return $this->execute('sp_plazas_crear', [
            $data['titulo'],
            $data['descripcion'],
            $data['salario']
        ]);
    }
}
