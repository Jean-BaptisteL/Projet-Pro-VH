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
     * Méthode permettant de sélectionner tous les articles.
     * @return OBJ
     */
    public function showAllArticles() {
        $query = 'SELECT SQL_CALC_FOUND_ROWS `title`, `content`, `date`, `zui5e_users`.`name`, `id__zui5e_articleType` '
                . 'FROM `zui5e_articles` '
                . 'INNER JOIN  `zui5e_users` ON `id_zui5e_users` = `zui5e_users`.`id` '
                . 'ORDER BY `id` DESC '
                . 'LIMIT :limite OFFSET :offset';
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

}
