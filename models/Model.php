<?php

abstract class Model
{
    private static $pdo;

    private static function setBdd()
    {
        //https://waytolearnx.com/2018/12/difference-entre-self-et-this-en-php.html
        self::$pdo = new PDO("mysql:host=localhost;dbname=bdd_animaux_php;charset=utf8", "user_jur", "Prootq8R8cd3CCu3");
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBdd()
    {
        //On vérifie qu'il n y a aucune connection à la Bdd, si null on lance la function setBdd
        if (self::$pdo === null) {
            self::setBdd();
        }

        //On retourne la connexion à la Bdd
        return self::$pdo;
    }

    public static function sendJSON($info)
    {
        //N'importe qui peux interroger la Bdd avec "*", sinon mettre l'adresse de son site
        //Eviter les erreurs CROS https://developer.mozilla.org/fr/docs/Web/HTTP/Headers/Access-Control-Allow-Origin
        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($info);
    }
}

