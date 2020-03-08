<?php

$errorMessages = array();
//Vérification du formulaire
if (isset($_POST['updateUserInfos'])) {
    $users = new users();
    if (!empty($_POST['userName'])) {
        $users->name = htmlspecialchars($_POST['userName']);
    } else {
        $errorMessages['userName'] = 'Veuillez entrer un nom d\'utilisateur';
    }
    if (!empty($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $users->email = htmlspecialchars($_POST['email']);
        } else {
            $errorMessages['email'] = 'Veuillez entrer une adresse mail valide.';
        }
    } else {
        $errorMessages['email'] = 'Veuillez entrer une adresse mail.';
    }
    if (!empty($_POST['password']) && !empty($_POST['newPassword']) && !empty($_POST['confirmPassword'])) {
        if ($_POST['password'] == $_POST['confirmPassword']) {
            $users->password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT);
        } else {
            $errorMessages['confirmPassword'] = 'Les deux mots de passe ne sont pas identiques.';
        }
    } else {
        $errorMessages['confirmPassword'] = $errorMessages['password'] = 'Veuillez entrer un mot de passe et le confirmer.';
    }
    if (count($errorMessages) == 0) {
        $user = $users->checkIfUserExists();
        if ($user->userExists == 0) {
            //Ajout du nouvel utilisateur
            $users->addNewUser();
            $errorMessages['success'] = 'Inscription réussie !';
        } else {
            $errorMessages['pseudo'] = $errorMessages['email'] = 'Ce nom ou cette adresse mail existe déjà.';
        }
    }
}
