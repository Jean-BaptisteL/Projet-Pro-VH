<?php
ini_set('session.gc_maxlifetime', 7200);
session_start();
include_once 'models/users.php';
include_once 'models/articles.php';
include_once 'controllers/showArticleCtrl.php';
include_once 'controllers/headerCtrl.php';
$pageTitle = isset($article->title) ? $article->title : 'Article inexistant';
include_once 'includes/header.php';
if ($article == false || !isset($article)) {
    ?>
    <h2 class="text-center">Cet article n'existe pas</h2>
<?php } else { ?>
    <h2 class="text-center"><?= $article->articleType ?> présenté par <?= $article->userName ?></h2>
    <p class="text-center">Rédiger le <?= $article->publicationDate ?></p>
    <?php if ($videoOrText == 'video') { ?>
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12 text-center embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" width="560" height="315" src="<?= $article->content ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    <?php } else if ($videoOrText == 'text') {
        ?>
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12 bg-light">
                <?= htmlspecialchars_decode($article->content) ?>
            </div>
        </div>
        <?php
    }
}
include_once 'includes/footer.php';
?>


