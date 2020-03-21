<?php

if (!isset($_SESSION['user'])) {
    header('location: index.php');
    exit();
}
//Si l'utilisateur supprime le GET, une redirection est effectuée.
if (!isset($_GET['display']) || empty($_GET['display'])) {
    header('location: userProfil.php?display=infos');
    exit();
}

$errorMessagesInfos = array();
//Modification des informations de l'utilisateur.
//Vérification du formulaire
if (isset($_POST['updateUserInfos'])) {
    $users = new users();
    if (!empty($_POST['userName'])) {
        $users->name = htmlspecialchars($_POST['userName']);
    } else {
        $errorMessagesInfos['userName'] = 'Veuillez entrer un nom d\'utilisateur';
    }
    if (!empty($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $users->email = htmlspecialchars($_POST['email']);
        } else {
            $errorMessagesInfos['email'] = 'Veuillez entrer une adresse mail valide.';
        }
    } else {
        $errorMessagesInfos['email'] = 'Veuillez entrer une adresse mail.';
    }
    if (count($errorMessagesInfos) == 0) {
        $user = $users->checkIfUserExists();
        $userName = $users->checkIfUserNameExists();
        $userEmail = $users->checkIfEmailExists();
        $users->id = $_SESSION['user']['userId'];
        //Le cas où l'utilisateur veut changer son nom et son adresse mail et qu'ils n'existent pas encore.
        if ($user->userExists == 0 && $_POST['userName'] != $_SESSION['user']['userName'] && $_POST['userName'] != $_SESSION['user']['email']) {
            $users->updateUserInfos();
            $newUserInfos = $users->getUserInfos();
            $_SESSION['user']['userName'] = $newUserInfos->name;
            $_SESSION['user']['email'] = $newUserInfos->email;
            $errorMessagesInfos['success'] = 'Mise à jour réussie !';
            //Le cas où l'utilisateur veut changer seulement son nom mais que ce dernier existe déjà.
        } else if ($userName->userNameExists == 1 && $userEmail->emailExists == 1 && $_POST['userName'] != $_SESSION['user']['userName'] && $_POST['email'] == $_SESSION['user']['email']) {
            $errorMessagesInfos['userName'] = 'Ce nom existe déjà';
            //Le cas où l'utilisateur veut changer seulement son adresse mail mais que cette dernière existe déjà.
        } else if ($userName->userNameExists == 1 && $userEmail->emailExists == 1 && $_POST['userName'] == $_SESSION['user']['userName'] && $_POST['email'] != $_SESSION['user']['email']) {
            $errorMessagesInfos['email'] = 'Cette adresse mail existe déjà';
            //Le cas où l'utilisateur veut changer seulement son adresse mail et que cette dernière n'existe pas encore.
        } else if ($userName->userNameExists == 1 && $userEmail->emailExists == 0 && $_POST['userName'] == $_SESSION['user']['userName'] && $_POST['email'] != $_SESSION['user']['email']) {
            $users->updateUserInfos();
            $newUserInfos = $users->getUserInfos();
            $_SESSION['user']['email'] = $newUserInfos->email;
            $errorMessagesInfos['success'] = 'Mise à jour réussie !';
            //Le cas où l'utilisateur veut changer seulement son nom et que ce dernier n'existe pas encore.
        } else if ($userName->userNameExists == 0 && $userEmail->emailExists == 1 && $_POST['userName'] != $_SESSION['user']['userName'] && $_POST['email'] == $_SESSION['user']['email']) {
            $users->updateUserInfos();
            $newUserInfos = $users->getUserInfos();
            $_SESSION['user']['userName'] = $newUserInfos->name;
            $errorMessagesInfos['success'] = 'Mise à jour réussie !';
            //Le cas où l'utilisateur veut changer son nom et son adresse mais qu'ils existent déjà.
        } else if ($userName->userNameExists == 1 && $userEmail->emailExists == 1 && $_POST['userName'] != $_SESSION['user']['userName'] && $_POST['email'] != $_SESSION['user']['email']) {
            $errorMessagesInfos['userName'] = 'Ce nom existe déjà';
            $errorMessagesInfos['email'] = 'Cette adresse mail existe déjà';
        }
    }
}
//Modification du mot de passe.
$errorMessagesPassword = array();
if (isset($_POST['updatePassword'])) {
    $users = new users();
    if (!empty($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
    } else {
        $errorMessagesPassword['password'] = 'Veuillez entrer votre mot de passe.';
    }
    if (!empty($_POST['newPassword'])) {
        if (!empty($_POST['confirmPassword'])) {
            if ($_POST['newPassword'] == $_POST['confirmPassword']) {
                $newPassword = htmlspecialchars($_POST['newPassword']);
            } else {
                $errorMessagesPassword['confirmPassword'] = 'Le mot de passe de confirmation est différent du nouveau mot de passe.';
            }
        } else {
            $errorMessagesPassword['confirmPassword'] = 'Veuillez confirmer le nouveau mot de passe.';
        }
    } else {
        $errorMessagesPassword['newPassword'] = 'Veuillez entrer votre nouveau mot de passe.';
    }
    if (count($errorMessagesPassword) == 0) {
        if (password_verify($password, $_SESSION['user']['password'])) {
            $users->password = password_hash($newPassword, PASSWORD_BCRYPT);
            $users->id = $_SESSION['user']['userId'];
            $users->updatePassword();
        } else {
            $errorMessagesPassword['password'] = 'Mot de passe incorrect.';
        }
    }
}
//Suppression de l'utilisateur:
if (isset($_POST['deleteConfirmation'])) {
    $users = new users();
    if (!empty($_POST['deletePassword'])) {
        $deletePassword = htmlspecialchars($_POST['deletePassword']);
        if (password_verify($deletePassword, $_SESSION['user']['password'])) {
            $users->id = $_SESSION['user']['userId'];
            $users->deleteUser();
            unset($_SESSION['user']);
            header('location: index.php');
            exit();
        } else {
            $errorMessagesForDelete = 'Mot de passe incorrect.';
        }
    } else {
        $errorMessagesForDelete = 'Veuillez entrer votre mot de passe.';
    }
}
//Affichage des articles de l'utilisateur triés par type.
if (isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT)) {
    $page = $_GET['page'];
} else if (!isset($_GET['page'])) {
    $page = $_GET['page'] = 1;
}
$articles = new articles();
if ($_GET['display'] == 'tests') {
    $articles->idArticleType = 1;
} else if ($_GET['display'] == 'tutos') {
    $articles->idArticleType = 2;
} else if ($_GET['display'] == 'produc') {
    $articles->idArticleType = 3;
}
if ($_GET['display'] == 'tests' || $_GET['display'] == 'tutos' || $_GET['display'] == 'produc') {
    $offset = ($page - 1) * 10;
    $articles->idUsers = $_SESSION['user']['userId'];
    $articlesList = $articles->getArticleByUserAndType($offset);
    $numberOfArticles = $articles->getNumberOfArticles();
    $numberOfPages = ceil($numberOfArticles / 10);
}
//Suppression d'un article :
//Si l'input type submit a été pressé, j'appelle la méthode "deleteArticle" qui supprime l'article puis je rafraichis la page.
if (isset($_POST['deleteArticle'])){
    $articles->id = $_POST['articleId'];
    $articles->idUsers = $_SESSION['user']['userId'];
    $articles->deleteArticle();
    header('location: userProfil.php?display=' . $_GET['display']);
}