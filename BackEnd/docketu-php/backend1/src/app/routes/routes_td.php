<?php


use \reu\back\app\controller\ReuController;
use \reu\back\app\middleware\Middleware;
//use \reu\back\app\middleware\ReuValidator as ReuValidator;
use \DavidePastore\Slim\Validation\Validation as Validation ;
require_once __DIR__ . '/../Middleware/Middleware.php';
require_once __DIR__ . '/../controller/ReuController.php';
//$validators =ReuValidator::create_validators();

//Routes de l'API

$app->get('/', ReuController::class. ':getAllUser')->setName('getAllUser')->add(middleware::class. ':putIntoJson');

//Route pour retourner le contenu d'un événement
$app->get('/events/{id}[/]', ReuController::class. ':OneEvent')->setName('oneEvent')->add(middleware::class. ':putIntoJson');


//Route pour retourner le contenu de tous les événements
$app->get('/events[/]', ReuController::class. ':getAllEvents')->setName('getAllEvents')->add(middleware::class. ':putIntoJson');


//Route pour modifier le contenu d'un événement
$app->put('/events/{id}[/]', ReuController::class. ':putEvent')->setName('putEvent')->add(middleware::class. ':putIntoJson');


//Route pour les participants d'un événement
$app->get('/events/{id}/participants', ReuController::class.':getAllUser')->setName('allUser')->add(middleware::class. ':putIntoJson');

//Route pour un user
$app->get('/events/{id}/participant', ReuController::class.':OneUser')->setName('OneUser')->add(middleware::class. ':putIntoJson');


//Route pour tous les commentaires
$app->get('/comments[/]', ReuController::class.':getAllComment')->setName('allComment')->add(middleware::class. ':putIntoJson');

///Route pour retourner le contenu d'un commentaire
$app->get('/comments/{id}[/]', ReuController::class. ':OneComment')->setName('oneComment')->add(middleware::class. ':putIntoJson');


?>