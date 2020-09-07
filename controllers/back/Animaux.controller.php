<?php
require_once('functions/Securite.php');
require_once('models/back/Animaux.manager.php');
require_once('models/back/Familles.manager.php');
require_once('models/back/Continents.manager.php');

class AnimauxController
{
    private $animauxManager;

    public function __construct()
    {
        $this->animauxManager = new AnimauxManager();
    }

    public function visualisation()
    {
        if (Securite::verifAccessSession()) {
            /*Récupération des animaux du Manager partie Model du MVC*/
            $animaux = $this->animauxManager->getAnimaux();
            require_once('views/animauxVisualisation.php');
        } else {
            throw  new Exception("Vous n'avez pas le droit d'être là !");
        }
    }

    public function validationSuppression()
    {
        if (Securite::verifAccessSession()) {
            $idAnimal = (int)Securite::secureHTML($_POST['animal_id']);

            $this->animauxManager->deleteAnimalContinent($idAnimal);
            $this->animauxManager->deleteAnimal($idAnimal);

            $_SESSION['alert'] = [
                "message" => "L'animal est bien supprimé.",
                "type" => "alert-success"
            ];

            header('Location: ' . URL . 'back/animaux/visualisation');
        } else {
            throw  new Exception("Vous n'avez pas le droit d'être là !");
        }
    }

    public function creation()
    {
        if (Securite::verifAccessSession()) {
            $familleManager = new FamillesManager();
            $familles = $familleManager->getFamilles();

            $continentsManager = new ContinentsManager();
            $continents = $continentsManager->getContinents();

            require_once('views/animalCreation.view.php');
        } else {
            throw  new Exception("Vous n'avez pas le droit d'être là !");
        }
    }

    public function creationValidation()
    {
        if (Securite::verifAccessSession()) {
            $nom = Securite::secureHTML($_POST['animal_nom']);
            $description = Securite::secureHTML($_POST['animal_description']);
            $image = "";
            $famille = (int)Securite::secureHTML($_POST['famille_id']);

            /*On crée l'animal et on récupère l'id crée aussi dans la variable $idAnimal*/
            $idAnimal = $this->animauxManager->createAnimal($nom, $description, $image, $famille);

            $continentsManager = new ContinentsManager();
            /*On vérifie que la checkBox est cochée*/
            if (!empty($_POST['continent-1'])) {
                $continentsManager->addContientAnimal($idAnimal, 1);
            }

            if (!empty($_POST['continent-2'])) {
                $continentsManager->addContientAnimal($idAnimal, 2);
            }

            if (!empty($_POST['continent-3'])) {
                $continentsManager->addContientAnimal($idAnimal, 3);
            }

            if (!empty($_POST['continent-4'])) {
                $continentsManager->addContientAnimal($idAnimal, 4);
            }

            if (!empty($_POST['continent-5'])) {
                $continentsManager->addContientAnimal($idAnimal, 5);
            }

            $_SESSION['alert'] = [
                "message" => "L'animal n° " . $idAnimal . " est bien crée.",
                "type" => "alert-success"
            ];

            header('Location: ' . URL . 'back/animaux/visualisation');
        } else {
            throw  new Exception("Vous n'avez pas le droit d'être là !");
        }
    }

    public function modification($idAnimal)
    {
        if (Securite::verifAccessSession()) {
            $familleManager = new FamillesManager();
            $familles = $familleManager->getFamilles();

            $continentsManager = new ContinentsManager();
            $continents = $continentsManager->getContinents();

            $lignesAnimal = $this->animauxManager->getAnimal((int)Securite::secureHTML($idAnimal));

            /*La fontion slice découpe le tableau*/
            /*On récupère la 1er ligne, et que les 5 premières lignes */
            $animal = array_slice($lignesAnimal[0], 0, 5);

            $tabContinents = [];
            foreach ($lignesAnimal as $lignesAnimal) {
                $tabContinents[] = $lignesAnimal['continent_id'];
            }

            require_once('views/animalModification.view.php');
        } else {
            throw  new Exception("Vous n'avez pas le droit d'être là !");
        }
    }
}
