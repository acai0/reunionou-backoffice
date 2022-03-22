<?php
namespace reu\back\app\middleware;
use \Slim\Container;

class Middleware{

    private $c;

    public function __construct(Container $c){
        $this->c = $c;
    }

    public function putIntoJson($rq, $rs, callable $next){
        $rs = $rs->withHeader("Content-Type", "application/json;charset=utf-8");
        return $next($rq,$rs);
    }

    public function corsHeaders(Request $rq, Response $rs, callable $next): Response{
        if (!$rq->hasHeader('Origin'))
        return Writer::json_error($rs, 401, "missing Origin Header (cors)");
        $response = $next($rq, $rs);
        $response = $response
        ->withHeader('Access-Control-Allow-Origin', '*');
        //->withHeader('Access-Control-Allow-Origin', 'http://myapp.net')
        //->withHeader('Access-Control-Allow-Origin', 'http://myapp.net');;
        return $response;
    }

}