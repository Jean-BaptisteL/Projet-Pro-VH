<?php
ini_set('session.gc_maxlifetime', 7200);
session_start();
include_once 'models/users.php';
include_once 'models/articles.php';
include_once 'controllers/listArticlesCtrl.php';
include_once 'controllers/headerCtrl.php';
include_once 'includes/header.php';
?>
<h2 class="text-center"><?= $pageTitle ?></h2>
<?php
if ($numberOfArticle > 0) {
    foreach ($articlesList as $article) {
        ?>
        <div class="row justify-content-around">
            <div class="col-md-6 col-sm-12 text-center">
                <article class="row articlesPresentation justify-content-around">
                    <div class="col-8 articleDescription">
                        <h3 class="articleTitle text-center"><a href="article.php?id=<?= $article->id ?>"><?= $article->title ?></a></h2>
                            <p>Par <?= $article->userName ?> le <?= $article->publicationDate ?></p>
                    </div>
                </article>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="text-center">
        <?php
        //Pagination
        if ($page > 1) {
            ?>
            <a href="listArticles.php?type=<?= $_GET['type'] ?>&page=<?= $page - 1 ?>" class="btn btn-light">Page précédente</a>
            <?php
        }
        for ($infPages = 3; $infPages >= 1; $infPages--) {
            if ($page - $infPages >= 1) {
                ?>
                <a href="listArticles.php?type=<?= $_GET['type'] ?>&page=<?= $page - $infPages ?>" class="btn btn-light"><?= $page - $infPages; ?></a>
            <?php
            }
        }
        ?>
        <a href="listArticles.php?type=<?= $_GET['type'] ?>&page=<?= $page ?>" class="btn btn-primary"><?= $page; ?></a>
        <?php
        for ($supPages = 1; $supPages <= 3; $supPages++) {
            if ($page + $supPages <= $numberOfPages) {
                ?>
                <a href="listArticles.php?type=<?= $_GET['type'] ?>&page=<?= $page + $supPages ?>" class="btn btn-light"><?= $page + $supPages; ?></a><?php } ?>
            <?php
        }
        if ($page < $numberOfPages) {
            ?>
            <a href="listArticles.php?type=<?= $_GET['type'] ?>&page=<?= $page + 1 ?>" class="btn btn-light">Page suivante</a>
            <?php
        }
        ?>
    </div>
<?php } else {
    ?>
    <h3>C'est encore vide ici.</h3>
    <?php
}
include_once 'includes/footer.php';
?>
