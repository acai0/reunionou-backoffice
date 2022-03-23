<?php
namespace reu\back\app\controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Model
use \reu\back\app\models\Comment as Comment;


//Error

class AuthController {

    private $container;

    public function __construct(\Slim\Container $container){
        $this->container = $container;
    }
    //get login
    public function getSignIn ($request, $response)
    {
      return $this->view->render($response, 'user/login.twig');
    }
  
    //post
    public function signIn ($request, $response)
    {
      $credentials = [
        'username' => $request->getParam('username'),
        'password' => $request->getParam('password')
      ];
  
      $attempt = $this->container->sentinel->authenticate($credentials);
  
      if (!$attempt) {
        $this->flash->addMessage('error', "There was an error with your login. Please check your credentials.");
        return $response->withRedirect($this->router->pathFor('user.login'));
      } else {
        $this->container->sentinel->login($attempt);
        return $response->withRedirect($this->router->pathFor('home'));
      }
    }
  
    public function signOut($request, $response)
    {
      $this->container->sentinel->signOut();
      return $response->withRedirect($this->router->pathFor('home'));
    }
  
    public function getSignUp ($request, $response)
    {
      return $this->view->render($response, 'user/register.twig');
    }
  
    public function signUp($request, $response)
    {
      $credentials = [
        'username' => $request->getParam('username'),
        'displayname' => $request->getParam('displayname'),
        'email' => $request->getParam('email'),
        'password' => $request->getParam('password')
      ];
  
      $validation = $this->validator->validate($request, [
        'username' => v::noWhitespace()->notEmpty()->userAvailable(),
        'email' => v::noWhitespace()->notEmpty()->emailAvailable(),
        'password' => v::noWhitespace()->notEmpty(),
        // 'password_confirm' => v::noWhitespace()->notEmpty() TODO
      ]);
  
      if ($validation->failed()) {
        return $response->withRedirect($this->router->pathFor('user.register'));
      }
  
      $user = $this->container->sentinel->registerAndActivate($credentials);
  
      $role = $this->container->sentinel->findRoleByName('User');
      $role->users()->attach($user);
  
      $this->flash->addMessage('success', 'You have been successfully registered. Login now.');
      return $response->withRedirect($this->router->pathFor('user.login'));
    }
    public function getAllUser(Request $req, Response $resp, array $args): Response {
          
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
}
?>
