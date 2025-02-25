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

    /**
     * Méthode permettant d'insérer dans la table childs les infos renseignés par l'utilisateur lors de l'inscription d'un enfant
     * @return booléen
     */
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

    /**
     * Méthode permettant à l'admin de lire les données de tous les enfants inscrits
     * @return array
     */
    public function getChildsList() {
        $query = 'SELECT `id`, `firstname`, `lastname`, DATE_FORMAT(`birthDate`, \'%d-%m-%Y\') AS `birthDate`, FLOOR(DATEDIFF(NOW(), `birthDate`)/ 365) AS `age`, CASE WHEN `imageLaw` = 1 THEN \'Oui\' ELSE \'Non\' END AS `imageLaw`, CASE WHEN `id_ab0yz_genre` = 1 THEN \'Garçon\' ELSE \'Fille\' END AS `id_ab0yz_genre`, CASE WHEN `id_ab0yz_groups` = 1 THEN \'Petits\' WHEN `id_ab0yz_groups` = 2 THEN \'Moyens\' ELSE \'Grands\' END AS `id_ab0yz_groups` FROM `ab0yz_childs` ORDER BY `lastname`';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode permettant à l'admin de lire les infos concernant un enfant en fonction de son ID
     * @return array
     */
    public function getChildInfoById() {
        $query = 'SELECT `id`, `firstname`, `lastname`, DATE_FORMAT(`birthDate`, \'%d-%m-%Y\') AS `birthDate`, FLOOR(DATEDIFF(NOW(), `birthDate`)/ 365) AS `age`, CASE WHEN `imageLaw` = 1 THEN \'Oui\' ELSE \'Non\' END AS `imageLaw`, CASE WHEN `id_ab0yz_genre` = 1 THEN \'Garçon\' ELSE \'Fille\' END AS `id_ab0yz_genre`, CASE WHEN `id_ab0yz_groups` = 1 THEN \'Petits\' WHEN `id_ab0yz_groups` = 2 THEN \'Moyens\' ELSE \'Grands\' END AS `id_ab0yz_groups` FROM `ab0yz_childs` WHERE `id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        return $queryResult->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Méthode permettant de lire les infos d'un parent en fonction de l'ID de l'enfant
     * @return array
     */
    public function userInfoByIdChild() {
        $query = 'SELECT `ab0yz_users`.`id`, `ab0yz_users`.`lastname`, `ab0yz_users`.`firstname`, `ab0yz_users`.`phone`, `ab0yz_users`.`mail` FROM `ab0yz_users` INNER JOIN `ab0yz_childs` ON `ab0yz_childs`.`id_ab0yz_users` = `ab0yz_users`.`id` WHERE `ab0yz_childs`.`id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        return $queryResult->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Méthode permettant de lire les infos d'un contact d'urgence en fonction de l'ID de l'enfant
     * @return array
     */
    public function inscriptionYearInfoByIdChild() {
        $query = 'SELECT `ab0yz_inscriptionsYear`.`id`, `ab0yz_inscriptionsYear`.`years`, `ab0yz_inscriptionsYear`.`medicalCertificate`, `ab0yz_inscriptionsYear`.`numberPayment`,`ab0yz_paiementTypes`.`type` FROM `ab0yz_inscriptionsYear` INNER JOIN `ab0yz_paiementTypes` ON `ab0yz_paiementTypes`.`id` = `ab0yz_inscriptionsYear`.`id_ab0yz_paiementTypes` INNER JOIN `ab0yz_childs` ON `ab0yz_childs`.`id_ab0yz_inscriptionsYear` = `ab0yz_inscriptionsYear`.`id` WHERE `ab0yz_childs`.`id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        return $queryResult->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Méthode permettant de modifier les informations d'un enfant
     * @return booléen
     */
    public function updateChild() {
        $caracSuppr = array('-', ' ', '.');
        $query = 'UPDATE `ab0yz_childs` SET `lastname`= (UPPER(:lastname)), `firstname`= :firstname, `birthDate`= :birthDate, `imageLaw` = :imageLaw, `id_ab0yz_genre` = :id_ab0yz_genre WHERE `id`= :id';
        $queryResult = $this->db->prepare($query); //On prépare la requête avec des valeurs inconnues
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR); //On insére des données au moment de la validation du formulaire
        $queryResult->bindValue(':firstname', ucfirst(strtolower($this->firstname)), PDO::PARAM_STR); //transforme la chaine en minuscule et la premiére lettre en majuscule
        $queryResult->bindValue(':birthDate', strftime($this->birthDate), PDO::PARAM_STR); //remplace les . - par une chaine vide
        $queryResult->bindValue(':imageLaw', $this->imageLaw, PDO::PARAM_INT);
        $queryResult->bindValue(':id_ab0yz_genre', $this->id_ab0yz_genre, PDO::PARAM_INT);
        return $queryResult->execute(); //on éxécute la méthode
    }

}
?>

