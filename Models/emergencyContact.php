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

    /**
     * Méthode permettant de remplir la table emergencyContact au moment de l'inscription d'un enfant
     * @return booléen
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

    /**
     * Méthode permettant de lire les infos du contact d'urgence en fonction de l'Id de l'enfant
     * @return array
     */
    public function emergencyContactInfoByIdChild() {
        $query = 'SELECT `ab0yz_emergencyContact`.`id`, `ab0yz_emergencyContact`.`lastname`, `ab0yz_emergencyContact`.`firstname`, `ab0yz_emergencyContact`.`phone` FROM `ab0yz_emergencyContact` INNER JOIN `ab0yz_childs` ON `ab0yz_childs`.`id` = `ab0yz_emergencyContact`.`id_ab0yz_childs` WHERE `ab0yz_emergencyContact`.`id_ab0yz_childs` = :idChild';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':idChild', $this->id_ab0yz_childs, PDO::PARAM_INT);
        $queryResult->execute();
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode permettant de lire les infos d'un contact d'urgence en fonction de son ID
     * @return array
     */
    public function emergencyContactInfo() {
        $query = 'SELECT `id`, `lastname`, `firstname`, `phone` FROM `ab0yz_emergencyContact` WHERE `id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        return $queryResult->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Méthode permettant à l'admin de modifier les infos d'un contact d'urgence en fonction de son ID
     * @return booléen
     */
    public function updateEmergencyContactInfo() {
        $caracSuppr = array('-', ' ', '.');
        $query = 'UPDATE `ab0yz_emergencyContact` SET `lastname`= (UPPER(:lastname)), `firstname`= :firstname, `phone`= :phone WHERE id= :id';
        $queryResult = $this->db->prepare($query); //On prépare la requête avec des valeurs inconnues
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR); //On insére des données au moment de la validation du formulaire
        $queryResult->bindValue(':firstname', ucfirst(strtolower($this->firstname)), PDO::PARAM_STR); //transforme la chaine en minuscule et la premiére lettre en majuscule
        $queryResult->bindValue(':phone', str_replace($caracSuppr, '', $this->phone), PDO::PARAM_STR); //remplace les . - par une chaine vide
        return $queryResult->execute(); //on éxécute la méthode
    }

}
?>

