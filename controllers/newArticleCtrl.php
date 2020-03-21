<?php

if (!isset($_SESSION['user'])) {
    header('location: index.php');
    exit();
}

//Vérification du formulaire :
//Je stocke une regex permettant de reconnaitre l'URL d'une vidéo Youtube dans une variable.
$regexLinkVideo = '/^(https:\/\/)?(www.)?(youtube\.com\/|youtu\.be\/)watch\?v=(\w){11}$/';
/*Si l'input type submit "addNewArticle" est pressé alors l'instance de la classe "articles" et
un tableau pour les messages d'erreur est créé.*/
if (isset($_POST['addNewArticle'])) {
    $articles = new articles();
    $errorMessages = array();
    /*Si l'input "articleTitle" n'est pas vide alors je donne la valeur de l'input à l'attribut de la classe.
    Sinon un message d'erreur est créé.*/
    if (!empty($_POST['articleTitle'])) {
        $articles->title = htmlspecialchars($_POST['articleTitle']);
    } else {
        $errorMessages['articleTitle'] = 'Veuillez donner un titre à votre article.';
    }
    /*Si le paramètre de l'URL "type" est égale à "tuto" ou à "test" alors on vérifie si l'utilisateur veut écrire un article
     * sous forme de texte ou sous forme de vidéo à l'aide d'un <select> situé dans la Vue.
     */
    if ($_GET['type'] == 'tuto' || $_GET['type'] == 'test') {
        /*S'il s'agit d'un texte alors je vérifie si l'input "tutoOrTestContent" n'est pas vide.
         * Si c'est le cas alors je donne la valeur de l'input à l'attribut ""content" de la classe.
         * Sinon un message d'erreur est créé.
         */
        if ($_POST['articleByTextOrVideo'] == 'text') {
            if (!empty($_POST['tutoOrTestContent'])) {
                $articles->content = htmlspecialchars($_POST['tutoOrTestContent']);
            } else {
                $errorMessages['tutoOrTestContent'] = 'Votre article n\'a pas de contenu.';
            }
            /*S'il s'agit d'une vidéo alors je vérifie si l'input "videoLinkTestOrTuto" n'est pas vide.
             *Si c'est le cas, alors je vérifie qu'il s'agit bien d'un URL Youtube grâce à la fonction preg_match
             * et la regex puis je remplace une partie de l'URL afin qu'il puisse fonctionner avec un <iframe> de Youtube et je la stocke dans une variable.
             * La valeur de la variable est ensuite donnée à l'attribut de la classe.
             * Sinon un message d'erreur est créé.
             */
        } else if ($_POST['articleByTextOrVideo'] == 'video') {
            if (!empty($_POST['videoLinkTestOrTuto'])) {
                if (preg_match($regexLinkVideo, $_POST['videoLinkTestOrTuto'])) {
                    $videoLink = str_replace('watch?v=', 'embed/', $_POST['videoLinkTestOrTuto']);
                    $articles->content = htmlspecialchars($videoLink);
                } else {
                    $errorMessages['videoLinkTestOrTuto'] = 'Veuillez entrer un lien de vidéo Youtube valide.';
                }
            } else {
                $errorMessages['videoLinkTestOrTuto'] = 'Veuillez entrer le lien de votre vidéo Youtube.';
            }
        }
        //Si le paramètre de l'URL "type" est égale à "real" alors il s'agit d'une vidéo et je fais la même chose que précédemment.
    } else if ($_GET['type'] == 'real') {
        if (!empty($_POST['videoLink'])) {
            if (preg_match($regexLinkVideo, $_POST['videoLink'])) {
                $videoLink = str_replace('watch?v=', 'embed/', $_POST['videoLink']);
                $articles->content = htmlspecialchars($videoLink);
            } else {
                $errorMessages['videoLink'] = 'Veuillez entrer un lien de vidéo Youtube valide.';
            }
        } else {
            $errorMessages['videoLink'] = 'Veuillez entrer le lien de votre vidéo Youtube.';
        }
    }
//Si il n'y a pas de messages d'erreur,on attribut une valeur à l'attribut "idArticleType" de la classe
//puis on appelle la méthode qui enregistre le nouvel article et un message indiquant le succès de l'enregistrement.
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