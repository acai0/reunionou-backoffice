<?php


use \reu\back\app\controller\EventController;
use \reu\back\app\controller\MemberController;
use \reu\back\app\controller\CommentController;
use \reu\back\app\middleware\Middleware;
//use \reu\back\app\middleware\ReuValidator as ReuValidator;
use \DavidePastore\Slim\Validation\Validation as Validation ;

require_once __DIR__ .  '/../src/app/controller/EventController.php';
require_once __DIR__ .  '/../src/app/controller/MemberController.php';
//$validators = ReuValidator::create_validators();

//Routes de l'API

//Route pour retourner le contenu d'un événement
$app->get('/events/{id}[/]', EventController::class. ':getOneEvent')->setName('oneEvent');


//Route pour retourner le contenu de tous les événements
$app->get('/events[/]', EventController::class. ':getAllEvents')->setName('allEvents');


//Route pour créer un événement 
//$app->post('/Events/create[/]', EventController::class. ':createEvent')->setName('createEvent');


//Route pour modifier le contenu d'un événement
$app->put('/events/{id}[/]', EventController::class. ':putEvent')->setName('putEvent');


//Route pour les participants d'un événement
$app->get('/events/{id}/members', EventController::class.':getAllUsers')->setName('allUser');


//Route pour un participant
$app->get('/events/{id}/member', MemberController::class.':getOneUser')->setName('oneUser');


//Route pour tous les commentaires
$app->get('/comments[/]', CommentController::class.':getAllComments')->setName('allComment');


//Route pour retourner le contenu d'un commentaire
$app->get('/comments/{id}[/]', EventController::class. ':getOneComment')->setName('oneComment');


//Route pour l'inscription
$app->post('/signup[/]', MemberController::class. ':signUp')->setName('signUp');


//Route pour la connexion
$app->post('/members/signin[/]', MemberController::class. ':signIn')->setName('signIn');


//Route pour la déconnexion
$app->delete('/members/signout[/]', memberController::class.':signOut')->setName('signOut');





?>