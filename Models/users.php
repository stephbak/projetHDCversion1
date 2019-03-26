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
     * @return array
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
     * @return array
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
     * @return array
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
     * @return array
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
     * @return array
     */
    public function deleteUser() {
        $query = 'DELETE FROM `ab0yz_users` WHERE `id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }



}
?>

