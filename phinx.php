<?php 

try {
    (new Dotenv\Dotenv(base_path()))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    die($e);
}

$config = new \Noodlehaus\Config(
    base_path('config/database.php')
);

return [
    'paths' => [
        'migrations' => $config->get('migrations.paths.migrations'),
        'seeds' => $config->get('migrations.paths.seeds')
    ],
    'migration_base_class' => $config->get('migrations.migration_base_class'),
    'templates' => [
        'file' => '%%PHINX_CONFIG_DIR%%/app/Support/Migrations/Migration.stub'
    ],   
    'environments' => [
        'default_migration_table' => $config->get('migrations.default_migration_table'),
        'default' => [
          	'adapter' => $config->get('db.driver'),
            'host' => $config->get('db.host'),
            'name' => $config->get('db.database'),
            'user' => $config->get('db.username'),
            'pass' => $config->get('db.password'),
            'port' => $config->get('db.port'),
        ]
    ]
];
