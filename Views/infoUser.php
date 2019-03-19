<?php
session_start();
include '../Models/dataBase.php';
include '../Models/users.php';
include '../header.php';
include '../Controllers/infoUserCtrl.php';
?>
    <div class="connexion">
        <h2>Vos infos personnelles</h2>
        <p>Votre nom : <?= $_SESSION['lastname'] ?></p>
        <p>Votre Prénom : <?= $_SESSION['firstname'] ?></p>
        <p>Votre N° de téléphone : <?= $_SESSION['phoneNumber'] ?></p>
        <p>Votre identifiant de connexion : <?= $_SESSION['mail'] ?></p>
        <a class="button btn" href="userModification.php">MODIFIER</a>
        <a class="button btn" href="deleteUser.php">SUPPRIMER VOTRE COMPTE</a>
    </div>
<?php 
include '../footer.php';
?>

