<?php

$regexYoutubeLink = '/^https:\/\/www.youtube.com\/embed\/[a-zA-Z0-9]{11}$/';
$articles = new articles();
if (!empty($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $articles->id = htmlspecialchars($_GET['id']);
    $article = $articles->getArticle();
    if (preg_match($regexYoutubeLink, $article->content)) {
        $videoOrText = 'video';
    } else {
        $videoOrText = 'text';
    }
}

