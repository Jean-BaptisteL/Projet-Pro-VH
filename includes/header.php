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
                            <a class="nav-intem nav-link m-0" href="#">Tutos</a>
                            <a class="nav-intem nav-link m-0" href="indexTest.php">Testes</a>
                            <a class="nav-intem nav-link m-0" href="#">Vos réalisations</a>
                            <a class="nav-intem nav-link m-0" href="#">Forum</a>
                            <a class="nav-intem nav-link m-0" href="#">Vos spots</a>
                        </div>
                        <div class="navbar-nav ml-auto">
                            <form class="form-inline">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Rechercher" name="search">
                                    <div class="input-group-btn">
                                        <button id="searchBtn" class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                            </form>
                            <a class="nav-intem nav-link m-0" href="form.php"><i class="fas fa-user-plus"></i> Inscription</a>
                            <a class="nav-intem nav-link m-0" href="#" data-toggle="modal" data-target="#loginModal"><i class="fas fa-sign-in-alt"></i> Connexion</a>
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
                                <label for="userName">Identifiant :</label><input type="text" class="col-10" name="userName" id="userName" placeholder="Capitaine Gloomy" />
                                <label for="userPassword">Mot de passe :</label><input type="password" class="col-10" name="userPassword" id="userPassword" />
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