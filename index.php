<?php
//Les routes du sites
//Création de chemins absolus, afin d'accèder à nos ressources...
//Exemple : http://localhost/jur_zoo/...ressource
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

/*Appel des controllers qu'une seule fois*/
require_once("controllers/front/API.controller.php");
$apicontroller = new APIController();

//Vérification des URLS
try {
    if (empty($_GET['page'])) {
        throw new Exception("La page n'existe pas.");
    } else {
        /*On découpe l'URL avec le '/' dans un tableau*/
        /*On sécurise la découpe de l'url avec le filtre FILTER_SANITIZE_URL*/
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));

        /*On vérifie la syntaxe de l'URL ...front/page ou back/page*/
        if (empty($url[0]) || empty($url[1])) throw  new Exception("La page n'éxiste pas.");

        switch ($url[0]) {
            case "front" :
                switch ($url[1]) {
                    case "animaux":
                        if (!isset($url[2]) || !isset($url[3])) {
                            $apicontroller->getAnimaux(-1, -1);
                        } else {
                            $apicontroller->getAnimaux((int)$url[2], (int)$url[3]);
                        }
                        break;
                    case "animal":
                        /*On passe l'id de l'animal demandé*/
                        if (empty($url[2])) throw new Exception("L'identifiant de l'animal est manquant.");
                        $apicontroller->getAnimal($url[2]);
                        break;
                    case "continents":
                        $apicontroller->getContinents();
                        break;
                    case "familles":
                        $apicontroller->getFamilles();
                        break;
                    case "sendMessage": $apicontroller->sendMessage();
                        break;
                    default :
                        throw  new Exception("La page n'éxiste pas.");
                }
                break;
            case "back" :
                echo "Back...à venir.";
                break;
            default :
                throw  new Exception("La page n'éxiste pas.");
        }
    }
} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}

//http://localhost/myzoo/zooback/front/animaux/2/1
//http://localhost/myzoo/zooback/front/animaux/1/1
//http://localhost/myzoo/zooback/front/animaux
