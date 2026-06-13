<?php

namespace App\Database;

class LibsqlConnector
{
    public function connect(array $config): LibsqlPDO
    {
        if (! empty($config['turso_url'])) {
            return new LibsqlPDO(
                dsn: null,
                password: $config['password'] ?? null,
                options: ['url' => $config['turso_url']],
            );
        }

        return new LibsqlPDO(dsn: $config['database']);
    }
}
