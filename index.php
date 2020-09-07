<?php
session_start();

//Les routes du sites
//Création de chemins absolus, afin d'accèder à nos ressources...
//Exemple : http://localhost/jur_zoo/...ressource
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

/*Appel des controllers qu'une seule fois*/
require_once("controllers/front/API.controller.php");
require_once("controllers/back/Admin.controller.php");
require_once("controllers/back/Familles.controller.php");
require_once("controllers/back/Animaux.controller.php");

$apicontroller = new APIController();
$admincontroller = new AdminController();
$famillesController = new FamillesController();
$animauxController = new AnimauxController();

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
                    case "sendMessage":
                        $apicontroller->sendMessage();
                        break;
                    default :
                        throw  new Exception("La page n'éxiste pas.");
                }
                break;
            case "back" :
                switch ($url[1]) {
                    case "login" :
                        $admincontroller->getPageLogin();
                        break;
                    case "connexion":
                        $admincontroller->connexion();
                        break;
                    case "deconnexion":
                        $admincontroller->deconnexion();
                        break;
                    case "admin":
                        $admincontroller->getAccueilAdmin();
                        break;
                    case "creationdescomptes" :
                        $admincontroller->getPageCreationCompte();
                        break;
                    case "ajouterAdministrateur" :
                        $admincontroller->ajouterAdministrateur();
                        break;
                    case "familles" :
                        switch ($url[2]) {
                            case "visualisation" :
                                $famillesController->visualisation();
                                break;
                            case "validationSuppression":
                                $famillesController->suppression();
                                break;
                            case "validationModification":
                                $famillesController->modification();
                                break;
                            case "creation":
                                $famillesController->creationVue();
                                break;
                            case "creationValidation":
                                $famillesController->creationValidation();
                                break;
                            default :
                                throw  new Exception("La page n'éxiste pas.");
                        }
                        break;
                    case "animaux" :
                        switch ($url[2]) {
                            case "visualisation" :
                                $animauxController->visualisation();
                                break;
                            case "validationSuppression" :
                                $animauxController->validationSuppression();
                                break;
                            case "creation" :
                                $animauxController->creation();
                                break;
                            case "creationValidation" :
                                $animauxController->creationValidation();
                                break;
                            case "modification" :
                                /*http://myzoo.org/zooback/back/animaux/modification/2 $url[3]->2*/
                                $animauxController->modification($url[3]);
                                break;
                            default :
                                throw  new Exception("La page n'éxiste pas.");
                        }
                        break;
                    default :
                        throw  new Exception("La page n'éxiste pas.");
                }
                break;
            default :
                throw  new Exception("La page n'éxiste pas.");
        }
    }
} catch
(Exception $e) {
    /*    $msg = $e->getMessage();
        echo $msg;
        echo "<a href='" . URL . "back/login'>Se connecter</a>";*/

    header('Location: ' . URL . '/back/login');
}

//http://localhost/myzoo/zooback/front/animaux/2/1
//http://localhost/myzoo/zooback/front/animaux/1/1
//http://localhost/myzoo/zooback/front/animaux
