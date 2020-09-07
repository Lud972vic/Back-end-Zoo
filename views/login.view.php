<?php
$title = 'Connectez-vous';
$titre = '<i class="fas fa-sign-in-alt"></i> Connectez-vous';
ob_start();

/*On sauvegarde les valeurs inputs, pour éviter de les ressaisir à nouveau*/
if (isset($_POST['login'])) {
    $leCompte = $_POST['login'];
} else {
    $leCompte = null;
}
?>

<form method="post" action="<?= URL ?>back/connexion">
    <div class="form-group">
        <label for="login"><i class="far fa-user"></i> Compte</label>
        <input type="text" class="form-control" id="login" name="login" value="<?php echo $leCompte; ?>" required>
    </div>
    <div class="form-group">
        <label for="password"><i class="fas fa-lock"></i> Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" name="SubmitButton" class="btn btn-primary"><i class="fas fa-user-check"></i> Valider</button>
</form>

<?php
$content = ob_get_clean();
require('views/commons/gabarit.php');
?>
