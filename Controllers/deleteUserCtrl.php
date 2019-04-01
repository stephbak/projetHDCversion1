<?php

//on stock dans la class users, l'instanciation de l'objet users qui fait référence à notre class users
$users = new users();
if (isset($_GET['idDelete'])) {
    $users->id = $_SESSION['id'];
    //si la méthode permettant de supprimer le compte user s'exécute bien
    if ($users->deleteUser()) {
        //on redirige vers la page logout
        header('Location: logOut.php?action=delete');
        exit;
    }
}
?>

