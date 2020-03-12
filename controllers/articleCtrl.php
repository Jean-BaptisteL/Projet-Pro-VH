<?php

$articles = new articles();
if (!empty($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $articles->id = htmlspecialchars($_GET['id']);
    $article = $articles->getArticle();
}

