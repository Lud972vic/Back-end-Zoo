<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
</head>
<body>

<?php require_once('views/commons/nav.php') ?>
<div class="container">
    <h1 class="rounded border border-danger my-5 p-2 text-center text-white bg-dark"><?= $titre ?></h1>
    <?php if (!empty($_SESSION['alert'])): ?>
        <div class="alert text-center <?= $_SESSION['alert']['type'] ?>" role="alert">
            <?= $_SESSION['alert']['message'] ?>
        </div>
        <?php
        /*On supprime le message si on actualise la page ou si on change de page*/
        unset($_SESSION['alert']);
    endif;
    ?>
    <?= $content ?>
</div>

<?php require_once('views/commons/footer.php') ?>

</body>
</html>
