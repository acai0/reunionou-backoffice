<?php 

$config = [
    'settings'=>[
        'dbfile' => __DIR__. '/conf.ini',
        'displayErrorDetails'=> true,
        'debug.log' => __DIR__.'../log/debug.log',
        'log.level' => \Monolog\Logger::DEBUG,
        'log.name' => 'slim.log'
    ],
];

return $config;