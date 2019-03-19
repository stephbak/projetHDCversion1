<?php
$users = new users();
$password = '';
$newPassword = '';
$regexText = '/^[a-zéèàêâùïüëA-Z- \']+$/';
$regexMail = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
$regexPhone = '/^0[1-9]([-. ]?[0-9]{2}){4}$/';
$formError = array();
$success = false;


if (isset($_POST['validate'])) { //si j'ai appuyé sur le bouton
    if (!empty($_POST['firstname'])) {//je vérifie que firstname n'est pas vide
        if (preg_match($regexText, $_POST['firstname'])) {//s'il n'est pas vide je vérifie que ce qu'a rentrer l'utilisateur corresponde a la regex
            $firstname = htmlspecialchars($_POST['firstname']);
        } else {
            //si ca ne correspond pas à la regex on affiche le msg d'erreur suivant:
            $formError['firstname'] = 'Veuillez rentrer un prénom valide.';
        }
    } else {
        //si c'est vide on affiche le msg d'erreur suivant :
        $formError['firstname'] = 'Veuillez entrer votre prénom.';
    }
    if (!empty($_POST['lastname'])) {
        if (preg_match($regexText, $_POST['lastname'])) {
            $lastname = htmlspecialchars($_POST['lastname']);
        } else {
            $formError['lastname'] = 'Veuillez rentrer un nom valide.';
        }
    } else {
        $formError['lastname'] = 'Veuillez entrer votre nom.';
    }
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $mail = htmlspecialchars($_POST['mail']);
        } else {
            $formError['mail'] = 'Veuillez rentrer un mail valide.';
        }
    } else {
        $formError['mail'] = 'Veuillez entrer votre mail.';
    }
    if (!empty($_POST['phoneNumber'])) {
        if (preg_match($regexPhone, $_POST['phoneNumber'])) {
            $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
        } else {
            $formError['phoneNumber'] = 'Veuillez rentrer un numéro de téléphone valide.';
        }
    } else {
        $formError['phoneNumber'] = 'Veuillez entrer votre numéro de téléphone.';
    }

    //je compte le nb de ligne existante dans le tableau d'erreur, si = 0 : il n'y a pas d'erreur
    if (count($formError) == 0) {
        
        $users->lastname = $lastname;
        $users->firstname = $firstname;
        $users->phone = $phoneNumber;
        $users->mail = $mail;
        $users->id = $_SESSION['id'];
        
        if ($users->updateUser()) {
            $userConnection = $users->userConnection();
            $_SESSION['lastname'] = $users->lastname;
            $_SESSION['firstname'] = $users->firstname;
            $_SESSION['phoneNumber'] = $users->phone;
            $_SESSION['mail'] = $users->mail;
        }
    }
}
if (isset($_POST['newPassword'])) {
    if (!empty($_POST['password'])) {
        
            $password = $_POST['password'];
        
    } else {
        $formError['password'] = 'Veuillez entrer un mot de passe.';
    }
    if (!empty($_POST['confirmPassword'])) {
        if ($_POST['confirmPassword'] != $password) {
            $formError['confirmPassword'] = 'Les mots de passe ne sont pas identiques.';
        } else {
            $confirmPassword = $_POST['confirmPassword'];
        }
    } else {
        $formError['confirmPassword'] = 'Veuillez confirmer votre mot de passe.';
    }
    if (count($formError) == 0) {
       
        $users->password = password_hash($password, PASSWORD_BCRYPT);
        $users->id = $_SESSION['id'];
        $updatePassword = $users->updatePassword();
        $message = 'Votre changement de mot de passe a bien été effectué';
    }
}
?>