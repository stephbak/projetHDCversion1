<?php

//on stock dans la class users, l'instanciation de l'objet users qui fait référence à notre class users
$users = new users();

if (isset($_GET['idDelete'])) {
    $users->id = $_SESSION['id'];
    if ($users->deleteUser()) {
        header('Location: logOut.php?action=delete');
        exit;
    }
}
?>

