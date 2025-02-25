<?php

$childs = new ab0yz_childs();
$emergencyContact = new ab0yz_emergencyContact();

if (isset($_GET['id'])) {
    $childs->id = $_GET['id'];
    //on lit les infos d'un enfant en fonction de son ID
    $getChildInfoById = $childs->getChildInfoById();
    //on lit les infos d'un parents en fonction de l'ID de l'enfant
    $userInfoByIdChild = $childs->userInfoByIdChild();
    $emergencyContact->id_ab0yz_childs = $childs->id;
    //on lit les infos du contact d'urgence en fonction de l'ID de l'enfant
    $emergencyContactInfoByIdChild = $emergencyContact->emergencyContactInfoByIdChild();
//    on lit les infos de l'inscription de l'année en fonction de l'ID de l'enfant
    $inscriptionYearInfoByIdChild = $childs->inscriptionYearInfoByIdChild();
    $formatedDate = date('Y-m-d', strtotime($getChildInfoById->birthDate));
    $genre = new ab0yz_genre();
    //On lit la base de donnée genreList
    $genreList = $genre->genreList();
}
$regexText = '/^[a-zéèàêâùïüëA-Z- \']+$/';
$regexPhone = '/^0[1-9]([-. ]?[0-9]{2}){4}$/';
$regexBirthDate = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
$regexMail = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
$formError = array();
$success = false;
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
    if (!empty($_POST['imageLaw'])) {
        $imageLaw = intval($_POST['imageLaw']);
    } else {
        $formError['imageLaw'] = 'Veuillez indiquer votre choix';
    }

    //si il n'y a pas d'erreur
    if (count($formError) == 0) {
        $childs->firstname = $firstname;
        $childs->lastname = $lastname;
        $childs->birthDate = $birthDate;
        $childs->imageLaw = $imageLaw;
        $childs->id_ab0yz_users = $_SESSION['id'];
        $childs->id_ab0yz_genre = $genre;
        //on éxecute la méthode permettant de modifier les infos d'un enfant
        $updateChild = $childs->updateChild();
        //on exécute la méthode permettant de lire les infos mises à jour d'un enfant
        //pour l'afficher sur la page infoChildModification
        $getChildInfoById = $childs->getChildInfoById();
        $success = true;
    }
}
?>

