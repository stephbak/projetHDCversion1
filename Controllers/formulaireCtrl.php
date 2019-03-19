<?php

$regexText = '/^[a-zéèàêâùïüëA-Z- \']+$/';
$regexPhone = '/^0[1-9]([-. ]?[0-9]{2}){4}$/';
$regexBirthDate = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
$formError = array();
$success = false;
$genre = new ab0yz_genre();
$genreList = $genre->genreList();
$paiementTypes = new ab0yz_paiementTypes();
$paiementTypesList = $paiementTypes->paiementTypesList();

if (isset($_POST['submit'])) {
    if (!empty($_POST['lastname'])) {
        if (preg_match($regexText, $_POST['lastname'])) {
            $lastname = htmlspecialchars($_POST['lastname']);
        } else {
            $formError['lastname'] = 'Veuillez rentrer un nom valide.';
        }
    } else {
        //si c'est vide on affiche le msg d'erreur suivant :
        $formError['lastname'] = 'Veuillez entrer votre nom.';
    }
    if (!empty($_POST['firstname'])) {
        if (preg_match($regexText, $_POST['firstname'])) {
            $firstname = htmlspecialchars($_POST['firstname']);
        } else {
            $formError['firstname'] = 'Veuillez rentrer un prénom valide.';
        }
    } else {
        $formError['firstname'] = 'Veuillez entrer votre prénom.';
    }
    if (!empty($_POST['birthDate'])) {
        if (preg_match($regexBirthDate, $_POST['birthDate'])) {
            $birthDate = htmlspecialchars($_POST['birthDate']);
        } else {
            $formError['birthDate'] = 'Veuillez rentrer une date de naissance valide.';
        }
    } else {
        $formError['birthDate'] = 'Veuillez entrer votre date de naissance.';
    }

    if (!empty($_POST['genre'])) {
        $genre = $_POST['genre'];
    } else {
        $formError['genre'] = 'Veuillez indiquer votre choix';
    }
    if (!empty($_POST['emergencyLastname'])) {
        if (preg_match($regexText, $_POST['emergencyLastname'])) {
            $emergencyLastname = htmlspecialchars($_POST['emergencyLastname']);
        } else {
            $formError['emergencyLastname'] = 'Veuillez rentrer un nom valide.';
        }
    } else {
        $formError['emergencyLastname'] = 'Veuillez entrer votre nom.';
    }
    if (!empty($_POST['emergencyFirstname'])) {
        if (preg_match($regexText, $_POST['emergencyFirstname'])) {
            $emergencyFirstname = htmlspecialchars($_POST['emergencyFirstname']);
        } else {
            $formError['emergencyFirstname'] = 'Veuillez rentrer un prénom valide.';
        }
    } else {
        $formError['emergencyFirstname'] = 'Veuillez entrer votre prénom.';
    }
    if (!empty($_POST['emergencyPhone'])) {
        if (preg_match($regexPhone, $_POST['emergencyPhone'])) {
            $emergencyPhone = htmlspecialchars($_POST['emergencyPhone']);
        } else {
            $formError['emergencyPhone'] = 'Veuillez rentrer un N° de téléphone valide.';
        }
    } else {
        $formError['emergencyPhone'] = 'Veuillez entrer un N) de téléphone.';
    }

    if (!empty($_POST['imageLaw'])) {
        $imageLaw = $_POST['imageLaw'];
    } else {
        $formError['imageLaw'] = 'Veuillez indiquer votre choix';
    }
    if (!empty($_POST['paymentNumber'])) {
        $paymentNumber = intval($_POST['paymentNumber']);
    } else {
        $formError['paymentNumber'] = 'Veuillez indiquer votre choix';
    }
    if (!empty($_POST['paymentType'])) {
        $paymentType = intval($_POST['paymentType']);
    } else {
        $formError['paymentType'] = 'Veuillez indiquer votre choix';
    }
//    var_dump($paymentType);
    if (count($formError) == 0) {
//        
        $inscriptionsYear = new ab0yz_inscriptionsYear();

        $inscriptionsYear->years = 2018;
        $inscriptionsYear->medicalCertificate = NULL;
        $inscriptionsYear->numberPayment = $paymentNumber;
        $inscriptionsYear->id_ab0yz_paiementTypes = $paymentType;

        $childs = new ab0yz_childs();
        $age = (time() - strtotime($birthDate)) / 3600 / 24 / 365;

        if ($age >= 3 && $age <= 6) {
            $childs->id_ab0yz_groups = 1;
        } elseif ($age > 6 && $age <= 10) {
            $childs->id_ab0yz_groups = 2;
        } elseif ($age > 10) {
            $childs->id_ab0yz_groups = 3;
        }

        $database = dataBase::getInstance();
        $database->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $database->db->beginTransaction();
            if ($inscriptionsYear->inscriptionYear()) {
//            if ($childs->createChild()) {
                $success = true;

                $childs->firstname = $firstname;
                $childs->lastname = $lastname;
                $childs->birthDate = $birthDate;
                $childs->imageLaw = $imageLaw;
                $childs->id_ab0yz_users = $_SESSION['id'];
                $childs->id_ab0yz_genre = $genre;
                $childs->id_ab0yz_inscriptionsYear = $database->db->lastInsertId();
                $childs->createChild();
                $emergencyContact = new ab0yz_emergencyContact();
                $emergencyContact->firstname = $_POST['emergencyFirstname'];
                $emergencyContact->lastname = $_POST['emergencyLastname'];
                $emergencyContact->phone = $_POST['emergencyPhone'];
                $emergencyContact->id_ab0yz_childs = $database->db->lastInsertId();
                $emergencyContact->createEmergencyContact();
            }
            $database->db->commit(); //si il n'y a pas d'erreur on push
        } catch (Exception $e) {
            $database->db->rollBack(); //sinon on revient au début sans rien rentrer dans les bases users et userStatus
            die('Erreur : ' . $formError['existMail'] = 'Un problème est survenu, veuillez rééssayer ultérieurement.');
        }
    }
}
?>
