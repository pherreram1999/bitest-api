<?php

namespace App\Database;

use Libsql\PDO as BaseLibsqlPDO;
use Libsql\PDOStatement as BaseLibsqlPDOStatement;
use ReflectionProperty;

class LibsqlPDO extends BaseLibsqlPDO
{
    public function prepare(string $query, array $options = []): BaseLibsqlPDOStatement|false
    {
        $target = $this->inTransaction()
            ? (new ReflectionProperty(BaseLibsqlPDO::class, 'tx'))->getValue($this)
            : (new ReflectionProperty(BaseLibsqlPDO::class, 'conn'))->getValue($this);

        return new LibsqlPDOStatement($target->prepare($query), $query);
    }
}
