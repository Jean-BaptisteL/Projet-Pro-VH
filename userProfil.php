<?php
session_start();
$pageTitle = 'Profil de ' . $_SESSION['user']['userName'];
include_once 'includes/header.php';
include_once 'controllers/userProfilCtrl.php';
?>
<h2><?= $_SESSION['user']['userName'] ?></h2>
<div class="row text-center d-fex justify-content-center bg-light">
    <a href="?display=infos" class="col-md-2 col-sm-12">Mes Informations</a>
    <a href="?display=tests" class="col-md-2 col-sm-12">Mes Tests</a>
    <a href="?display=tutos" class="col-md-2 col-sm-12">Mes Tutos</a>
    <a href="?display=produc" class="col-md-2 col-sm-12">Mes Productions</a>
    <a href="?display=spot" class="col-md-2 col-sm-12">Mes Spots</a>
</div>
<?php
if ($_GET['display'] == 'infos') {
    ?>
    <h3>Mes informations :</h3>
    <form>
        <div class="form-group">
            <label for="userName">Nom :</label>
            <div class="row">
                <input type="text" class="form-control col-md-3 col-sm-12 ml-3" id="userName" name="userName" value="<?= $_SESSION['user']['userName'] ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="email">Nom :</label>
            <div class="row">
                <input type="text" class="form-control col-md-3 col-sm-12 ml-3" id="email" name="email" value="<?= $_SESSION['user']['email'] ?>" />
            </div>
        </div>
        <p>Modifier mon mot de passe :</p>
        <div class="form-group">
            <label for="password">Ancien mot de passe :</label>
            <div class="row">
                <input type="password" class="form-control col-md-3 col-sm-12 ml-3" id="password" name="password" />
            </div>
        </div>
        <div class="form-group">
            <label for="newPassword">Nouveau mot de passe :</label>
            <div class="row">
                <input type="newPassword" class="form-control col-md-3 col-sm-12 ml-3" id="newPassword" name="newPassword" />
            </div>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirmer le nouveau mot de passe :</label>
            <div class="row">
                <input type="confirmPassword" class="form-control col-md-3 col-sm-12 ml-3" id="confirmPassword" name="confirmPassword" />
            </div>
        </div>
        <input type="submit" id="modifyUserInfos" name="modifyUserInfos" value="Modifier mes informations" />
    </form>
    <?php
} else if ($_GET['display'] == 'tests') {
    ?>
    <?php
} else if ($_GET['display'] == 'tutos') {
    ?>
    <?php
} else if ($_GET['display'] == 'produc') {
    ?>
    <?php
} else if ($_GET['display'] == 'spot') {
    ?>
    <?php
}
include_once 'includes/footer.php';
