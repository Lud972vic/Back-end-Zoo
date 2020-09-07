<?php
$title = 'Les animaux';
$titre = 'Les animaux';
ob_start();
?>
<table class="table table-striped table-light">
    <thead>
    <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Animal</th>
        <th scope="col">Description</th>
        <th scope="col" colspan="2">Les actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($animaux as $animal) : ?>
        <tr>
            <td><?= $animal['animal_id'] ?></td>
            <td><?= $animal['animal_nom'] ?></td>
            <td><?= $animal['animal_description'] ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a class="btn btn-sm btn-outline-warning"
                       href="<?= URL ?>back/animaux/modification/<?= $animal['animal_id'] ?>">Modifier </a>

                    <form method="post" action="<?= URL ?>back/animaux/validationSuppression"
                          onSubmit="return confirm('Voulez-vous vraiement supprimer cet animal ?')">
                        <input type="hidden" name="animal_id" value="<?= $animal['animal_id'] ?>"/>
                        <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                    </form>
                    <a class="btn btn-sm btn-outline-primary" href="<?= URL ?>/back/animaux/creation">Ajouter</a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
require('views/commons/gabarit.php');
?>
