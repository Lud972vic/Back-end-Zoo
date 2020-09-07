<?php
$title = 'Page de création d\'un animal';
$titre = 'Page de création d\'un animal';
ob_start();
?>
<form method="post" action="<?= URL ?>back/animaux/creationValidation" enctype="multipart/form-data">
    <div class="form-group">
        <label for="animal_nom">Nom de l'animal</label>
        <input type="text" class="form-control" id="animal_nom" name="animal_nom">
    </div>
    <div class="form-group">
        <label for="animal_description">Description de l'animal</label>
        <textarea class="form-control" id="animal_description" name="animal_description" rows="3"></textarea>
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="image">Image de l'animal</label>
            <input type="file" class="form-control-file" id="image">
        </div>
    </div>
    <div class="form-group">
        <label for="image">Famille de l'animal</label>
        <select class="form-control" name="famille_id">
            <option>Choississez une famille</option>
            <?php foreach ($familles as $famille) : ?>
                <option value="<?= $famille['famille_id'] ?>"><?= $famille['famille_libelle'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <label for="image">Les continents</label>
    <div class="row no-gutters">
        <?php foreach ($continents as $continent) : ?>
            <div class="form-group form-check col-2 offset-1">
                <input type="checkbox" class="form-check-input" name="continent-<?= $continent['continent_id'] ?>">
                <label class="form-check-label" for="exampleCheck1"><?= $continent['continent_libelle'] ?></label>
            </div>
        <?php endforeach; ?>
    </div>

    <button type="submit" class="btn btn-outline-dark">Créer</button>
</form>
<?php
$content = ob_get_clean();
require('views/commons/gabarit.php');
?>
