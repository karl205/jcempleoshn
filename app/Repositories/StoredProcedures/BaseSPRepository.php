<?php

namespace App\Repositories\StoredProcedures;

use Illuminate\Support\Facades\DB;

abstract class BaseSPRepository
{
    protected function call(string $procedure, array $params = [])
    {
        $placeholders = implode(',', array_fill(0, count($params), '?'));

        $sql = count($params) > 0
            ? "CALL {$procedure}({$placeholders})"
            : "CALL {$procedure}()";

        return DB::select($sql, $params);
    }

    protected function execute(string $procedure, array $params = [])
    {
        $placeholders = implode(',', array_fill(0, count($params), '?'));

        $sql = count($params) > 0
            ? "CALL {$procedure}({$placeholders})"
            : "CALL {$procedure}()";

        return DB::statement($sql, $params);
    }
}
