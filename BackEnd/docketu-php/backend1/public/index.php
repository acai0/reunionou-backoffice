<?php
 require_once __DIR__ . '/../src/t.php' ;
 require_once __DIR__ . '/../src/vendor/autoload.php' ;
 require_once __DIR__ .'/../src/app/bootstrap/Bootstrap.php';
 //test();
use reu\back\app\bootstrap\Bootstrap;
// Les fichiers contenant les dépendance de l'application
$config = require_once __DIR__ . '/../src/app/conf/settings.php';
$dependencies = require_once __DIR__ . '/../src/app/conf/dependencies.php';
$errors = require_once __DIR__ . '/../src/app/conf/errors.php';

$app = new \Slim\App();
//Une instance du conteneur de dépendance
$c = new \Slim\Container(array_merge($config,$dependencies, $errors));
$app = new \Slim\App($c);
Bootstrap::startEloquent($c->settings['dbfile']);

require_once __DIR__ . '/../src/app/routes/routes_td.php';
$app->run();

?>
