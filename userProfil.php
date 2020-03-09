<?php
session_start();
session.gc_maxlifetime(7200);
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
if ($_GET['display'] == 'infos' || empty($_GET['display']) || !isset($_GET['display'])) {
    ?>
    <div class="row">
        <h3 class="col-12 text-center" id="infosTitle">Mes informations :</h3>
        <p>Vous pouvez les modifier en modifiant le contenu des champs.</p>
        <form class="col-12" action="?display=infos" method="POST">
            <div class="form-group">
                <label for="userName">Nom :</label>
                <div class="row">
                    <input type="text" class="form-control col-md-3 col-sm-12 ml-3" id="userName" name="userName" value="<?= $_SESSION['user']['userName'] ?>" />
                </div>
                <p><?= isset($errorMessagesInfos['userName']) ? $errorMessagesInfos['userName'] : '' ?></p>
            </div>
            <div class="form-group">
                <label for="email">Adresse mail :</label>
                <div class="row">
                    <input type="text" class="form-control col-md-3 col-sm-12 ml-3" id="email" name="email" value="<?= $_SESSION['user']['email'] ?>" />
                </div>
                <p><?= isset($errorMessagesInfos['email']) ? $errorMessagesInfos['email'] : '' ?></p>
            </div>
            <input type="submit" id="updateUserInfos" name="updateUserInfos" value="Modifier mes informations" />
            <p><?= isset($errorMessagesInfos['success']) ? $errorMessagesInfos['success'] : '' ?></p>
        </form>
        <p id="passwordModification">Modifier mon mot de passe :</p>
        <form class="col-12" action="?display=infos" method="POST">
            <div class="form-group">
                <label for="password">Ancien mot de passe :</label>
                <div class="row">
                    <input type="password" class="form-control col-md-3 col-sm-12 ml-3" id="password" name="password" />
                </div>
            </div>
            <div class="form-group">
                <label for="newPassword">Nouveau mot de passe :</label>
                <div class="row">
                    <input type="password" class="form-control col-md-3 col-sm-12 ml-3" id="newPassword" name="newPassword" />
                </div>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirmer le nouveau mot de passe :</label>
                <div class="row">
                    <input type="password" class="form-control col-md-3 col-sm-12 ml-3" id="confirmPassword" name="confirmPassword" />
                </div>
            </div>
            <input type="submit" name="updatePassword" id="updatePassword" value="Enregistrer" />
        </form>
    </div>
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
