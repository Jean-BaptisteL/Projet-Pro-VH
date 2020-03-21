<?php

include_once 'models/database.php';

class users {
    //On crée les attributs de la classe. Un attribut pour chaque champ de la table qui est rattachée à ce modèle.
    public $id = 0;
    public $name = '';
    public $email = '';
    public $password = '';
    public $hash = '';
    public $usersTypesId = 1;
    public $db = NULL;
    //On appelle la méthode de la classe database.
    public function __construct() {
        $this->db = database::getInstance();
    }

    /**
     * Méthode permettant d'enregistrer un nouvel utilisateur.
     * @return BOOL
     */
    public function addNewUser() {
        $query = 'INSERT INTO `zui5e_users` (`name`, `email`, `password`, `hash`, `id_zui5e_usersTypes`) '
                . 'VALUES (:name, :email, :password, :hash, :usersTypesId)';
        /*
         * Je prépare la requête et j'associe les valeurs des attributs de la classe à des marqueurs nominatifs
         * grâce à bindValue. De plus bindValue empèche les inclusions SQL malveillantes
         */
        $statement = $this->db->prepare($query);
        $statement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $statement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $statement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $statement->bindValue(':hash', $this->hash, PDO::PARAM_STR);
        $statement->bindValue(':usersTypesId', $this->usersTypesId, PDO::PARAM_INT);
        //J'execute la requête.
        return $statement->execute();
    }

    /**
     * Méthode permettant de vérifier si un utilisateur existe déjà.
     * @return OBJ
     */
    public function checkIfUserExists() {
        $query = 'SELECT COUNT(`id`) AS `userExists` FROM `zui5e_users` '
                . 'WHERE `name` = :name OR `email` = :email';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $statement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Méthode permettant de récupérer les informations d'un utilisateur
     * afin de créer une variable superglobale $_SESSION contenant les informations.
     * @return OBJ
     */
    public function getUserInfos() {
        $query = 'SELECT `id`, `name`, `password`, `email`, `id_zui5e_usersTypes` AS `userTypeId` FROM `zui5e_users` '
                . 'WHERE `name` = :name OR `email` = :email';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $statement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Methode permettant de modifier les informations d'un utilisateur
     * @return BOOL
     */
    public function updateUserInfos() {
        $query = 'UPDATE `zui5e_users` '
                . 'SET `name` = :name, `email` = :email '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $statement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $statement->execute();
    }
    
    /**
     * Methode permettant de modifier le mot de passe d'un utilisateur
     * @return BOOL
     */
    public function updatePassword() {
        $query = 'UPDATE `zui5e_users` '
                . 'SET `password` = :password '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $statement->execute();
    }
    
    /**
     * Méthode permettant de savoir si un nom d'utilisateur existe déjà.
     * @return OBJ
     */
    public function checkIfUserNameExists() {
        $query = 'SELECT COUNT(`id`) AS `userNameExists` FROM `zui5e_users` '
                . 'WHERE `name` = :name';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de savoir si une adresse mail existe déjà.
     * @return OBJ
     */
    public function checkIfEmailExists() {
        $query = 'SELECT COUNT(`id`) AS `emailExists` FROM `zui5e_users` '
                . 'WHERE `email` = :email';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de supprimer un utilisateur.
     * @return BOOL
     */
    public function deleteUser() {
        $query = 'DELETE FROM `zui5e_users` '
                . 'WHERE `id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $statement->execute();
    }
}
