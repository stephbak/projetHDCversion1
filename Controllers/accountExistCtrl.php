<?php

$regexMail = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
$formError = array();
$success = false;
if (isset($_POST['login'])) {
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $login = htmlspecialchars($_POST['mail']);
        } else {
            $formError['login'] = 'Votre login ou votre mot de passe n\'est pas valide.';
        }
    } else {
        $formError['login'] = 'Votre login ou votre mot de passe n\'est pas valide.';
    }
    if (!empty($_POST['password'])) {

        $password = $_POST['password'];
    } else {
        $formError['login'] = 'Votre login ou votre mot de passe n\'est pas valide.';
    }
    if (count($formError) == 0) {
        $users = new users();
        $users->mail = $login;
        //On exécute la méthode permettantg à un utilisateur de se connecter à son compte
        $users = $users->userConnection();
        if (is_object($users)) {
            //on vérifie que le password renseigné pour se connecter est le même que celui saisi lors de l'inscription
            if (password_verify($password, $users->password)) {
                $_SESSION['id'] = $users->id;
                $_SESSION['lastname'] = $users->lastname;
                $_SESSION['firstname'] = $users->firstname;
                $_SESSION['phoneNumber'] = $users->phone;
                $_SESSION['mail'] = $users->mail;
                $_SESSION['rules'] = $users->interieurRules;
                $_SESSION['CGU'] = $users->cguChecked;
                $_SESSION['password'] = $users->password;
                $_SESSION['id_ab0yz_status'] = $users->id_ab0yz_status;
                $_SESSION['isConnect'] = true;
            } else {
                $formError['login'] = 'Votre login ou votre mot de passe n\'est pas valide.';
            }
        }
    }
}
?>
 
