<?php


class Securite
{
    public static function secureHTML($string)
    {
        return htmlentities($string);
    }

    public static function verifAccessSession()
    {
        /*On vérifie qu'il éxiste bien une variable de sesssion avec la bonne information*/
        return (!empty($_SESSION['accessAdmin']) && $_SESSION['accessAdmin'] === "@dminMZ");
    }
}
