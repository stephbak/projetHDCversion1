
<?php

//on instancie les class childs et users
$childs = new ab0yz_childs();
$users = new users();
//si il existe un GET ID
if (isset($_GET['id'])) {
    $users->id = $_GET['id'];
    //on exécute la méthode permettant à l'admin de lire les infos d'un user en fonction de son ID
    //de façon à ce que ces infos soient préremplis dans les input de la page infoUserModification
    $getUserInfoByIdUser = $users->getUserInfoByIdUser();
}
$regexText = '/^[a-zéèàêâùïüëA-Z- \']+$/';
$regexPhone = '/^0[1-9]([-. ]?[0-9]{2}){4}$/';
$regexBirthDate = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
$regexMail = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
$formError = array();
$success = false;
if (isset($_POST['validate'])) {
    if (!empty($_POST['lastnameUser'])) {
        if (preg_match($regexText, $_POST['lastnameUser'])) {
            $lastnameUser = htmlspecialchars($_POST['lastnameUser']);
        } else {
            $formError['lastnameUser'] = 'Veuillez rentrer un nom valide.';
        }
    } else {
        //si c'est vide on affiche le msg d'erreur suivant :
        $formError['lastnameUser'] = 'Veuillez entrer votre nom.';
    }
    if (!empty($_POST['firstnameUser'])) {
        if (preg_match($regexText, $_POST['firstnameUser'])) {
            $firstnameUser = htmlspecialchars($_POST['firstnameUser']);
        } else {
            $formError['firstnameUser'] = 'Veuillez rentrer un prénom valide.';
        }
    } else {
        $formError['firstnameUser'] = 'Veuillez entrer votre prénom.';
    }
    if (!empty($_POST['phoneUser'])) {
        if (preg_match($regexPhone, $_POST['phoneUser'])) {
            $phoneUser = htmlspecialchars($_POST['phoneUser']);
        } else {
            $formError['phoneUser'] = 'Veuillez rentrer un numéro de téléphone valide.';
        }
    } else {
        $formError['phoneUser'] = 'Veuillez entrer votre numéro de téléphone.';
    }

    if (!empty($_POST['mailUser'])) {
        if (filter_var($_POST['mailUser'], FILTER_VALIDATE_EMAIL)) {
            $mailUser = htmlspecialchars($_POST['mailUser']);
        } else {
            $formError['mailUser'] = 'Veuillez rentrer un mail valide.';
        }
    } else {
        $formError['mailUser'] = 'Veuillez entrer votre mail.';
    }
    //si il n'y a pas d'erreur
    if (count($formError) == 0) {
        //on récupère les POST
        $users->firstname = $firstnameUser;
        $users->lastname = $lastnameUser;
        $users->phone = $phoneUser;
        $users->mail = $mailUser;
        //on éxécute la méthode permettant à l'admin de modifier les informations d'un user
        $updateUserInfo = $users->updateUserInfo();
        //et on éxécute la méthode permettant à l'admin de lire les infos d'un user en fonction de son ID
        //avant de passer la variable $success à true de manière à lire en BDD les nouvelles infos du user
        //avant de les afficher mises à jour
        $getUserInfoByIdUser = $users->getUserInfoByIdUser();
        $success = true;
    }
}
?>

