
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css" />
        <title><?= $pageTitle ?></title>
    </head>
    <body class="container-fluid">
        <header>
            <div class="row" id="title"><h1 class="text-center col-12">Projet Drone</h1></div>
            <div class="row" id="navbar">
                <nav class="col-12 navbar navbar-expand-lg navbar-light bg-light sticky-top">
                    <a href="index.php" class="navbar-brand align-center mr-4 m-0">Accueil</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigationBar" aria-controls="navigationBar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigationBar">
                        <div class="navbar-nav">
                            <a class="nav-intem nav-link m-0" href="listArticles.php?type=tutos&page=1">Tutos</a>
                            <a class="nav-intem nav-link m-0" href="listArticles.php?type=tests&page=1">Tests</a>
                            <a class="nav-intem nav-link m-0" href="listArticles.php?type=real&page=1">Vos réalisations</a>
                            <a class="nav-intem nav-link m-0" href="#">Forum</a>
                            <a class="nav-intem nav-link m-0" href="#">Vos spots</a>
                            <?php if (isset($_SESSION['user'])) { ?>
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle m-0" href="#" id="dropdownAddArticle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rédiger un nouvel article</a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownAddArticle">
                                        <a class="dropdown-item" href="newArticle.php?type=tuto">Un tutoriel</a>
                                        <a class="dropdown-item" href="newArticle.php?type=test">Un test</a>
                                        <a class="dropdown-item" href="newArticle.php?type=real">Une réalisation</a>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="navbar-nav ml-auto">
                            <div class="input-group">
                                <form class="form-inline" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <input type="text" class="form-control" placeholder="Rechercher" name="search">
                                    <div class="input-group-btn">
                                        <button id="searchBtn" class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                                <a class="nav-intem nav-link m-0" href="<?= isset($_SESSION['user']) ? 'userProfil.php?display=infos' : 'form.php' ?>"><i class="<?= isset($_SESSION['user']) ? 'fas fa-user' : 'fas fa-user-plus' ?>"></i><?= isset($_SESSION['user']) ? ' Mon profil' : ' Inscription' ?></a>
                                <a class="nav-intem nav-link m-0" href="<?= isset($_SESSION['user']) ? '?signOut=true' : '#' ?>" <?= isset($_SESSION['user']) ? '' : 'data-toggle="modal" data-target="#loginModal"' ?>><i class="<?= isset($_SESSION['user']) ? 'fas fa-sign-out-alt' : ' fas fa-sign-in-alt' ?>"></i><?= isset($_SESSION['user']) ? ' Déconnexion' : ' Connexion' ?></a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="modal" id="loginModal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">Connexion</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                        </div>
                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="modal-body row">
                                <p><?= isset($errorMessagesForLogin['errorLogin']) ? $errorMessagesForLogin['errorLogin'] : '' ?></p>
                                <div>
                                    <label for="userName">Identifiant ou adresse mail :</label><input type="text" class="col-10" name="userNameOrEmail" id="userNameOrEmail" />
                                    <p><?= isset($errorMessagesForLogin['userNameOrEmail']) ? $errorMessagesForLogin['userNameOrEmail'] : '' ?></p>
                                </div>
                                <div>
                                    <label for="userPassword">Mot de passe :</label><input type="password" class="col-10" name="userPassword" id="userPassword" />
                                    <p><?= isset($errorMessagesForLogin['userPassword']) ? $errorMessagesForLogin['userPassword'] : '' ?></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <input type="submit" class="btn btn-primary" id="userLogin" name="userLogin" value="Se connecter" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>