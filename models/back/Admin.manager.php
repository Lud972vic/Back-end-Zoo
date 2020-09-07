<?php
require_once('models/Model.php');

class AdminManager extends Model
{
    private function getPasswordUser($login)
    {
        $req = 'SELECT * FROM administrateur WHERE login = :login';
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $admin['password'];
    }

    public function isConnexionValid($login, $password)
    {
        /*On récupère le mot de passe de l'utilisateur en bdd*/
        $passwordBD = $this->getPasswordUser($login);
        /*On compare le mot de passe en bdd et celui-ci saisie par l"utilisteur*/
        return password_verify($password, $passwordBD);
    }

    public function addNewAdmin($login, $email, $pwd, $password)
    {
        /*Vérification utilisateur existant*/
        $sql = "SELECT COUNT(*) FROM administrateur WHERE login= :login AND email= :email";
        $query = $this->getBdd()->prepare($sql);
        $query->bindValue(':login', $login, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();

        /*Vérification que l'email n existe pas*/
        while ($data = $query->fetch()) {
            $result[] = $data;
        }

        if (!$result[0][0]) {
            //Envois email au nouveau utilisateur
            $newEmail = new Email();
            $newEmail->envoisMail($email, $login, $password);

            /*Ma requête insert into*/
            $sql = "INSERT INTO administrateur (Email, login, password) VALUES ('$email', '$login', '$pwd')";
            $query = $this->getBdd()->prepare($sql);
            $query->execute();

            $_SESSION['alert'] = [
                "message" => "Le nouvel administrateur est inscrit avec succès !",
                "type" => "alert-success"
            ];
        } else {
            $_SESSION['alert'] = [
                "message" => "L'email existe déjà, veuillez vous rapprocher de votre utilisateur !",
                "type" => "alert-danger"
            ];
        }
        header('Location: ' . URL . 'back/creationdescomptes');
    }
}
