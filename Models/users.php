<?php

class users {

    public $id = 0;
    public $firstname = '';
    public $lastname = '';
    public $phone = '';
    public $mail = 0;
    public $password = '';
    public $creationDate = '1900-01-01';
    public $interieurRules = 0;
    public $cguChecked = 0;
    private $db;

    //on rappel la fonction du model dataBase
    public function __construct() {
        $database = dataBase::getInstance();
        $this->db = $database->db;
    }

    /**
     * Méthode qui sert à insérer les données du user lors de son inscription
     * @return booléen
     */
    public function createUser() {// : lastname = marqueur nominatif
        $caracSuppr = array('-', ' ', '.');
        $query = 'INSERT INTO `ab0yz_users` ( `id`, `lastname`, `firstname`, `phone`, `mail`, `password`, `creationDate`, `interieurRules`, `cguChecked`) VALUES (:id, UPPER(:lastname), :firstname, :phone, :mail, :password, DATE(NOW()), :interieurRules, :cguChecked)';
        $queryResult = $this->db->prepare($query); //On prépare la requête avec des valeurs inconnues
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR); //On insére des données au moment de la validation du formulaire
        $queryResult->bindValue(':firstname', ucfirst(strtolower($this->firstname)), PDO::PARAM_STR); //transforme la chaine en minuscule et la premiére lettre en majuscule
        $queryResult->bindValue(':phone', str_replace($caracSuppr, '', $this->phone), PDO::PARAM_STR); //remplace les . - par une chaine vide
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryResult->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryResult->bindValue(':interieurRules', $this->interieurRules, PDO::PARAM_BOOL);
        $queryResult->bindValue(':cguChecked', $this->cguChecked, PDO::PARAM_BOOL);
        return $queryResult->execute(); //on éxécute la méthode
    }

    /**
     * Vérification dans la table user si le mail est déjà existant au moment de l'inscription
     * @return booléen
     */
    public function checkIfMailExist() {
        $result = false;
        $query = 'SELECT COUNT(mail) AS `existMail` FROM `ab0yz_users` WHERE `mail` = :mail';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        if ($queryResult->execute()) {
            $result = $queryResult->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * Méthode permettant au user de pouvoir lire ses données
     * @return array
     */
    public function userConnection() {
        $state = false;
        $query = 'SELECT `ab0yz_users`.`id`, `lastname`, `firstname`, `phone`, `mail`, `password`, `creationDate`, `interieurRules`, `cguChecked`, `ab0yz_userStatus`.`id_ab0yz_status` FROM `ab0yz_users` INNER JOIN `ab0yz_userStatus` ON `ab0yz_userStatus`.`id_ab0yz_users` = `ab0yz_users`.`id` WHERE `mail` = :mail';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        if ($queryResult->execute()) {
            $result = $queryResult->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * Méthode permettant au user de modifier ses données
     * @return booléen
     */
    public function updateUser() {
        $caracSuppr = array('-', ' ', '.');
        $query = 'UPDATE `ab0yz_users` SET `lastname`= (UPPER(:lastname)), `firstname`= :firstname, `phone`= :phone, `mail`= :mail WHERE `id`= :id';
        $queryResult = $this->db->prepare($query); //On prépare la requête avec des valeurs inconnues
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR); //On insére des données au moment de la validation du formulaire
        $queryResult->bindValue(':firstname', ucfirst(strtolower($this->firstname)), PDO::PARAM_STR); //transforme la chaine en minuscule et la premiére lettre en majuscule
        $queryResult->bindValue(':phone', str_replace($caracSuppr, '', $this->phone), PDO::PARAM_STR); //remplace les . - par une chaine vide
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $queryResult->execute(); //on éxécute la méthode
    }

    /**
     * Méthode permettant au user de modifier son mot de passe
     * @return booléen
     */
    public function updatePassword() {
        $query = 'UPDATE `ab0yz_users` SET `password`= :password WHERE `id` = :id';
        $queryResult = $this->db->prepare($query); //On prépare la requête avec des valeurs inconnues
        $queryResult->bindValue(':password', $this->password, PDO::PARAM_STR); //On insére des données au moment de la validation du formulaire
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute(); //on éxécute la méthode
    }

    /**
     * Méthode permettant au user de supprimer son compte
     * @return booléen
     */
    public function deleteUser() {
        $query = 'DELETE FROM `ab0yz_users` WHERE `id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * Méthode permettant au user lire ses informations
     * @return array
     */
    public function userInfo() {
        $state = false;
        $query = 'SELECT `id`, `lastname`, `firstname`, `phone`, `mail` FROM `ab0yz_users`';
        $queryResult = $this->db->query($query);
        return $queryResult->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    /**
     * Méthode permettant à l'admin de lire les infos d'un user en fonction de son ID
     * @return array
     */
    public function getUserInfoByIdUser() {
        $query = 'SELECT `id`, `lastname`, `firstname`, `phone`, `mail` FROM `ab0yz_users` WHERE `id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        return $queryResult->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Méthode permettant à l'admin de modifier les informations d'un user
     * @return booléen
     */
    public function updateUserInfo() {
        $caracSuppr = array('-', ' ', '.');
        $query = 'UPDATE `ab0yz_users` SET `lastname`= (UPPER(:lastname)), `firstname`= :firstname, `phone`= :phone, `mail`= :mail WHERE id= :id';
        $queryResult = $this->db->prepare($query); //On prépare la requête avec des valeurs inconnues
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR); //On insére des données au moment de la validation du formulaire
        $queryResult->bindValue(':firstname', ucfirst(strtolower($this->firstname)), PDO::PARAM_STR); //transforme la chaine en minuscule et la premiére lettre en majuscule
        $queryResult->bindValue(':phone', str_replace($caracSuppr, '', $this->phone), PDO::PARAM_STR); //remplace les . - par une chaine vide
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $queryResult->execute(); //on éxécute la méthode
    }

    /**
     * Méthode permettant à l'admin de lire les informations d'un enfant en fonction de l'ID de son parent
     * @return array
     */
    public function getChildInfoByIdUser() {
        $query = 'SELECT `ab0yz_childs`.`id`, `ab0yz_childs`.`lastname`, `ab0yz_childs`.`firstname`, DATE_FORMAT(`ab0yz_childs`.`birthDate`, \'%d-%m-%Y\') AS `birthDate`, CASE WHEN `ab0yz_childs`.`imageLaw` = 1 THEN \'Oui\' ELSE \'Non\' END AS `imageLaw`, CASE WHEN `ab0yz_childs`.`id_ab0yz_genre` = 1 THEN \'Garçon\' ELSE \'Fille\' END AS `id_ab0yz_genre` FROM `ab0yz_childs` INNER JOIN `ab0yz_users` ON `ab0yz_childs`.`id_ab0yz_users` = `ab0yz_users`.`id` WHERE `ab0yz_users`.`id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode permettant à l'admin de supprimer un user
     * @return booléen
     */
    public function deleteUserByAdmin() {
        $query = 'DELETE FROM `ab0yz_users` WHERE `id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

}
?>

