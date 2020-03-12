<?php

$articles = new articles();
$lastArticles = $articles->showAllArticles();
$numberOfArticles = $articles->getNumberOfArticles();

