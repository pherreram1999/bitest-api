<?php

namespace App\Database;

use Libsql\PDOStatement as BaseLibsqlPDOStatement;
use PDO;

class LibsqlPDOStatement extends BaseLibsqlPDOStatement
{
    private array $deferred = [];

    public function bindValue(string|int $param, mixed $value, int $type = PDO::PARAM_STR): bool
    {
        $this->deferred[$param] = match (true) {
            $value === null => null,
            $type === PDO::PARAM_NULL => null,
            $type === PDO::PARAM_INT => (int) $value,
            $type === PDO::PARAM_BOOL => (int) (bool) $value,
            default => (string) $value,
        };

        return true;
    }

    public function execute(?array $params = null): bool
    {
        $merged = $this->deferred;

        if ($params !== null) {
            foreach ($params as $key => $value) {
                $merged[$key] = $value;
            }
        }

        $this->deferred = [];

        return parent::execute($merged === [] ? null : $merged);
    }
}
