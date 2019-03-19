<?php

//on stock dans la class patients, l'instanciation de l'objet client qui fait référence à notre class client
$users = new users();

if (isset($_GET['idDelete'])) {
    $users->id = $_SESSION['id'];
    if ($users->deleteUser()) {
        header('Location: logOut.php?action=delete');
        exit;
    }
}
?>

