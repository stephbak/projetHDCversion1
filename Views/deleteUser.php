<?php
session_start();
include '../Models/dataBase.php';
include '../Models/users.php';
include '../header.php';
include '../Controllers/deleteUserCtrl.php';
?>

<div class="connexion">
    <img src="../assets/img/warning.png" />
    <h2>! Vous êtes sur le point de supprimer votre compte !</h2>
    <a class="button btn" href="deleteUser.php?idDelete=delete">CONFIRMER LA SUPPRESSION</a>
    <a class="button btn" href="infoUser.php">ANNULER LA SUPPRESSION</a>
</div>
<?php
include '../footer.php';
?>
