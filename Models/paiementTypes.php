<?php

class ab0yz_paiementTypes {

    public $id = 0;
    public $type = 0;
    private $db;

    public function __construct() {
        $database = dataBase::getInstance();
        $this->db = $database->db;
    }

    /**
     * Méthode permettant de récupérer la liste des types de paiement
     */
    public function paiementTypesList() {
        $query = 'SELECT `id`, `type` FROM `ab0yz_paiementTypes`';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

}
