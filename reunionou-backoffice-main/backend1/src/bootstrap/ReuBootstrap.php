<?php
namespace reu\back1\app\bootstrap;

use Illuminate\Database\Capsule\Manager;

class ReuBootstrap {

    public static function startEloquent($file) {

        $conf = parse_ini_file($file);
        $db = new Manager();

        $db->addConnection($conf);
        $db->setAsGlobal();
        $db->bootEloquent();

    }
}
