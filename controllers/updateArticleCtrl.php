<?php
//Je stocke une regex permettant de reconnaitre une URL Youtube.
$regexYoutubeUrl = '/^(https:\/\/)?(www.)?(youtube\.com\/|youtu\.be\/)embed\/(\w){11}$/';
//J'instancie la classe "articles".
$articles = new articles();
/*
 * On vérifie si l'id de l'article est bien présent dans l'url et qu'il s'agit bien d'un chiffre.
 * Si c'est le cas, on vérifie si l'article exite.
 * S'il existe, on appelle la méthode "getArticle" afin d'obtenir les données de l'article,
 * sinon on est redirigé vers la page de l'utilisateur.
 * Enfin on vérifie si le contenu de l'article est une vidéo ou un texte.
 */
if (!empty($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $articles->id = htmlspecialchars($_GET['id']);
    $articleExists = $articles->checkIfArticleExists();
    if ($articleExists->articleExists == 1) {
        $article = $articles->getArticle();
    } else {
        header('location: userProfil.php?display=infos');
        exit();
    }
    if (preg_match($regexYoutubeUrl, $article->content)) {
        $videoOrText = 'video';
    } else {
        $videoOrText = 'text';
    }
}
//Si le bouton modifier est pressé :
if (isset($_POST['updateArticle'])) {
    //On crée un tableau qui stockera les erreurs
    $errorMessages = array();
    /*
     * On vérifie si les inputs ne sont pas vides.
     * S'ils ne sont pas vides, on associe les valeurs aux attributs de la classe.
     * Sinon on écrit un message d'erreur.
     */
    if (!empty($_POST['newTitle'])) {
        $articles->title = htmlspecialchars($_POST['newTitle']);
    } else {
        $errorMessages['newTitle'] = 'Veuillez donner un titre à votre article.';
    }
    if ($videoOrText == 'text') {
        if (!empty($_POST['newTextContent'])) {
            $articles->content = htmlspecialchars($_POST['newTextContent']);
        } else {
            $errorMessages['newTextContent'] = 'Veuillez donner un contenu à votre article.';
        }
    } else if ($videoOrText == 'video') {
        if (!empty($_POST['newVideoContent'])) {
            $articles->content = htmlspecialchars($_POST['newVideoContent']);
        } else {
            $errorMessages['newVideoContent'] = 'Veuillez donner un contenu à votre article.';
        }
    }
    //S'il n'y a pas de messages d'erreur alors on met l'article à jour.
    if (count($errorMessages) == 0) {
        //On récupère l'id de l'utilisateur qui est stocké dans la session.
        $articles->idUsers = $_SESSION['user']['userId'];
        $articleContent = $articles->updateArticle();
        $successMessage = 'Modification réussie !';
    }
}

