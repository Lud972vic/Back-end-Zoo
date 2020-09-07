<?php

require_once('functions/Securite.php');
require_once('functions/Email.php');
require_once('models/back/Admin.manager.php');

class AdminController
{
    private $adminManager;

    public function __construct()
    {
        $this->adminManager = new  AdminManager();
    }

    public function getPageLogin()
    {
        require_once('views/login.view.php');
    }

    public function getPageCreationCompte()
    {
        if (Securite::verifAccessSession()) {
            require_once('views/sign_in.php');
        } else {
            header('Location: ' . URL . 'back/login');
        }
    }

    public function ajouterAdministrateur()
    {
        if (isset($_POST['SubmitButton'])) {
            /*Total élément sur le formulaire*/
            $checkInputTotal = 4;
            /*Total élément renseigné sur le formulaire*/
            $checkInput = 0;

            /*On vérifie que tous les champs du formulaire sont renseignés, si $checkInputTotal==$checkInput Ok, sinon Ko*/
            foreach ($_POST as $cle => $valeur) {
                if ($valeur != null) {
                    $checkInput += 1;
                }
                $checkInputOkOrKo = $checkInput === $checkInputTotal;
            }

            /*Si tous les inputs sont renseignés*/
            if ($checkInputOkOrKo) {
                /*Les mots de passes sont identiques*/
                if (Securite::secureHTML($_POST['inputPassword1']) === Securite::secureHTML($_POST['inputPassword2'])) {
                    /*Valeurs du formulaire*/
                    $email = Securite::secureHTML($_POST['email']);
                    $login = Securite::secureHTML($_POST['login']);
                    $password = Securite::secureHTML($_POST['inputPassword1']);

                    $pwd = password_hash($password, PASSWORD_DEFAULT);

                    $this->adminManager->addNewAdmin($login, $email, $pwd, $password);
                } else {
                    $_SESSION['alert'] = [
                        "message" => "Les mots de passes sont différents !",
                        "type" => "alert-warning"
                    ];
                }
            } else {
                $_SESSION['alert'] = [
                    "message" => "Veuillez remplir tous les champs du formulaire correctement !",
                    "type" => "alert-warning"
                ];
            }
        }
        header('Location: ' . URL . 'back/creationdescomptes');
    }

    public function getAccueilAdmin()
    {
        if (Securite::verifAccessSession()) {
            require_once('views/accueilAdmin.view.php');
        } else {
            header('Location: ' . URL . 'back/login');
        }
    }

    public function connexion()
    {
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $login = Securite::secureHTML($_POST['login']);
            $password = Securite::secureHTML($_POST['password']);

            if ($this->adminManager->isConnexionValid($login, $password)) {
                $_SESSION['accessAdmin'] = "@dminMZ";
                header('Location: ' . URL . 'back/admin');
            } else {
                $_SESSION['alert'] = [
                    "message" => "Veuillez vérifier votre compte et mot de passe s'il vous plait.",
                    "type" => "alert-warning"
                ];
                header('Location: ' . URL . 'back/login');
            }
        }
    }

    public function deconnexion()
    {
        // Initialize the session.
        // If you are using session_name("something"), don't forget it now!
        session_start();

        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finally, destroy the session.
        session_destroy();

        header('Location: ' . URL . 'back/login');
    }
}
