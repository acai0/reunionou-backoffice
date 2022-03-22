<?php

namespace reu\back\app\controller;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use reu\back\app\models\Commande;
use reu\back\app\errors\Writer;
require __DIR__ .'/../models/Comment.php';
require __DIR__ . '/../errors/Writer.php';
class CommandeController
{
    private $c;

    public function __construct(\Slim\Container $c)
    {
        $this->c = $c;
    }

    // Récuperer toutes les commandes
    public function getAllCommande(Request $req, Response $resp): Response
    {
        $filtrage=$req->getQueryParams()['s']?? null;
        $pagination= $req->getQueryParams()['page']?? 1;
        $size=$req->getQueryParams()['size']?? 10;
       // $commandes = Commande::select(['id', 'nom', 'montant', 'created_at', 'status'])->orderBy('livraison', 'DESC')->get();

       if($filtrage){
           $c= Commande::select(['id', 'nom', 'montant', 'created_at', 'status'])->where('status', '=',$filtrage)->orderBy('livraison', 'DESC')->get();
           $count=count($c);
        } else {
            $c= Commande::select(['id', 'nom', 'montant', 'created_at', 'status'])->get();
            $count=count($c);
        }

        $nb= $count/$size;
        if($pagination){
            if($pagination<0){
                $c= $c->take($size);
                $size=count($c);
            }else if($pagination>$nb){
                $skip=($page -1)*$size;
                $c=$c->skip($skip)->take($size);
                $size=count($c);
            }
            else{
                $skip=($pagination-1)*$size;
                $c=$c->skip($skip)->take($size);
                $size=count($c);
            }
        }

        $commande_response = [];
        $commande = [];
        foreach ($commandes as $c) {
            //le path d'une commande
            $commandePath = $this->c->router->pathFor(
                'getCommande',
                ['id' => $c->id]
            );

            $commande["commande"] = $c;
            $commande["links"] =  $commandePath;
            array_push($commande_response, $commande);
        }
        
        $data_resp = [
            "type" => "collection",
            //"count" => count($commandes),
            "count" => $count,
            "size"=>$size,
            "page"=>$pagination,
            "commandes" => $commande_response
        ];

        $resp->getBody()->write(json_encode($data_resp));
        return writer::json_output($resp, 200);
    }


    public function getCommande(Request $req, Response $resp, array $args): Response
    {
        $id_commande = $args['id'];
        $queries = $req->getQueryParams()['embed'] ?? null;

        try {
            $commande = Commande::select(['id', 'mail', 'nom', 'livraison', 'montant'])
                ->where('id', '=', $id_commande)
                ->firstOrFail();


            //Récuperer la route de la commande en question                           
            $commandePath = $this->c->router->pathFor(
                'getCommande',
                ['id' => $id_commande]
            );

            $CommandeWithItemsPath = $this->c->router->pathFor('getItems', ['id' => $id_commande]);

            // Création des liens hateos
            $hateoas = [
                "items" => ["href" => $CommandeWithItemsPath],
                "self" => ["href" => $commandePath]
            ];

            // Création du body de la réponse
            $datas_resp = [
                "type" => "ressource",
                "commande" => $commande,
                "links" => $hateoas,
            ];

            //*Ressources imbriquées TD4.3
            //GET /commandes/K9J67-4D6F5?embed=items
            if ($queries === 'items') {
                $items = $commande->items()->select('id', 'libelle', 'tarif', 'quantite')->get();
                $datas_resp["commande"]["items"] = $items;
            }

            $resp->getBody()->write(json_encode($datas_resp));
            return writer::json_output($resp, 200);
        } catch (ModelNotFoundException $e) {
            $clientError = $this->c->clientError;
            return $clientError($req, $resp, 404, "Commande not found");
        }
    }
}