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

    /*
     * 
     */

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

    public function emergencyContactInfoByIdChild() {
        $query = 'SELECT `ab0yz_emergencyContact`.`id`, `ab0yz_emergencyContact`.`lastname`, `ab0yz_emergencyContact`.`firstname`, `ab0yz_emergencyContact`.`phone` FROM `ab0yz_emergencyContact` INNER JOIN `ab0yz_childs` ON `ab0yz_childs`.`id` = `ab0yz_emergencyContact`.`id_ab0yz_childs` WHERE `ab0yz_emergencyContact`.`id_ab0yz_childs` = :idChild';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':idChild', $this->id_ab0yz_childs, PDO::PARAM_INT);
        $queryResult->execute();
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

}
?>

