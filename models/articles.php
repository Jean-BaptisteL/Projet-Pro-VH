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
    public function addNewArticle(){
        $query = 'INSERT INTO `zui5e_articles` (`title`, `content`, `date`, `id_zui5e_users`, `id__zui5e_articleType`) '
                . 'VALUES (:title, :content, NOW() , :id_users, :id_articleType)';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':title', $this->title, PDO::PARAM_STR);
        $statement->bindValue(':content', $this->content, PDO::PARAM_STR);
        $statement->bindValue(':id_users', $this->$idUsers, PDO::PARAM_INT);
        $statement->bindValue(':id_articleType', $this->$idArticleType, PDO::PARAM_INT);
        return $statement->execute();
    }
}
