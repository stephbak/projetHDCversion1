<?php

$regexText = '/^[a-zéèàêâùïüëA-Z- \']+$/';
$regexPhone = '/^0[1-9]([-. ]?[0-9]{2}){4}$/';
$regexBirthDate = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
$formError = array();
$success = false;
//je lis la table genre
$genre = new ab0yz_genre();
$genreList = $genre->genreList();
//je lis la table paiementTypes
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
        $imageLaw = intval($_POST['imageLaw']);
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
    //si il n'y a pas d'erreur
    if (count($formError) == 0) {
        //j'instancie la class inscriptionYear
        $inscriptionsYear = new ab0yz_inscriptionsYear();
        //on défini la date de l'année d'inscription
        $inscriptionsYear->years = date('Y');
        $inscriptionsYear->medicalCertificate = NULL; //on initialise à NULL car le certificat n'est pas toujours fourni immédiatement
        $inscriptionsYear->numberPayment = $paymentNumber;
        $inscriptionsYear->id_ab0yz_paiementTypes = $paymentType;
        //j'instancie la class childs
        $childs = new ab0yz_childs();
        //je définie l'âge de l'enfant en fonction de sa date de naissance
        $age = (time() - strtotime($birthDate)) / 3600 / 24 / 365;
        //je lui attribue un groupe en fonction de son âge
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
            //je commence la transaction
            $database->db->beginTransaction();
            //si la méthode inscriptionYear se fait bien
            if ($inscriptionsYear->inscriptionYear()) {
                //la variable success passe à true
                $success = true;
                $childs->firstname = $firstname;
                $childs->lastname = $lastname;
                $childs->birthDate = $birthDate;
                $childs->imageLaw = $imageLaw;
                $childs->id_ab0yz_users = $_SESSION['id'];
                $childs->id_ab0yz_genre = $genre;
                //on récupère le dernier ID créer
                $childs->id_ab0yz_inscriptionsYear = $database->db->lastInsertId();
                //on éxecute la méthode createChild
                $childs->createChild();
                //ensuite on instancie la méthode emergencyContact
                $emergencyContact = new ab0yz_emergencyContact();
                $emergencyContact->firstname = $_POST['emergencyFirstname'];
                $emergencyContact->lastname = $_POST['emergencyLastname'];
                $emergencyContact->phone = $_POST['emergencyPhone'];
                $emergencyContact->id_ab0yz_childs = $database->db->lastInsertId();
                //on éxecute la méthode createEmergencyContact
                $emergencyContact->createEmergencyContact();
            }
            $database->db->commit(); //si il n'y a pas d'erreur on push
        } catch (Exception $e) {
            $database->db->rollBack(); //sinon on revient au début sans rien rentrer dans les bases inscriptionYear, childs et emergencyContact
            die('Erreur : ' . $formError['existMail'] = 'Un problème est survenu, veuillez rééssayer ultérieurement.');
        }
    }
}
?>
