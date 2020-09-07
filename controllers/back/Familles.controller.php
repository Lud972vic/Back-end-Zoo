<?php
require_once('functions/Securite.php');
require_once('models/back/Familles.manager.php');

class FamillesController
{
    private $famillesManager;

    public function __construct()
    {
        $this->famillesManager = new FamillesManager();
    }

    public function visualisation()
    {
        if (Securite::verifAccessSession()) {
            /*Récupération des familles du Manager partie Model du MVC*/
            $familles = $this->famillesManager->getFamilles();

            require_once('views/famillesVisualisation.php');
        } else {
            throw  new Exception("Vous n'avez pas le droit d'être là !");
        }
    }

    public function suppression()
    {
        if (Securite::verifAccessSession()) {
            $idFamille = (int)Securite::secureHTML($_POST['famille_id']);

            /*S'il y'a au moins un animal, on affiche le message d'alerte*/
            if ($this->famillesManager->compterAnimaux($idFamille) > 0) {
                $_SESSION['alert'] = [
                    "message" => "La famille n'est pas supprimée, car des animaux sont rattachés à celle-ci.",
                    "type" => "alert-danger"
                ];
            } else {
                $this->famillesManager->deleteFamille($idFamille);
                $_SESSION['alert'] = [
                    "message" => "La famille est bien supprimée.",
                    "type" => "alert-success"
                ];
            }

            header('Location: ' . URL . 'back/familles/visualisation');
        } else {
            throw  new Exception("Vous n'avez pas le droit d'être là !");
        }
    }

    public function modification()
    {
        if (Securite::verifAccessSession()) {
            $idFamille = (int)Securite::secureHTML($_POST['famille_id']);
            $famille_libelle = Securite::secureHTML($_POST['famille_libelle']);
            $famille_description = Securite::secureHTML($_POST['famille_description']);

            $this->famillesManager->updateFamille($idFamille, $famille_libelle, $famille_description);

            $_SESSION['alert'] = [
                "message" => "La famille a bien été modifiée.",
                "type" => "alert-success"
            ];

            header('Location: ' . URL . 'back/familles/visualisation');
        } else {
            throw  new Exception("Vous n'avez pas le droit d'être là !");
        }
    }

    public function creationVue()
    {
        if (Securite::verifAccessSession()) {
            require_once('views/familleCreation.php');
        } else {
            throw  new Exception("Vous n'avez pas le droit d'être là !");
        }
    }

    public function creationValidation()
    {
        if (Securite::verifAccessSession()) {
            $famille_libelle = Securite::secureHTML($_POST['famille_libelle']);
            $famille_description = Securite::secureHTML($_POST['famille_description']);

            /*On crée l'enregistrement et on récupère l'id de celui-ci en même temps*/
            $idFamille = $this->famillesManager->createFamille($famille_libelle, $famille_description);

            $_SESSION['alert'] = [
                "message" => "La famille a bien été crée avec l'identifiant n° " . $idFamille,
                "type" => "alert-success"
            ];

            header('Location: ' . URL . 'back/familles/visualisation');
        } else {
            throw  new Exception("Vous n'avez pas le droit d'être là !");
        }
    }
}
