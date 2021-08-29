<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Framework\Configuration\DatabaseConfiguration;

$capsule = new Capsule;

$capsule->addConnection(DatabaseConfiguration::getConnection());

$capsule->setAsGlobal();
$capsule->bootEloquent();
