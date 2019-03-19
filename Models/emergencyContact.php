<?php
class ab0yz_emergencyContact {

    public $id = 0;
    public $firstname = '';
    public $lastname = '';
    public $phone = '';
    public $id_ab0yz_childs = 0;
    private $db;

    public function __construct() {
        $database = dataBase::getInstance();
        $this->db = $database->db;
    }

    public function createEmergencyContact() {
        $query = 'INSERT INTO `ab0yz_emergencyContact`(`id`, `lastname`, `firstname`, `phone`, `id_ab0yz_childs`) VALUES(:id, UPPER(:lastname), :firstname, :phone, :id_ab0yz_childs)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryResult->bindValue(':firstname', ucfirst(strtolower($this->firstname)), PDO::PARAM_STR);
        $queryResult->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryResult->bindValue(':id_ab0yz_childs', $this->id_ab0yz_childs, PDO::PARAM_INT);
        return $queryResult->execute();
    }

}
?>

