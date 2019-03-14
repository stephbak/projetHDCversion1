<?php

class userStatus {

    public $id = 0;
    public $id_ab0yz_users = 0;
    public $id_ab0yz_status = 0;
    private $db;

    public function __construct() {
        $database = dataBase::getInstance();
        $this->db = $database->db;
    }

    public function insertUserStatus() {
        $query = 'INSERT INTO `ab0yz_userStatus` (`id_ab0yz_users`, `id_ab0yz_status`) VALUES(:id_ab0yz_users, :id_ab0yz_status)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id_ab0yz_users', $this->id_ab0yz_users, PDO::PARAM_INT);
        $queryResult->bindValue(':id_ab0yz_status', $this->id_ab0yz_status, PDO::PARAM_INT);
        return $queryResult->execute();
    }

}
