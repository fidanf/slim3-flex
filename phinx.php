<?php 
require __DIR__ . '/vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    die($e);
}

$config = require __DIR__ . '/config/database.php';

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'migration_base_class' => 'App\Support\Migrations\Migration',
    'templates' => [
        'file' => '%%PHINX_CONFIG_DIR%%/app/Support/Migrations/Migration.stub'
    ],   
    'environments' => [
        'default_migration_table' => $config['migrations'],
        'default' => [
          	'adapter' => $config['db']['driver'],
            'host' => $config['db']['host'],
            'name' => $config['db']['database'],
            'user' => $config['db']['username'],
            'pass' => $config['db']['password'],
            'port' => $config['db']['port'],
        ]
    ]
];
