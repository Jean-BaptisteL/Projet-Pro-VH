<?php

if (isset($_POST['userLogin'])) {
    $users = new users();
    $errorMessagesForLogin = array();
    $errorOrSuccessLogin = '';
    if (!empty($_POST['userNameOrEmail'])) {
        $users->name = $users->email = htmlspecialchars($_POST['userNameOrEmail']);
    } else {
        $errorMessagesForLogin['userNameOrEmail'] = 'Veuillez entrer votre identifiant ou votre adresse mail.';
    }
    if (!empty($_POST['userPassword'])) {
        $users->password = htmlspecialchars($_POST['userPassword']);
    } else {
        $errorMessagesForLogin['userPassword'] = 'Veuillez entrer votre mot de passe.';
    }
    if (count($errorMessagesForLogin) == 0) {
        $userInfos = $users->getUserInfo();
        if ($userLogin == false) {
            $errorOrSuccessLogin = 'Le nom d\'utilisateur, l\'adresse mail ou le mot de passe sont incorrectes.';
        } else {
        }
    }
}
