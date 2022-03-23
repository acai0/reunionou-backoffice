<?php

namespace reu\back\app\controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Model
use \reu\back\app\models\Event as Event;


//Error

class EventController {

    private $container;

    public function __construct(\Slim\Container $container){
        $this->container = $container;
    }


    public function getAllEvents(Request $req, Response $resp, array $args): Response {

        //Get all the events
        $events = Event::select(['id', 'title', 'description', 'date', 'place', 'id_user'])
            ->get();

        //Complete the data
        $data = [
            "type" => "collection",
            "count" => count($events),
            "users" => $events,
        ];

        //Configure the response header
        $resp = $resp->withStatus(200)
            ->withHeader('Content-Type', 'application/json; charset=utf-8');

        //Write in the body with data encode with json_encode
        $resp->getBody()->write(json_encode($data));

        //Return the response 
        return $resp; 
    }

    public function OneEvent(Request $res, Response $resp, array $args): Response {

        //Get the id in the URI
        $id = $args['id'];

        //Get the event with some id
        $event = Event::select(['id', 'title', 'description', 'date', 'place', 'id_user'])
            ->where('id', '=', $id);

        //Complete the data
        $data = [
            "type" => "ressource",
            "event" => $event,
        ];

        //Configure the response header
        $resp = $resp->withStatus(200)
            ->withHeader('Content-Type', 'application/json; charset=utf-8');

        //Write in the body data encode with a json_encode
        $resp->getBody()->write(json_encode($data));

        //Return the response
        return $resp;
    }

}


?>