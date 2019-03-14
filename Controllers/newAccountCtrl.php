<?php

$users = new users();

$regexText = '/^[a-zéèàêâùïüëA-Z- \']+$/';
$regexMail = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
$regexPhone = '/^0[1-9]([-. ]?[0-9]{2}){4}$/';
$formError = array();
$success = false;


if (isset($_POST['submit'])) { //si j'ai appuyé sur le bouton
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
    if (!empty($_POST['password'])) {
        if ($_POST['password']) {
            $password = $_POST['password'];
        }
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
    if (!empty($_POST['rules'])) {
        if ($_POST['rules']) {
            $rules = $_POST['rules'];
        }
    } else {
        $formError['rules'] = 'Veuillez cocher la case.';
    }
    if (!empty($_POST['CGU'])) {
        if ($_POST['CGU']) {
            $CGU = $_POST['CGU'];
        }
    } else {
        $formError['CGU'] = 'Veuillez cocher la case.';
    }
    //je compte le nb de ligne existante dans le tableau d'erreur, si = 0 : il n'y a pas d'erreur
    if (count($formError) == 0) {
        $users->lastname = $lastname;
        $users->firstname = $firstname;
        $users->phone = $phoneNumber;
        $users->mail = $mail;
        $users->interieurRules = $rules;
        $users->cguChecked = $CGU;
        $users->password = password_hash($password, PASSWORD_BCRYPT); //on hash le mot de passe    
        //on vérifie que le mail n'existe pas encore
        $checkIfMailExist = $users->checkIfMailExist();
        if (intval($checkIfMailExist->existMail) === 1) {
            $success = false;
            $formError['existMail'] = 'Ce mail est déjà utilisé';
        } elseif (intval($checkIfMailExist->existMail) === 0) {
            $database = dataBase::getInstance();
            $database->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                //on commence la transaction
                $database->db->beginTransaction();
                if ($users->createUser()) {
                    $success = true;
                    $userStatus = new userStatus();
                    $userStatus->id_ab0yz_status = 5;
                    $userStatus->id_ab0yz_users = $database->db->lastInsertId();
                    $userStatus->insertUserStatus();
                }
                $database->db->commit(); //si il n'y a pas d'erreur on push
            } catch (Exception $e) {
                $database->db->rollBack(); //sinon on revient au début sans rien rentrer dans les bases users et userStatus
                die('Erreur : ' . $formError['existMail'] = 'Un problème est survenu, veuillez rééssayer ultérieurement.');
            }
        }
    }
}
?>

