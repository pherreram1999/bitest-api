<?php

namespace App\Providers;

use App\Database\LibsqlConnector;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        DB::extend('libsql', function (array $config, string $name): SQLiteConnection {
            $config['name'] ??= $name;
            $config['prefix'] ??= '';

            $pdo = (new LibsqlConnector)->connect($config);

            return new SQLiteConnection(
                pdo: $pdo,
                database: $config['database'] ?? '',
                tablePrefix: $config['prefix'],
                config: $config,
            );
        });

        Scramble::configure()
            ->withDocumentTransformers(function (OpenApi $openApi) {
                $openApi->info->title = 'bitets-api';
                $openApi->info->version = '1.0.0';
            });
    }
}
