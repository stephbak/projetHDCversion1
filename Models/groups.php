<?php

class ab0yz_groups {

    public $id = 0;
    public $group = 0;
    private $db;

    public function __construct() {
        $database = dataBase::getInstance();
        $this->db = $database->db;
    }

    /**
     * Méthode permettant de récupérer la liste des types de paiement
     */
    public function groupsList() {
        $query = 'SELECT `id`, `group` FROM `ab0yz_groups`';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

}
