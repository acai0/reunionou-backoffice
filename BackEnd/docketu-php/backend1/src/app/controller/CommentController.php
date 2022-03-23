<?php

namespace reu\back\app\controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Model
use \reu\back\app\models\Comment as Comment;


//Error

class CommentController {

    private $container;

    public function __construct(\Slim\Container $container){
        $this->container = $container;
    }


    public function getAllComments(Request $req, Response $resp, array $args): Response {

        //Get all the comments
        $comments = Comment::select(['id', 'id_event', 'id_user', 'content'])
            ->get();

        //complete the data
        $data = [
            "type" => "collection", 
            "count" => count($comments),
            "comments" => $comments,
        ];

        //Configure the response header
        $resp = $resp->withStatus(200)
            ->withHeader('Content-Type', 'application/json; charset=utf-8');

        //Write in the body with data encode with json_encode
        $resp->getBody()->write(json_encode($data));

        //Return the response 
        return $resp;
    }

    public function getOneComment(Request $res, Response $resp, array $args): Response {

        //Get the id in the URI
        $id = $args['id'];

        //Get the comment with some id
        $comment = Comment::select(['id', 'id_event', 'id_user', 'content'])
            ->where('id', '=', $id);

        //Complete the data
        $data = [
            "type" => "ressource",
            "comment" => $comment,
        ];

        //Configure the response header
        $resp = $resp->withStatus(200)
            ->withHeader('Content-Type', 'application/json; charset=utf-8');

        //Write in the body with data encode with json_encode
        $resp->getBody()->write(json_encode($data));

        //Return the response
        return $resp;
    }

}


?>