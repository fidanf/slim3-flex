<?php

namespace App\Support\Migrations;

use Noodlehaus\Config;
use Phinx\Migration\AbstractMigration;
use Illuminate\Database\Capsule\Manager as Capsule;

class Migration extends AbstractMigration {

    /** @var \Illuminate\Database\Capsule\Manager $capsule */
    public $capsule;

    /** @var \Illuminate\Database\Schema\Builder $capsule */
    public $schema;

    public function init()
    {
        $config = new Config(
            base_path('config/database.php')
        );

        $this->capsule = new Capsule;
        $this->capsule->addConnection($config->get('db'));
        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
        $this->schema = $this->capsule->schema();
    }
}