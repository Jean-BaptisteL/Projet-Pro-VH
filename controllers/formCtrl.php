<?php
//Création d'un tableau qui va contenir les messages d'erreurs.
$errorMessages = array();
//Vérification du formulaire :
//Si le bouton d'inscription a été pressé :
if (isset($_POST['addNewUser'])) {
    //On instancie la classe.
    $users = new users();
    /*
     * Si l'input "pseudo" n'est pas vide alors on donne la valeur de l'input à l'attribut de la classe
     * en utilisant htmlspecialchars qui désactive les caractères spéciaux et évite les inclusions de code malveillant.
     * Sinon on ajoute un message d'erreur au tableau.
     */
    if (!empty($_POST['pseudo'])) {
        $users->name = htmlspecialchars($_POST['pseudo']);
    } else {
        $errorMessages['pseudo'] = 'Veuillez entrer un nom d\'utilisateur';
    }
    /*
     * Si les inputs "email" et "confirmEmail" ne sont pas vides,
     * alors je vérifie s'il s'agit bien d'une adresse mail grâce à un filter_var
     * puis je vérifie si l'adresse mail et sa confirmation sont identiques.
     * Si c'est bon, je donne la valeur de l'input "email" à l'attribut de la classe.
     * Sinon j'ajoute un message d'erreur.
     */
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
    /*
     * Si les inputs "password" et "confirmPassword" ne sont pas vides,
     * alors je les compare entre eux. S'ils sont identique, je donne la valeur de l'input "password"
     * à l'attribut de la classe après l'avor hashé à l'aide de password_hash. Sinon j'ajoute un message d'erreur.
     */
    if (!empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
        if ($_POST['password'] == $_POST['confirmPassword']) {
            $users->password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT);
        } else {
            $errorMessages['confirmPassword'] = 'Les deux mots de passe ne sont pas identiques.';
        }
    } else {
        $errorMessages['confirmPassword'] = $errorMessages['password'] = 'Veuillez entrer un mot de passe et le confirmer.';
    }
    /*
     * S'il n'y a pas de message d'erreur, alors je vérifie si l'utilisateur n'existe pas déjà.
     * S'il existe, j'écrit un message d'erreur dans le tableau prévu à cet effet.
     * Si ce n'est pas le cas, je crée un hash qui servira à la validation de l'adresse mail
     * et j'enregistre le nouvel utilisateur.
     */
    if (count($errorMessages) == 0) {
        $user = $users->checkIfUserExists();
        if ($user->userExists == 0) {
            //Création du hash.
            //Grâce à une boucle, je crée un tableau contenant toute les lettres de l'alphabet en minuscule.
            $letter = 'a';
            $lettersMin = array();
            for ($i = 1; $i <= 26; $i++) {
                $lettersMin[] = $letter;
                $letter++;
            }
            /*
             * Je crée ensuite un tableau de lettres majuscules avec à la fonction array_map qui met en majuscule toutes
             * les lettres du tableau $lettersMin grâce à strtoupper.
             * Je crée aussi un tableau contenant des caractères spéciaux et un tableau de chiffres.
             */
            $lettersMax = array_map('strtoupper', $lettersMin);
            $specialCharacters = array('$', 'ù', '%', '£', 'µ', '#', 'é', '&', 'è', 'ç', 'à', '<', '>', '§');
            $numbers = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
            //Je rassemble ensuite ces tableau en un seul à l'aide de array_merge.
            $charactersArray = array_merge($lettersMin, $lettersMax, $specialCharacters, $numbers);
            /*
             * Je crée le hash à l'aide d'une boucle qui mélange le tableau de caractères,
             * prend un caractère au hasard et l'ajoute au hash.
             */
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
