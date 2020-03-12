<?php
ini_set('session.gc_maxlifetime', 7200);
session_start();
$pageTitle = 'Profil de ' . $_SESSION['user']['userName'];
include_once 'models/users.php';
include_once 'controllers/headerCtrl.php';
include_once 'controllers/userProfilCtrl.php';
include_once 'includes/header.php';
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
        <div class="col-md-4 col-sm-12 justify-content-center mx-auto">
            <div class="row">
                <h3 class="col-12 text-center" id="infosTitle">Mes informations :</h3>
                <p class="col-12">Vous pouvez les modifier en modifiant le contenu des champs.</p>
                <form class=" col-12" action="?display=infos" method="POST">
                    <div class="form-group">
                        <label for="userName">Nom :</label>
                        <input type="text" class="form-control" id="userName" name="userName" value="<?= $_SESSION['user']['userName'] ?>" />
                        <p><?= isset($errorMessagesInfos['userName']) ? $errorMessagesInfos['userName'] : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label for="email">Adresse mail :</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $_SESSION['user']['email'] ?>" />
                        <p><?= isset($errorMessagesInfos['email']) ? $errorMessagesInfos['email'] : '' ?></p>
                    </div>
                    <input type="submit" id="updateUserInfos" name="updateUserInfos" value="Modifier mes informations" />
                    <p><?= isset($errorMessagesInfos['success']) ? $errorMessagesInfos['success'] : '' ?></p>
                </form>
                <p id="passwordModification" class="col-12">Modifier mon mot de passe :</p>
                <form class="col-12" action="?display=infos" method="POST">
                    <div class="form-group">
                        <label for="password">Ancien mot de passe :</label>
                        <input type="password" class="form-control" id="password" name="password" />
                        <p><?= isset($errorMessagesPassword['password']) ? $errorMessagesPassword['password'] : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">Nouveau mot de passe :</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" />
                        <p><?= isset($errorMessagesPassword['newPassword']) ? $errorMessagesPassword['newPassword'] : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirmer le nouveau mot de passe :</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" />
                        <p><?= isset($errorMessagesPassword['confirmPassword']) ? $errorMessagesPassword['confirmPassword'] : '' ?></p>
                    </div>
                    <input type="submit" name="updatePassword" id="updatePassword" value="Enregistrer" />
                </form>
            </div>
            <h3>Suppression du compte :</h3>
            <p>Si vous le désirez, vous pouvez supprimer votre compte.</p>
            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" name="deleteUser" id="deleteUser">Supprimer le compte</button>
        </div>
    </div>
    <!--Modal pour la suppression du compte-->
    <div class="modal" id="deleteModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Suppression du compte</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body row">
                    <form class="justify-content-center mx-auto" action="?display=infos" method="POST">
                        <p>Entrez votre mot de passe pour pouvoir supprimer votre compte.</p>
                        <label for="password">Mot de passe :</label>
                        <input type="password" class="form-control" name="deletePassword" id="deletePassword" />
                        <p><?= isset($errorMessagesForDelete) ? $errorMessagesForDelete : '' ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <input type="submit" class="btn btn-danger" id="deleteConfirmation" name="deleteConfirmation" value="Supprimer" />
                </div>
                </form>
            </div>
        </div>
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
