<?php

include_once 'models/database.php';

class users {

    public $id = 0;
    public $name = '';
    public $email = '';
    public $password = '';
    public $hash = '';
    public $usersTypesId = 1;
    public $db = NULL;

    public function __construct() {
        $this->db = database::getInstance();
    }

    /**
     * Méthode permettant d'enregistrer un nouvel utilisateur
     * @return bool
     */
    public function addNewUser() {
        $query = 'INSERT INTO `zui5e_users` (`name`, `email`, `password`, `hash`, `id_zui5e_usersTypes`) '
                . 'VALUES (:name, :email, :password, :hash, :usersTypesId)';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $statement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $statement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $statement->bindValue(':hash', $this->hash, PDO::PARAM_STR);
        $statement->bindValue(':usersTypesId', $this->usersTypesId, PDO::PARAM_INT);
        return $statement->execute();
    }

    /**
     * Méthode permettant de vérifier si un utilisateur existe
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


}
