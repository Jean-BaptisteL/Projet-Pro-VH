<?php

$regexYoutubeUrl = '/^(https:\/\/)?(www.)?(youtube\.com\/|youtu\.be\/)embed\/(\w){11}$/';
$articles = new articles();
if (!empty($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $articles->id = htmlspecialchars($_GET['id']);
    $article = $articles->getArticle();
    if (preg_match($regexYoutubeUrl, $article->content)) {
        $videoOrText = 'video';
    } else {
        $videoOrText = 'text';
    }
}

