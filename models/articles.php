<?php

include_once 'models/database.php';

class articles {

    public $id = 0;
    public $title = '';
    public $content = '';
    public $date = '2020-03-31';
    public $idUsers = 0;
    public $idArticleType = 0;
    public $db = NULL;

    public function __construct() {
        $this->db = database::getInstance();
    }

    /**
     * Méthode permettant d'enregistrer un nouvel article.
     * @return BOOL
     */
    public function addNewArticle() {
        $query = 'INSERT INTO `zui5e_articles` (`title`, `content`, `date`, `id_zui5e_users`, `id__zui5e_articleType`) '
                . 'VALUES (:title, :content, NOW() , :idUsers, :idArticleType)';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':title', $this->title, PDO::PARAM_STR);
        $statement->bindValue(':content', $this->content, PDO::PARAM_STR);
        $statement->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
        $statement->bindValue(':idArticleType', $this->idArticleType, PDO::PARAM_INT);
        return $statement->execute();
    }

    /**
     * Méthode permettant de sélectionner les 5 derniers articles.
     * @return OBJ
     */
    public function showAllArticles() {
        $query = 'SELECT SQL_CALC_FOUND_ROWS `zui5e_articles`.`id`, `title`, DATE_FORMAT(`date`, \'%d/%m/%Y\') AS `publicationDate`, `zui5e_users`.`name` AS `userName`, `zui5e_articleType`.`type` AS `articleType` '
                . 'FROM `zui5e_articles` '
                . 'LEFT JOIN `zui5e_articleType` ON `id__zui5e_articleType` = `zui5e_articleType`.`id` '
                . 'LEFT JOIN  `zui5e_users` ON `id_zui5e_users` = `zui5e_users`.`id` '
                . 'ORDER BY `id` DESC '
                . 'LIMIT 5';
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode permettant d'obtenir le nombre de d'articles enregistré.
     * @return COL
     */
    public function getNumberOfArticles() {
        $query = 'SELECT found_rows()';
        $request = $this->db->query($query);
        return $request->fetchColumn();
    }
    
    /**
     * Méthode permettant de sélectionner tous les articles d'un type.
     * @param INT $offset
     * @return OBJ
     */
    public function showArticlesByTypes($offset) {
        $query = 'SELECT SQL_CALC_FOUND_ROWS `zui5e_articles`.`id`, `title`, DATE_FORMAT(`date`, \'%d/%m/%Y\') AS `publicationDate`, `zui5e_users`.`name` AS `userName`, `zui5e_articleType`.`type` AS `articleType` '
                . 'FROM `zui5e_articles` '
                . 'LEFT JOIN `zui5e_articleType` ON `id__zui5e_articleType` = `zui5e_articleType`.`id` '
                . 'LEFT JOIN  `zui5e_users` ON `id_zui5e_users` = `zui5e_users`.`id` '
                . 'WHERE `id__zui5e_articleType` = :idArticleType '
                . 'ORDER BY `id` DESC '
                . 'LIMIT 10 OFFSET :offset';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':idArticleType', $this->idArticleType, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode permettant de sélectionner un article.
     * @return 
     */
    public function getArticle() {
        $query = 'SELECT `title`, `content`, DATE_FORMAT(`date`, \'%d/%m/%Y\') AS `publicationDate`, `zui5e_users`.`name` AS `userName`, `zui5e_articleType`.`type` AS `articleType` '
                . 'FROM `zui5e_articles` '
                . 'LEFT JOIN `zui5e_articleType` ON `id__zui5e_articleType` = `zui5e_articleType`.`id` '
                . 'LEFT JOIN  `zui5e_users` ON `id_zui5e_users` = `zui5e_users`.`id` '
                . 'WHERE `zui5e_articles`.`id` = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
}
