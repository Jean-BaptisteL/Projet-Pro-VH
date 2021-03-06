<?php
ini_set('session.gc_maxlifetime', 7200);
session_start();
$pageTitle = 'Nouvel article';
include_once 'models/users.php';
include_once 'models/articles.php';
include_once 'controllers/headerCtrl.php';
include_once 'controllers/newArticleCtrl.php';
include_once 'includes/header.php';
?>
<div class="bodyPage">
    <h2>Rédaction d'un article</h2>
    <p>Ici, ous pouvez rédiger un nouveau tuto, un test d'une de vos machines ou montrer à tous vos plus belles vidéos Youtube!<br />
        N'oubliez pas de remplir tous les champs correctement.<br />
        Enfin, vous êtes prié d'employer un langage respectueux : pas de grossièretés, d'insultes, etc...</p>
    <p><strong>Attention ! Si vous voulez ajouter des images à votre tuto ou votre test,<br />
            veuillez les héberger sur <a href="https://www.zupimages.net" title="Zupimages">Zupimages</a> et les copier/coller dans l'air de saisi de texte.</strong></p>
    <form action="#" method="POST">
        <div class="form-group">
            <label for="articleTitle">Titre de l'article</label>
            <input class="form-control col-md-3 col-sm-12" type="text" name="articleTitle" id="articleTitle"  value="<?= isset($errorMessages['articleTitle']) ? $errorMessages['articleTitle'] : '' ?>" />
        </div>
        <?php
        if ($_GET['type'] == 'tuto' || $_GET['type'] == 'test') {
            ?>
            <div class="form-group">
                <label for="articleByTextOrVideo">Sous quel format voulez-vous publier votre <?= $_GET['type'] == 'tuto' && isset($_GET['type']) ? 'tutoriel' : 'test' ?> ? </label>
                <!--Si l'option text est choisie alors un textarea apparait sinon c'est un input type text.-->
                <select class="form-control col-md-2 col-sm-12" id="articleByTextOrVideo" name="articleByTextOrVideo">
                    <option value="text">Format texte</option>
                    <option value="video">Format vidéo Youtube</option>
                </select>
            </div>
            <div class="form-group" id="byText">
                <label for="tutoOrTestContent">Vous pouvez rédiger ici votre <?= $_GET['type'] == 'tuto' && isset($_GET['type']) ? 'tutoriel' : 'test' ?> :</label>
                <textarea name="tutoOrTestContent" id="tutoOrTestContent"><?= isset($_POST['tutoOrTestContent']) ? $_POST['tutoOrTestContent'] : '' ?></textarea>
                <!--Grâce à un API, les textarea sont équipé d'un éditeur de texte-->
                <p><?= isset($errorMessages['tutoOrTestContent']) ? $errorMessages['tutoOrTestContent'] : '' ?></p>
            </div>
            <div class="form-group" id="byVideo">
                <label for="videoLinkTestOrTuto">URL de votre vidéo Youtube :</label>
                <input class="form-control col-md-4 col-sm-12" type="text" name="videoLinkTestOrTuto" id="videoLinkTestOrTuto" />
                <p><?= isset($errorMessages['videoLinkTestOrTuto']) ? $errorMessages['videoLinkTestOrTuto'] : '' ?></p>
            </div>
            <?php
        } else if ($_GET['type'] == 'real') {
            ?>
            <div class="form-group">
                <label for="videoLink">Lien de votre vidéo Youtube :</label>
                <input class="form-control col-md-4 col-sm-12" type="text" name="videoLink" id="videoLink" />
                <p><?= isset($errorMessages['videoLink']) ? $errorMessages['videoLink'] : '' ?></p>
            </div>
            <?php
        }
        ?>
        <input class="btn btn-light" type="submit" name="addNewArticle" id="addNewArticle" value="Enregistrer" />
        <p><?= isset($successMessage) ? $successMessage : '' ?></p>
        <?php
        ?>
    </form>
</div>
<?php
include_once 'includes/footer.php';

