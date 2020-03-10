<?php

ini_set('session.gc_maxlifetime', 7200);
session_start();
$pageTitle = 'Nouvel article';
include_once 'models/articles.php';
include_once 'controllers/headerCtrl.php';
include_once 'includes/header.php';
?>
<h2>Rédaction d'un article</h2>
<p>Ici, ous pouvez rédiger un nouveau tuto, un test d'une de vos machines ou montrer à tous vos plus belles réalisations, vidéos ou photo !<br />
    N'oubliez pas de remplir tous les champs correctement : si vous rédigez un tuto, sélectionnez "Tuto" dans la barre de sélection par exemple.<br />
Enfin, vous êtes prié d'employer un langage respectueux : pas de grossièretés, d'insultes, etc...</p>
<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <div class="form-group">
        <label for="articleTitle">Titre de l'article</label>
        <input class="form-control col-md-3 col-sm-12" type="text" name="articleTitle" id="articleTitle" />
    </div>
    <textarea></textarea>
</form>
<?php
include_once 'includes/footer.php';

