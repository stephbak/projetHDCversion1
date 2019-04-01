<?php

class ab0yz_genre {

    public $id = 0;
    public $genre = 0;
    private $db;

    public function __construct() {
        $database = dataBase::getInstance();
        $this->db = $database->db;
    }

    /**
     * Méthode permettant de récupérer la liste des types de paiement
     */
    public function genreList() {
        $query = 'SELECT `id`, `genre` FROM `ab0yz_genre`';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

}
?>

