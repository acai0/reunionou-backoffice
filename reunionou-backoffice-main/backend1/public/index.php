<?php
/**
 * File:  index.php
 *
 */

require_once  __DIR__ . '/../src/vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request ;
use \Psr\Http\Message\ResponseInterface as Response ;

use reu\back1\app\models\User;


$conf = parse_ini_file(__DIR__ .'/../src/app/conf/conf.ini');

$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection($conf); 
$db->setAsGlobal();           
$db->bootEloquent();   


$config = require_once __DIR__. '/../src/app/conf/settings.php';
$deps = require_once __DIR__.'/../src/app/conf/dependencies.php';

$c=new \Slim\Container(array_merge($config, $deps));

$app = new \Slim\App($c);

$app->get('/hello/{name}',
    function (Request $req, Response $resp, $args) {
        $name = $args['name'];
        $dbfile = $this->settings['dbfile'];

        $r = User::select()->get();
        foreach($r as $l){
            echo $l->fullname; 
        }

        $resp->getBody()->write("<h1>Hello, $name </h1> <h2>$dbfile</h2>");
        return $resp;
    }
);

//Les routes de l'application
require_once __DIR__ . '/../src/app/routes/routes.php';
$app->run();

?>