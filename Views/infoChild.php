<?php
session_start();
include '../Models/dataBase.php';
include '../Models/childs.php';
include '../Models/users.php';
include '../Models/emergencyContact.php';
include '../Models/genre.php';
include '../Controllers/infoChildCtrl.php';
include '../header.php';
?>
<div class="connexion">
    <h2>Infos enfant</h2>
    <p><?= $getChildInfoById->lastname ?> <?= $getChildInfoById->firstname ?></p>
    <p class="card-text"><?= $getChildInfoById->id_ab0yz_genre ?></p>
    <p class="card-text">Date de naissance : <?= $getChildInfoById->birthDate ?> (<?= $getChildInfoById->age ?> ans)</p>
    <p class="card-text">Groupe : <?= $getChildInfoById->id_ab0yz_groups ?></p>
    <p class="card-text">Droit à l'image : <?= $getChildInfoById->imageLaw ?></p>
    <a class="button btn" href="infoChildModification.php?id=<?= $getChildInfoById->id ?>">MODIFIER</a>
</div>
<div class="connexion">
    <h2>Infos supplémentaires</h2>
    <h3>Parents</h3>
    <p><?= $userInfoByIdChild->lastname ?> <?= $userInfoByIdChild->firstname ?></p>
    <p class="card-text">N° de téléphone : <?= $userInfoByIdChild->phone ?></p>
    <p class="card-text">Adresse mail : <?= $userInfoByIdChild->mail ?></p>
    
    <h3>Contact d'urgence</h3>
    <?php foreach ($emergencyContactInfoByIdChild as $emergencyContact) { ?>
        <p><?= $emergencyContact->lastname ?> <?= $emergencyContact->firstname ?></p>
        <p class="card-text">N° de téléphone : <?= $emergencyContact->phone ?></p>
    <?php } ?>
    <h3>Infos inscription pour l'année <?= $inscriptionYearInfoByIdChild->years ?></h3>
    <p class="card-text">Type de paiement : <?= $inscriptionYearInfoByIdChild->type ?></p>
    <p class="card-text">Paiement en : <?= $inscriptionYearInfoByIdChild->numberPayment ?> fois.</p>

</div>
<?php
include '../footer.php';
?>