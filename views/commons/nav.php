<link href="<?= URL . 'public/css/bootstrap.min.css' ?>" rel="stylesheet" type="text/css"/>
<script src="<?= URL . 'public/js/jquery.min.js' ?>"></script>
<script src="<?= URL . 'public/js/script.js' ?>"></script>
<script src="<?= URL . 'public/js/bootstrap.bundle.min.js' ?>"></script>
<script src="<?= URL . 'public/js/fontawesome.all.min.js' ?>"></script>

<style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #555 !important;
        color: white;
        text-align: center;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <img src="<?= URL . 'public/img/logo.png' ?>" class="rounded float-right" alt="Lud972vic"
         style="width: 100px">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <h1 class="navbar-brand text-danger">MeauxZoo@dmin</h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php if (!Securite::verifAccessSession()) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>back/login">Se connecter</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>back/admin">Accueil</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Compte
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= URL ?>back/creationdescomptes">Créer d'autres comptes
                                Admin</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Familles
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= URL ?>back/familles/visualisation">Visualisation</a>
                            <a class="dropdown-item" href="<?= URL ?>back/familles/creation">Création</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Animaux
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= URL ?>back/animaux/visualisation">Visualisation</a>
                            <a class="dropdown-item" href="<?= URL ?>back/animaux/creation">Création</a>
                        </div>
                    </li>

                    <a class="nav-link" href="<?= URL ?>back/deconnexion">Se déconnecter</a>
                <?php endif ?>
            </ul>
        </div>
    </nav>
</nav>
