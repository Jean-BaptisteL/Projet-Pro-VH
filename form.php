<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css" />
        <title>Projet</title>
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
                            <a class="nav-intem nav-link m-0" href="#"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <h2 class="registration">Inscription :</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group d-flex justify-content-center form-row inputsRegistration">
                <div class="col-md-4">
                    <label for="pseudo">Donnez un pseudonyme :</label><input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Capitaine Gloomy" />
                    <p></p>
                </div>
                <div class="form-group col-md-4">
                    <label for="email">Donnez votre adresse mail :</label><input type="email" name="email" id="email" class="form-control" placeholder="gloomy@brokenmiror.fr" />
                    <p></p>
                    <label for="confirmEmail">Confirmez votre adresse mail :</label><input type="email" name="confirmEmail" id="confirmEmail" class="form-control"  placeholder="gloomy@brokenmiror.fr" />
                    <p></p>
                </div>
                <div class="form-group col-md-4">
                    <label for="password">Choisissez un mot de passe :</label><input type="password" name="password" id="password" class="form-control" />
                    <p></p>
                    <label for="confirmPassword">Confirmez votre mot de passe :</label><input type="password" name="confirmPassword" id="confirmPassword" class="form-control" />
                    <p></p>
                </div>
            </div>
            <input type="submit" class="btn btn-primary align-self-center" value="Enregistrer" />
        </form>
        <footer>
            <h2>Retrouvez nous :</h2>
            <div class="socialNetwork">
                <div id="facebook" class="text-center">
                    <a href="https://www.facebook.com" id="facebookIcon" title="La page Facebook"><i class="fab fa-facebook-f"></i></a>
                </div>
                <div id="instagram" class="text-center">
                    <a href="https://www.instagram.com" id="instagramIcon"><i class="fab fa-instagram"></i></a>
                </div>
                <div id="twitter" class="text-center">
                    <a href="https://www.twitter.com" id="twitterIcon"><i class="fab fa-twitter"></i></i></a>
                </div>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/1c6594a72f.js" crossorigin="anonymous"></script>
        <script src="assets/js/script.js"></script>
    </body>
</html>