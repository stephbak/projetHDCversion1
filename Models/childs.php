<?php

class ab0yz_childs {

    public $id = 0;
    public $firstname = '';
    public $lastname = '';
    public $birthDate = '2000-01-01';
    public $imageLaw = 0;
    public $id_ab0yz_users = 0;
    public $id_ab0yz_genre = 0;
    public $id_ab0yz_groups = 0;
    public $id_ab0yz_inscriptionsYear = 0;
    private $db;

    public function __construct() {
        $database = dataBase::getInstance();
        $this->db = $database->db;
    }

    public function createChild() {
        $query = 'INSERT INTO `ab0yz_childs`(`firstname`, `lastname`, `birthDate`, `imageLaw`, `id_ab0yz_users`, `id_ab0yz_genre`, `id_ab0yz_groups`, `id_ab0yz_inscriptionsYear`) VALUES(:firstname, UPPER(:lastname), :birthDate, :imageLaw, :id_ab0yz_users, :id_ab0yz_genre, :id_ab0yz_groups, :id_ab0yz_inscriptionsYear)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':firstname', ucfirst(strtolower($this->firstname)), PDO::PARAM_STR);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryResult->bindValue(':birthDate', strftime($this->birthDate), PDO::PARAM_STR);
        $queryResult->bindValue(':imageLaw', $this->imageLaw, PDO::PARAM_INT);
        $queryResult->bindValue(':id_ab0yz_users', $this->id_ab0yz_users, PDO::PARAM_INT);
        $queryResult->bindValue(':id_ab0yz_genre', $this->id_ab0yz_genre, PDO::PARAM_INT);
        $queryResult->bindValue(':id_ab0yz_groups', $this->id_ab0yz_groups, PDO::PARAM_INT);
        $queryResult->bindValue(':id_ab0yz_inscriptionsYear', $this->id_ab0yz_inscriptionsYear, PDO::PARAM_INT);
        
        return $queryResult->execute();
    }

}
?>

