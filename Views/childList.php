<?php
session_start();
include '../Models/dataBase.php';
include '../Models/childs.php';
include '../Models/userStatus.php';
include '../Models/users.php';
include '../Controllers/childListCtrl.php';
include '../header.php';
?>
<div class='container'>
<div class="connexion">
    <h2>Liste des enfants</h2>
</div>
<table class="connexion table table-secondary">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Date de naissance</th>
            <th scope="col">Age</th>
            <th scope="col">Genre</th>
            <th scope="col">Groupe</th>
            <th scope="col">Droit à l'image</th>
            <th scope="col">Infos enfant</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($getChildsList as $childInfo) {
            ?>
            <tr class="table-primary">
                <td><?= $childInfo->id ?></td>
                <td><?= $childInfo->lastname ?></td>
                <td><?= $childInfo->firstname ?></td>
                <td><?= $childInfo->birthDate ?></td>
                <td><?= $childInfo->age ?></td>
                <td><?= $childInfo->id_ab0yz_genre ?></td>
                <td><?= $childInfo->id_ab0yz_groups ?></td>
                <td><?= $childInfo->imageLaw ?></td>
                <td><a href="infoChild.php?id=<?= $childInfo->id ?>">Infos enfant</a></td>
                
            </tr>
        <?php } ?>
    </tbody>
</table>
    </div>
<?php
include '../footer.php';
?>