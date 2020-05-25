<?php
session_start();
$pageTitle = 'Inscription';
include_once 'models/users.php';
include_once 'controllers/headerCtrl.php';
include_once 'controllers/formCtrl.php';
include_once 'includes/header.php';
?>
<div class="bodyPage">
    <h2 class="registration">Inscription :</h2>
    <form action="#" method="POST">
        <div class="form-group d-flex justify-content-center form-row inputsRegistration">
            <div class="col-md-4">
                <label for="pseudo">Donnez un pseudonyme :</label><input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Capitaine Gloomy" value="<?= isset($_POST['pseudo']) ? $_POST['pseudo'] : '' ?>" required />
                <!-- Si le message d'erreur existe il est affiché sinon rien n'est affiché. -->
                <p class="text-danger"><?= isset($errorMessages['pseudo']) ? $errorMessages['pseudo'] : '' ?></p>
            </div>
            <div class="form-group col-md-4">
                <label for="email">Donnez votre adresse mail :</label><input type="email" name="email" id="email" class="form-control" placeholder="gloomy@brokenmiror.fr" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required />
                <!-- Si le message d'erreur existe il est affiché sinon rien n'est affiché. -->
                <p class="text-danger"><?= isset($errorMessages['email']) ? $errorMessages['email'] : '' ?></p>
                <label for="confirmEmail">Confirmez votre adresse mail :</label><input type="email" name="confirmEmail" id="confirmEmail" class="form-control"  placeholder="gloomy@brokenmiror.fr" value="<?= isset($_POST['confirmEmail']) ? $_POST['confirmEmail'] : '' ?>" required />
                <!-- Si le message d'erreur existe il est affiché sinon rien n'est affiché. -->
                <p class="text-danger"><?= isset($errorMessages['confirmEmail']) ? $errorMessages['confirmEmail'] : '' ?></p>
            </div>
            <div class="form-group col-md-4">
                <label for="password">Choisissez un mot de passe :</label><input type="password" name="password" id="password" class="form-control" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" required />
                <!-- Si le message d'erreur existe il est affiché sinon rien n'est affiché. -->
                <p class="text-danger"><?= isset($errorMessages['password']) ? $errorMessages['password'] : '' ?></p>
                <label for="confirmPassword">Confirmez votre mot de passe :</label><input type="password" name="confirmPassword" id="confirmPassword" class="form-control" value="<?= isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '' ?>" required />
                <!-- Si le message d'erreur existe il est affiché sinon rien n'est affiché. -->
                <p class="text-danger"><?= isset($errorMessages['confirmPassword']) ? $errorMessages['confirmPassword'] : '' ?></p>
            </div>
        </div>
        <input type="submit" id="addNewUser" name="addNewUser" class="btn btn-primary align-self-center" value="Enregistrer" />
        <p class="text-success"><?= isset($errorMessages['success']) ? $errorMessages['success'] : '' ?></p>
    </form>
</div>
<?php
include_once 'includes/footer.php';
