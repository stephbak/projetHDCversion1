<?php

class dataBase {

    public $db;
    private static $_instance;

    protected function __construct() {

        try {
            $this->db = new PDO('mysql:host=localhost;dbname=HappyDanceClub; charset=utf8', 'stephanebakum', 'hdclub');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * onrécupère l'instance de la classe
     * @return database
     */
    //ont définie une fonction qui ne bougera pas et qu'on appellera dans les autres modeles
    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __destruct() {
        $db = NULL;
    }

}
?>

