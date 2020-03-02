<?php
include_once 'models/database.php';
class users {
    
    public $id = 0;
    public $name = '';
    public $email = '';
    public $password = '';
    public $usersTypeId = 0;
    public $db = NULL;
    
    public function __construct() {
        $this->db = database::getInstance();
    }
}
