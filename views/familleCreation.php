<?php
$title = 'Page de création d\'une famille';
$titre = 'Page de création d\'une famille';
ob_start();
?>
<form method="post" action="<?= URL ?>back/familles/creationValidation">
    <div class="form-group">
        <label for="famille_libelle">Libellé</label>
        <input type="text" class="form-control" id="famille_libelle" name="famille_libelle">
    </div>
    <div class="form-group">
        <label for="famille_description">Description</label>
        <textarea class="form-control" id="famille_description" name="famille_description" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
<?php
$content = ob_get_clean();
require('views/commons/gabarit.php');
?>



