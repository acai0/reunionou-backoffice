<?php
use Slim\Container;
use Monolog\Logger;
use Monolog\Handler\PHPConsoleHandler;
return [
    'settings' => [
        'displayErrorDetails' => true,

        'dbfile' => __DIR__ . '/conf.ini',

        'debug.name' => 'com.log',
        'debug.log' => __DIR__ . '/../log/debug.log',
        'debug.level' => \Monolog\Logger::DEBUG, 

        'warn.name' => 'com.log',
        'warn.log' => __DIR__ . '/../log/warn.log',
        'warn.level' => \Monolog\Logger::WARNING,

        'error.name' => 'com.log',               //Nom du log    
        'error.log' => __DIR__ . '/../log/error.log',  //* Nom du fichier du log    
        'error.level' => \Monolog\Logger::ERROR,  
    ]
];
?>