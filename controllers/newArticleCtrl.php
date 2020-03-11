<?php

//On vérifie si tous les imputs ont été remplis correctement. Si c'est le cas, les données sont envoyer dans l'instance de la classe "articles".
//Sinon on crée un message d'erreur.
if (isset($_POST['addNewArticle'])) {
    $articles = new articles();
    $errorMessages = array();
    if (!empty($_POST['articleTitle'])) {
        $articles->title = htmlspecialchars($_POST['articleTitle']);
    } else {
        $errorMessages['articleTitle'] = 'Veuillez donner un titre à votre article.';
    }
    if ($_GET['type'] == 'tuto' || $_GET['type'] == 'test') {
        if ($_POST['articleByTextOrVideo'] == 'text') {
            if (!empty($_POST['tutoOrTestContent'])) {
                $articles->content = htmlspecialchars($_POST['tutoOrTestContent']);
            } else {
                $errorMessages['tutoOrTestContent'] = 'Votre article n\'a pas de contenu.';
            }
        } else if ($_POST['articleByTextOrVideo'] == 'video') {
            $videoLink = str_replace('watch?v=', 'embed/', $_POST['videoLinkTestOrTuto']);
            $articles->content = htmlspecialchars($videoLink);
        }
    } else if ($_GET['type'] == 'real') {
        if (!empty($_POST['videoLink'])) {
            $videoLink = str_replace('watch?v=', 'embed/', $_POST['videoLink']);
            $articles->content = htmlspecialchars($videoLink);
        } else {
            $errorMessages['videoLink'] = 'Veuillez entrer le lien de votre vidéo Youtube';
        }
    }
//Si il n'y a pas de messages d'erreur, on appelle la méthode qui enregistre le nouvel article.
    if (count($errorMessages) == 0) {
        $articles->idUsers = $_SESSION['user']['userId'];
        if ($_GET['type'] == 'tuto') {
            $articles->idArticleType = 2;
        } else if ($_GET['type'] == 'test') {
            $articles->idArticleType = 1;
        } else if ($_GET['type'] == 'real') {
            $articles->idArticleType = 3;
        }
        $articles->addNewArticle();
        $successMessage = 'Eregistrement terminée !';
    }
}