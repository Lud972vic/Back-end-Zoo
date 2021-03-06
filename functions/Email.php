<?php


class Email
{
    function envoisMail($to, $pseudo, $pwd)
    {
        $subject = "Votre compte utilisateur est disponible";
        $message = "
        <html>
        <body>
            <h3>Bienvenue $pseudo sur l'application MeauxZoo</h3>
            <p>Vous pouvez vous rendre sur le site, en cliquant sur le bouton <button class='btn-outline-success' href='http://meauxzoo.test'>MeauxZoo</button></p> 
            <p>Login : $pseudo</p>
            <p>Mot de passe : $pwd</p>
            <p>L'équipe MeauxZoo, vous souhaite une bonne utilisation de l'application.</p>
            <p>Cordialement,</p>
            <p>L'équipe MeauxZoo</p>
        </body>
        </html>
    ";

// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <contact@justeunregard.local>' . "\r\n";
        $headers .= 'Cc: contact@justeunregard.local' . "\r\n";

        mail($to, $subject, $message, $headers);
    }
}
