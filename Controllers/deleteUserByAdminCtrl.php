<?php

//on stock dans la class users, l'instanciation de l'objet users qui fait référence à notre class users
$users = new users();
if (isset($_GET['idDelete'])) {
    $users->id = $_GET['idDelete'];
    //on exécute la méthode permettant à l'admin de supprimer un compte utilisateur
    $deleteUserByAdmin = $users->deleteUserByAdmin();
}
?>
