<?php
class ab0yz_inscriptionsYear {

    public $id = 0;
    public $years = '2018';
    public $medicalCertificate = '';
    public $numberPayment = 0;
    public $id_ab0yz_paiementTypes = 0;
    private $db;

    public function __construct() {
        $database = dataBase::getInstance();
        $this->db = $database->db;
    }

    public function inscriptionYear() {
        $query = 'INSERT INTO `ab0yz_inscriptionsYear`(`years`, `medicalCertificate`, `numberPayment`, `id_ab0yz_paiementTypes`) VALUES (:years, :medicalCertificate, :numberPayment, :id_ab0yz_paiementTypes)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':years', $this->years, PDO::PARAM_STR);
        $queryResult->bindValue(':medicalCertificate', $this->medicalCertificate, PDO::PARAM_STR);
        $queryResult->bindValue(':numberPayment', $this->numberPayment, PDO::PARAM_INT);
        $queryResult->bindValue(':id_ab0yz_paiementTypes', $this->id_ab0yz_paiementTypes, PDO::PARAM_INT);
        return $queryResult->execute();
    }

}
?>

