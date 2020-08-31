<?php

require_once "models/front/API.manager.php";
require_once "models/Model.php";

class APIController
{
    private $apimanager;

    public function __construct()
    {
        $this->apimanager = new APIManager();
    }

    public function getAnimaux($idFamille, $idContinent)
    {
        $animaux = $this->apimanager->getDBAnimaux($idFamille, $idContinent);
        Model::sendJSON($this->formatDataLignesAnimaux($animaux));
    }

    public function getAnimal($idAnimal)
    {
        $lignesAnimal = $this->apimanager->getDBAnimal($idAnimal);
        Model::sendJSON($this->formatDataLignesAnimaux($lignesAnimal));
    }

    public function getContinents()
    {
        $contients = $this->apimanager->getDBContinents();
        Model::sendJSON($contients);
    }

    public function getFamilles()
    {
        $familles = $this->apimanager->getDBFamilles();
        Model::sendJSON($familles);
    }

    public function formatDataLignesAnimaux($lignes)
    {
        $tab = [];

        foreach ($lignes as $ligne) {
            /*Si l'animal est déjà présent dans le tableau, on ne le rajout pas de nouveau*/
            if (!array_key_exists($ligne['animal_id'], $tab)) {

                $tab[$ligne['animal_id']] = [
                    "idAnimal" => $ligne['animal_id'],
                    "nom" => $ligne['animal_nom'],
                    "description" => $ligne['animal_description'],
                    "image" => URL . "public/images/" . $ligne['animal_image'],
                    "famille" => [
                        "idFamille" => $ligne['famille_id'],
                        "libelleFamille" => $ligne['famille_libelle'],
                        "descriptionFamille" => $ligne['famille_description']
                    ]
                ];
            }

            /*On récupère les continents associès à l'animal*/
            $tab[$ligne['animal_id']]['continents'][] = [
                "idContinent" => $ligne['continent_id'],
                "libelleContinent" => $ligne['continent_libelle']
            ];
        }
//Pour tester le rendu
//echo "<pre>";
//print_r($tab);
//echo "</pre>";

        return $tab;
    }

    public function sendMessage()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
        header("Content-type: application/json; charset=utf-8");

        $obj = json_decode(file_get_contents('php://input'));

        $messageRetour = [
            'from' => $obj->email,
            'to' => "contact@meauxzoo.com"
        ];

        $to = "contact@meauxzoo.com";
        $subject = "Message du site MeauxZoo de " . $obj->nom;
        $message = $obj->contenu;
        $headers = "From : " . $obj->email;
        mail($to, $subject, $message, $headers);

        echo json_encode($messageRetour);
    }
}
