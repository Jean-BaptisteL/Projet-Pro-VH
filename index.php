<?php
ini_set('session.gc_maxlifetime', 7200);
session_start();
$pageTitle = 'Projet Drone';
include_once 'models/users.php';
include_once 'models/articles.php';
include_once 'controllers/indexCtrl.php';
include_once 'controllers/headerCtrl.php';
include_once 'includes/header.php';
if ($numberOfArticles > 0) {
    foreach ($lastArticles as $article) {
        ?>
        <div class="row justify-content-around">
            <div class="col-md-10 col-sm-12">
                <article class="row articlesPresentation justify-content-around">
                    <div class="text-center col-md-2 col-sm-12 bg-light articleTypeBox">
                        <p class="articleType"><strong><?= $article->articleType ?></strong></p>
                    </div>
                    <div class="col-8 articleDescription">
                        <h2 class="articleTitle text-center"><a href="showArticle.php?id=<?= $article->id ?>"><?= $article->title ?></a></h2>
                        <p>Par <?= $article->userName ?> le <?= $article->publicationDate ?></p>
                    </div>
                </article>
            </div>
        </div>
        <?php
    }
} else {
    ?>
<h2>Aucun article n'a encore été publié sur le site !</h2>
<?php
}
    include_once 'includes/footer.php';
    