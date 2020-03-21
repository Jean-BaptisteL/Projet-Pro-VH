<?php
session_start();
$pageTitle = 'Modifier l\'article';
include_once 'models/users.php';
include_once 'models/articles.php';
include_once 'controllers/headerCtrl.php';
include_once 'controllers/updateArticleCtrl.php';
include_once 'includes/header.php';
?>
<p><?= isset($successMessage) ? $successMessage : '' ?></p>
<form action="#" method="POST">
    <div class="form-group">
        <label for="newTitle">Titre de l'article</label>
        <input class="form-control col-md-3 col-sm-12" type="text" name="newTitle" id="newTitle"  value="<?= $article->title ?>" />
        <p><?= isset($errorMessages['newTitle']) ? $errorMessages['newTitle'] : '' ?>
    </div>
    <?php
    //Si le contenu de l'article est un texte alors j'affiche un textarea.
    if ($videoOrText == 'text') {
        ?>
        <div class="form-group">
            <label for="newTextContent">Vous pouvez ici modifier le contenu de votre article :</label>
            <textarea name="newTextContent" id="newTextContent"><?= $article->content ?></textarea>
            <p><?= isset($errorMessages['newTextContent']) ? $errorMessages['newTextContent'] : '' ?></p>
        </div>
        <?php
        //Si le contenu de l'article est une vidéo alors j'affiche un aperçu de la vidéo et un input type text..
    } else if ($videoOrText == 'video') {
        ?>
        <p>Ce n'est pas votre vidéo ?</p>
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12 text-center embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" width="560" height="315" src="<?= $article->content ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <div class="form-group">
            <label for="newVideoContent">URL de votre vidéo Youtube :</label>
            <input class="form-control col-md-4 col-sm-12" type="text" name="newVideoContent" id="newVideoContent" class="form-control" value="<?= $article->content ?>" />
            <p><?= isset($errorMessages['newVideoContent']) ? $errorMessages['newVideoContent'] : '' ?></p>
        </div>
        <?php
    }
    ?>
    <input class="btn btn-light" type="submit" name="updateArticle" id="updateArticle" value="Modifier" />
</form>
<?php
include_once 'includes/footer.php';
