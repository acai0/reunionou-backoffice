<?php


use \reu\back1\app\controller\eventController;
use \reu\back1\app\controller\memberController;
use \reu\back1\app\controller\commentController;
use \reu\back1\app\middleware\Middleware;
use \reu\back1\app\middleware\EventValidator as EventValidator;
use \DavidePastore\Slim\Validation\Validation as Validation ;

$validators = EventValidator::create_validators();

//require_once __DIR__ . '/../controller/eventController.php';
//Routes de l'API

$app->get('/', eventController::class. ':getEvents')->setName('getEvents');

//Route pour retourner le contenu d'un événement
$app->get('/events/{id}[/]', eventController::class. ':getOneEvent')->setName('oneEvent');


//Route pour retourner le contenu de tous les événements
$app->get('/events[/]', eventController::class. ':getAllEvents')->setName('allEvents');


//Route pour créer un événement 
//$app->post('/events/create[/]', eventController::class. ':createEvent')->setName('createEvent');


//Route pour modifier le contenu d'un événement
$app->put('/events/{id}[/]', eventController::class. ':putEvent')->setName('putEvent');


//Route pour les participants d'un événement
$app->get('/events/{id}/members', eventController::class.':getAllUsers')->setName('allUser');


//Route pour un participant
$app->get('/events/{id}/member', memberController::class.':getOneUser')->setName('oneUser');


//Route pour tous les commentaires
$app->get('/comments[/]', commentController::class.':getAllComments')->setName('allComment');


//Route pour retourner le contenu d'un commentaire
$app->get('/comments/{id}[/]', eventController::class. ':getOneComment')->setName('oneComment');


//Route pour l'inscription
$app->post('/signup[/]', memberController::class. ':signUp')->setName('signUp');


//Route pour la connexion
$app->post('/members/signin[/]', memberController::class. ':signIn')->setName('signIn');


//Route pour la déconnexion
//$app->delete('/members/signout[/]', memberController::class.':signOut')->setName('signOut');





?>