<?php

ini_set('session.gc_maxlifetime', 7200);
session_start();
include_once 'models/users.php';
include_once 'models/articles.php';
include_once 'controllers/articleCtrl.php';
include_once 'controllers/headerCtrl.php';
$pageTitle = isset($article->title) ? $article->title : 'Article inexistant';
include_once 'includes/header.php';
if ($article == false || !isset($article)){
?>
<h2>Cet article n'existe pas</h2>
<?php } else {?>
<h2><?= $article->articleType ?> présenté par <?= $article->userName ?></h2>
<p>Rédiger le <?= $article->publicationDate ?></p>

<?php }
 include_once 'includes/footer.php';
?>


