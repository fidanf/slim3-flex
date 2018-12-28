<?php
namespace App\Support\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration;

class Migration extends AbstractMigration {
    /** @var \Illuminate\Database\Capsule\Manager $capsule */
    public $capsule;
    /** @var \Illuminate\Database\Schema\Builder $capsule */
    public $schema;
    public function init()
    {
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
          'driver' => env('DB_DRIVER'),
          'host' => env('DB_HOST'),
          'database' => env('DB_DATABASE'),
          'username' => env('DB_USERNAME'),
          'password' => env('DB_PASSWORD'),
          'charset' => 'utf8',
          'port' => env('DB_PORT'),
          'collation' => 'utf8_unicode_ci',
          'prefix' => ''
        ]);
        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
        $this->schema = $this->capsule->schema();
    }
}