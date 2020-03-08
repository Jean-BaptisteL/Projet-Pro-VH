<?php

//Vérification du formulaire de connexion et création des variables globales $_SESSION pour la connexion
if (isset($_POST['userLogin'])) {
    $users = new users();
    $errorMessagesForLogin = array();
    if (!empty($_POST['userNameOrEmail'])) {
        $users->name = $users->email = htmlspecialchars($_POST['userNameOrEmail']);
        $checkUserNameExists = $users->checkIfUserExists();
        if ($checkUserNameExists->userExists == 1) {
            if (!empty($_POST['userPassword'])) {
                $usersPassword = htmlspecialchars($_POST['userPassword']);
            } else {
                $errorMessagesForLogin['userPassword'] = 'Veuillez entrer votre mot de passe.';
            }
        } else {
            $errorMessagesForLogin['errorLogin'] = 'Identifiant, adresse mail ou mot de passe incorrectes !';
        }
    } else {
        $errorMessagesForLogin['userNameOrEmail'] = 'Veuillez entrer votre identifiant ou votre adresse mail.';
    }
    if (count($errorMessagesForLogin) == 0) {
        $userInfosForLogin = $users->getUserInfos();
        if (password_verify($usersPassword, $userInfosForLogin->password)) {
            $_SESSION['user']['userId'] = $userInfosForLogin->id;
            $_SESSION['user']['userName'] = $userInfosForLogin->name;
            $_SESSION['user']['userType'] = $userInfosForLogin->userTypeId;
            $_SESSION['user']['email'] = $userInfosForLogin->email;
            $_SESSION['user']['password'] = $userInfosForLogin->password;
        } else {
            $errorMessagesForLogin['errorLogin'] = 'Identifiant, adresse mail ou mot de passe incorrectes !';
        }
    }
}
//Déconnexion
if (isset($_GET['signOut'])) {
    if ($_GET['signOut'] == 'true') {
        unset($_SESSION['user']);
        header('location: index.php');
    }
}