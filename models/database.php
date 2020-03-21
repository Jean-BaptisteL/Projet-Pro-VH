<?php
class database {
    public $db = NULL;
    private static $instance = NULL;
    
    /**On crée un objet PDO qui représente une connexion à la base de données.
     * Si la connexion échoue, une erreur est retournée grâce au try catch.
     */
    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost:3308;dbname=projetdrone;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $ex) {
            die('Une erreur au niveau de la base de donnée s\'est produite ! -> ' . $ex->getMessage());
        }
    }
    /**
     * Méthode qui permet de récupérer l'instance PDO si elle existe sinon,
     * elle en crée une.
     * @return objet
     */
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new database();
        }
        return self::$instance->db;
    }
}
