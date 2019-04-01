<?php

$childs = new ab0yz_childs();
$emergencyContact = new ab0yz_emergencyContact();
//si il existe un GET ID
if (isset($_GET['id'])) {
    //On récupère l'ID du contact d'urgence
    $emergencyContact->id = $_GET['id'];
    //on exécute la méthode permettant de lire les infos d'un contact d'urgence en fonction de son ID
    $emergencyContactInfo = $emergencyContact->emergencyContactInfo();
}
$regexText = '/^[a-zéèàêâùïüëA-Z- \']+$/';
$regexPhone = '/^0[1-9]([-. ]?[0-9]{2}){4}$/';
$regexBirthDate = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
$formError = array();
$success = false;
if (isset($_POST['validate'])) {
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
    if (!empty($_POST['phone'])) {
        if (preg_match($regexPhone, $_POST['phone'])) {
            $phone = htmlspecialchars($_POST['phone']);
        } else {
            $formError['phone'] = 'Veuillez rentrer un numéro de téléphone valide.';
        }
    } else {
        $formError['phone'] = 'Veuillez entrer votre numéro de téléphone.';
    }
    //si il n'y a pas d'erreur
    if (count($formError) == 0) {
        //on récupère les POST
        $emergencyContact->firstname = $firstname;
        $emergencyContact->lastname = $lastname;
        $emergencyContact->phone = $phone;
        //on modifie la table emergencyContact grâce à la méthode updateEmergencyContact
        $updateEmergencyContactInfo = $emergencyContact->updateEmergencyContactInfo();
        //on va lire dans la table emergencyContact les données mises à jour
        //pour les afficher sur la page infoEmergencyContactModification
        $emergencyContactInfo = $emergencyContact->emergencyContactInfo();
        $success = true;
    }
}
?>