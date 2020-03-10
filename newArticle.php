<?php
ini_set('session.gc_maxlifetime', 7200);
session_start();
$pageTitle = 'Nouvel article';
include_once 'models/articles.php';
include_once 'controllers/headerCtrl.php';
include_once 'includes/header.php';
?>
<h2>Rédaction d'un article</h2>
<p>Ici, ous pouvez rédiger un nouveau tuto, un test d'une de vos machines ou montrer à tous vos plus belles vidéos Youtube!<br />
    N'oubliez pas de remplir tous les champs correctement.<br />
    Enfin, vous êtes prié d'employer un langage respectueux : pas de grossièretés, d'insultes, etc...</p>
<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <div class="form-group">
        <label for="articleTitle">Titre de l'article</label>
        <input class="form-control col-md-3 col-sm-12" type="text" name="articleTitle" id="articleTitle" />
    </div>
    <?php
    if ($_GET['type'] == 'tuto' || $_GET['type'] == 'test') {
        ?>
    <div class="form-group">
        <label for="tutoOrTestContent">Vous pouvez rédiger ici votre <?= $_GET['type'] == 'tuto' ? 'tutoriel' : 'test' ?> :</label>
        <textarea name="tutoOrTestContent" id="tutoOrTestContent"></textarea>
    </div>
        <?php
    } else if ($_GET['type'] == 'real') {
        ?>
        <div class="form-group">
            <label for="videoLink">Lien de votre vidéo Youtube :</label>
            <input type="text" name="videoLink" id="videoLink" class="form-control" />
        </div>
    <?php
    }
    ?>
    </form>
    <?php
    include_once 'includes/footer.php';

    