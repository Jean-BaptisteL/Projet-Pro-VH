<?php

$articles = new articles();
if(isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT)){
$page = $_GET['page'];
}
$offset = ($page - 1) * 10;
if ($_GET['type'] == 'tests'){
    $articles->idArticleType = 1;
}else if ($_GET['type'] == 'tutos'){
    $articles->idArticleType = 2;
}else if ($_GET['type'] == 'real'){
    $articles->idArticleType = 3;
}
$articlesList = $articles->showArticlesByTypes($offset);
$numberOfArticle = $articles->getNumberOfArticles();
$numberOfPages = ceil($numberOfArticle / 10);
if ($_GET['type'] == 'tests') {
    $pageTitle = 'Liste des tests';
} else if ($_GET['type'] == 'tutos') {
    $pageTitle = 'Liste des tutos';
} else if ($_GET['type'] == 'real') {
    $pageTitle = 'Liste des réalisations';
}