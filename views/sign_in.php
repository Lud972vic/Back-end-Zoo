<?php
require_once('functions/Email.php');

$title = 'Création des comptes administrateurs';
$titre = '<i class="fas fa-user-shield"></i> Création des comptes administrateurs';
ob_start();

/*On sauvegarde les valeurs inputs, pour éviter de les ressaisir à nouveau*/
if (isset($_POST['email'])) {
    $leEmail = $_POST['email'];
} else {
    $leEmail = null;
}

if (isset($_POST['login'])) {
    $leCompte = $_POST['login'];
} else {
    $leCompte = null;
}
?>

<form method="post" action="<?= URL ?>back/ajouterAdministrateur">
    <?php
    if (isset($_SESSION['alert'])) {
        echo '
            <div class="alert alert-dark fade show text-center" role="alert">
                <strong>' . $_SESSION["alert"] . '</strong>
            </div>
        ';
        unset($_SESSION['alert']);
    }
    ?>

    <div class="form-group mt-5">
        <label for="email"><i class="fas fa-at"></i> Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
               placeholder="Entrer son email"
               value="<?php echo $leEmail; ?>" required>
        <small id=" emailHelp" class="form-text text-muted">Son adresse email</small>
    </div>
    <div class="form-group">
        <label for="login"><i class="fas fa-signature"></i> Compte</label>
        <input type="text" class="form-control" id="login" name="login" aria-describedby="loginHelp"
               placeholder="Entrer son compte"
               value="<?php echo $leCompte; ?>" required>
        <small id="loginHelp" class="form-text text-muted">Son compte</small>
    </div>
    <div class="form-group">
        <label for="inputPassword1"><i class="fas fa-lock"></i> Mot de passe</label>
        <input type="password" class="form-control" id="inputPassword1" name="inputPassword1"
               aria-describedby="passwordHelp"
               placeholder="Entrer son mot de passe"
               value="" required>
        <small id="passwordHelp" class="form-text text-muted">Saisir son mot de passe</small>
    </div>
    <div class="form-group">
        <label for="inputPassword2"><i class="fas fa-lock"></i> Vérification mot de passe</label>
        <input type="password" class="form-control" id="inputPassword2" name="inputPassword2"
               aria-describedby="password2Help"
               placeholder="Entrer son mot de passe"
               value="" required>
        <small id="password2Help" class="form-text text-muted">Saisir son mot de passe</small>
    </div>

    <button type="submit" name="SubmitButton" class="btn btn-outline-primary mt-2"><i class="fas fa-user-check"></i>
        Valider
    </button>
    <a href="<?= URL ?>back/admin" class="btn btn-outline-primary mt-2"><i class="fas fa-times"></i> Annuler</a>
</form>

<?php
$content = ob_get_clean();
require('views/commons/gabarit.php');
?>
