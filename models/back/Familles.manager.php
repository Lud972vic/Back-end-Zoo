<?php

require_once('models/Model.php');

class FamillesManager extends Model
{
    public function getFamilles()
    {
        $req = "SELECT * FROM famille";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $familles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $familles;
    }

    public function deleteFamille($idFamille)
    {
        $req = "DELETE FROM famille WHERE famille_id= :idFamille";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':idFamille', $idFamille, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

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

    public function createFamille($famille_libelle, $famille_description)
    {
        $req = "INSERT INTO famille (famille_libelle,famille_description) VALUES (:famille_libelle, :famille_description)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':famille_libelle', $famille_libelle, PDO::PARAM_STR);
        $stmt->bindValue(':famille_description', $famille_description, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

        return $this->getBdd()->lastInsertId();
    }
}
