<?php

//Vérification du formulaire de connexion et création des variables superglobales $_SESSION pour la connexion :
/*
 * Si le bouton de connexion est pressé, je crée une instance de la classe "users"
 * ainsi qu'un tableau qui contiendra les messages d'erreur.
 */
if (isset($_POST['userLogin'])) {
    $users = new users();
    $errorMessagesForLogin = array();
    /*
     * Si l'input "userNameOrEmail" n'est pas vide, je donne la valeur de l'input aux attributs "name" et "email"
     * tout en passant par un htmlspecialchars pour la sécurité. Puis je vérifie si la valeur de l'input correspond à un utilisateur.
     * Si l'input "userNameOrEmail" est vide, un message d'erreur est créé.
     */
    if (!empty($_POST['userNameOrEmail'])) {
        $users->name = $users->email = htmlspecialchars($_POST['userNameOrEmail']);
        $checkUserNameExists = $users->checkIfUserExists();
        /*
         * Si l'utilisateur existe et que l'input "userPassword" n'est pas vide, je stocke le mot de passe dans une variable.
         * Sinon un message d'erreur est créé.
         */
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
    /*
     * Si le tableau de messages d'erreur est vide alors je récupère les informations de l'utilisateur en appelant 
     * la méthode "getUserInfos". Sinon un message d'erreur est créé.
     */
    if (count($errorMessagesForLogin) == 0) {
        $userInfosForLogin = $users->getUserInfos();
        /*
         * Grâce à la fonction "password_verify", je compare le mot de passe donné dans l'input avec
         * le mot de passe hashé de la base de données. S'ils correspondent, je stocke les informations de l'utilisateur
         * dans la superglobale "$_SESSION". Sinon un message d'erreur est créé.
         */
        if (password_verify($usersPassword, $userInfosForLogin->password)) {
            $_SESSION['user']['userId'] = $userInfosForLogin->id;
            $_SESSION['user']['userName'] = $userInfosForLogin->name;
            $_SESSION['user']['userType'] = $userInfosForLogin->userTypeId;
            $_SESSION['user']['email'] = $userInfosForLogin->email;
            $_SESSION['user']['password'] = $userInfosForLogin->password;
            header('location: index.php');
            exit();
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
        exit();
    }
}