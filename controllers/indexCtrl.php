<?php
//J'instancie la classe.
$articles = new articles();
//J'appelle la méthode "showAllArticles",
$lastArticles = $articles->showAllArticles();
//ainsi que la méthode "getNumberOfArticles".
$numberOfArticles = $articles->getNumberOfArticles();

