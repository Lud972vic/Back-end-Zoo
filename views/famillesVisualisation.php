<?php
$title = 'Les familles';
$titre = 'Les familles';
ob_start();
?>
<table class="table table-striped table-light">
    <thead>
    <tr class="text-center">
        <th scope="col">#</th>
        <th scope="col">Famille</th>
        <th scope="col">Description</th>
        <th scope="col" colspan="2">Les actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($familles as $famille) : ?>
        <!--On compare la valeur posté et la valeur parcourue de la bdd-->
        <?php if (empty($_POST['famille_id']) || $_POST['famille_id'] !== $famille['famille_id']) : ?>
            <tr>
                <td><?= $famille['famille_id'] ?></td>
                <td><?= $famille['famille_libelle'] ?></td>
                <td><?= $famille['famille_description'] ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <!--On appel la même page, afin de stocker la variable $_POST['famille_id']-->
                        <form method="post" action="">
                            <input type="hidden" name="famille_id" value="<?= $famille['famille_id'] ?>"/>
                            <button type="submit" class="btn btn-sm btn-outline-warning">Modifier</button>
                        </form>

                        <form method="post" action="<?= URL ?>back/familles/validationSuppression"
                              onSubmit="return confirm('Voulez-vous vraiement supprimer cette famille ?')">
                            <input type="hidden" name="famille_id" value="<?= $famille['famille_id'] ?>"/>
                            <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                        <a class="btn btn-sm btn-outline-primary" href="<?= URL ?>/back/familles/creation">Ajouter</a>
                    </div>
                </td>
            </tr>
        <?php else: ?>
            <form method="post" action="<?= URL ?>back/familles/validationModification">
                <!--On affiche la ligne qui doit être modifiée, avec ses inputs-->
                <tr>
                    <td><?= $famille['famille_id'] ?></td>
                    <td><textarea name="famille_libelle" class="form-control" rows="3"><?= $famille['famille_libelle'] ?></textarea></td>
                    <td><textarea name="famille_description" class="form-control" rows="3"><?= $famille['famille_description'] ?></textarea></td>
                    <td>
                        <!--On appel la même page, afin de stocker la variable $_POST['famille_id']-->
                        <form method="post" action="">
                            <input type="hidden" name="famille_id" value="<?= $famille['famille_id'] ?>"/>
                            <button type="submit" class="btn btn-sm btn-outline-success">Validation</button>
                        </form>
                    </td>
                </tr>
            </form>
        <?php endif; ?>
    <?php endforeach; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
require('views/commons/gabarit.php');
?>
