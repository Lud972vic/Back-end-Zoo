<?php

require_once('models/Model.php');

class AnimauxManager extends Model
{
    public function getAnimaux()
    {
        $req = "SELECT * FROM animal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $animaux;
    }

    public function deleteAnimalContinent($idAnimal)
    {
        $req = "DELETE FROM animal_continent WHERE animal_id= :idAnimal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':idAnimal', $idAnimal, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function deleteAnimal($idAnimal)
    {
        $req = "DELETE FROM animal WHERE animal_id= :idAnimal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':idAnimal', $idAnimal, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    /*
        public function compterAnimaux($idFamille)
        {
            $req = "SELECT COUNT(*) As 'Nbre' FROM famille f
                        INNER JOIN animal a
                        on a.famille_id = f.famille_id
                        WHERE f.famille_id= :idFamille";
            $stmt = $this->getBdd()->prepare($req);
            $stmt->bindValue(':idFamille', $idFamille, PDO::PARAM_INT);
            $stmt->execute();
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            return $resultat['Nbre'];
        }

        public function updateFamille($idFamille, $famille_libelle, $famille_description)
        {
            $req = "UPDATE famille
                    SET
                        famille_libelle= :famille_libelle,
                        famille_description= :famille_description
                    WHERE famille_id= :idFamille";
            $stmt = $this->getBdd()->prepare($req);
            $stmt->bindValue(':idFamille', $idFamille, PDO::PARAM_INT);
            $stmt->bindValue(':famille_libelle', $famille_libelle, PDO::PARAM_STR);
            $stmt->bindValue(':famille_description', $famille_description, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
        }
 }*/
    public function createAnimal($nom, $description, $image, $famille)
    {
        $req = "INSERT INTO animal (animal_nom, animal_description, animal_image, famille_id) VALUES (:nom, :description, :image, :famille)";
        $stmt = $this->getBdd()->prepare($req);

        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        $stmt->bindValue(':famille', $famille, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();

        /*On retourne l'id de l'ajout*/
        return $this->getBdd()->lastInsertId();
    }

    public function getAnimal($idAnimal)
    {
        $req = "SELECT * FROM animal a 
        INNER JOIN  famille f ON a.famille_id = f.famille_id
        INNER JOIN  animal_continent ac ON ac.animal_id = a.animal_id
        WHERE a.animal_id = :idAnimal";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':idAnimal', $idAnimal, PDO::PARAM_INT);
        $stmt->execute();
        $lignesAnimal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $lignesAnimal;
    }
}
