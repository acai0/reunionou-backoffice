<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use reu\back\app\middleware\Middleware;

class MemberController
{
  public function getAllUsers(Request $req, Response $resp, array $args): Response {
        
    //Get all the Users
    $users = User::select(['id', 'mail', 'fullname', 'username', 'password'])
        ->get();
    
    //complete the data 
    $data = [
        "type" => "collection",
        "count" => count($users),
        "users" => $users,
    ];

    //Configure the response headers
    $resp = $resp->withStatus(200)
        ->withHeader('Content-Type', 'application/json; charset=utf-8');

    //Write in the body with data encode with json_encode
    $resp->getBody()->write(json_encode($data));

    //Return the response
    return $resp;
  }

public function getOneUser(Request $req, Response $resp, array $args): Response {

    //Get the id in the URI
    $id = $args['id'];

    //Get the user with some id
    $user = User::select(['id', 'mail', 'fullname', 'username', 'password'])
        ->where('id', '=', $id);

    //Complete the data
    $data = [
        "type" => "ressource",
        "user" => $user,
    ];

    //Configure the response header
    $resp = $resp->withStatus(200)
        ->withHeader('Content-Type', 'application/json; charset=utf-8');
    
    //Write in the body with data encode a json_encode
    $resp->getBody()->write(json_encode($data));

    //Return the response 
    return $resp;

} 
}