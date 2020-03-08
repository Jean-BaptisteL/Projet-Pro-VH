<?php

$errorMessages = array();
//Vérification du formulaire
if (isset($_POST['addNewUser'])) {
    $users = new users();
    if (!empty($_POST['pseudo'])) {
        $users->name = htmlspecialchars($_POST['pseudo']);
    } else {
        $errorMessages['pseudo'] = 'Veuillez entrer un nom d\'utilisateur';
    }
    if (!empty($_POST['email']) && !empty($_POST['confirmEmail'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            if ($_POST['email'] == $_POST['confirmEmail']) {
                $users->email = htmlspecialchars($_POST['email']);
            } else {
                $errorMessages['confirmEmail'] = 'Les deux adresses mail doivent être identiques.';
            }
        } else {
            $errorMessages['email'] = 'Veuillez entrer une adresse mail valide.';
        }
    } else {
        $errorMessages['confirmEmail'] = $errorMessages['email'] = 'Veuillez entrer une adresse mail et la confirmer.';
    }
    if (!empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
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
            //Création du hash.
            $letter = 'a';
            $lettersMin = array();
            for ($i = 1; $i <= 26; $i++) {
                $lettersMin[] = $letter;
                $letter++;
            }
            $lettersMax = array_map('strtoupper', $lettersMin);
            $specialCharacters = array('$', 'ù', '%', '£', 'µ', '#', 'é', '&', 'è', 'ç', 'à', '<', '>', '§');
            $numbers = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
            $charactersArray = array_merge($lettersMin, $lettersMax, $specialCharacters, $numbers);
            $hash = '';
            for ($i = 1; $i <= 50; $i++) {
                shuffle($charactersArray);
                $randomNumber = random_int(0, rand(0, count($charactersArray) - 1));
                $hash .= $charactersArray[$randomNumber];
            }
            $users->hash = htmlspecialchars($hash);
            //Ajout du nouvel utilisateur
            $users->addNewUser();
            $errorMessages['success'] = 'Inscription réussie !';
        } else {
            $errorMessages['pseudo'] = $errorMessages['email'] = 'Ce nom ou cette adresse mail existe déjà.';
        }
    }
}
