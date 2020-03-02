<?php
$pageTitle = 'Inscription';
include_once 'includes/header.php';
?>
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
<?php
include_once 'includes/footer.php';
    