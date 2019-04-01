<?php
session_start();
include '../Models/dataBase.php';
include '../Models/childs.php';
include '../Models/users.php';
include '../Models/genre.php';
include '../Models/emergencyContact.php';
include '../Models/paiementTypes.php';
include '../Models/inscriptionsYear.php';
include '../Controllers/infoEmergencyContactModificationCtrl.php';
include '../header.php';
?>
<?php
if ($success == true) {
    ?>
    <div class="connexion">
        <h2>Infos du parent</h2>
        <p>Nom : <?= $emergencyContactInfo->lastname ?></p>
        <p>Prénom : <?= $emergencyContactInfo->firstname ?></p>
        <p>N° de téléphone : <?= $emergencyContactInfo->phone ?></p>
    </div>
<?php } else { ?>
    <form method="POST">
        <div id="informationChild">
            <h2>Infos du contact d'urgence</h2>
            <div class="row col-lg-12 justify-content-center">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="lastname">Nom : </label>
                        <input type="text" name="lastname" class="form-control" value="<?= $emergencyContactInfo->lastname ?>">
                        <p class="error"><?= empty($formError['lastname']) ? '' : $formError['lastname']; ?></p> 
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="firstname">Prénom : </label>
                        <input type="text" name="firstname" class="form-control" placeholder="Prénom *" value="<?= $emergencyContactInfo->firstname ?>">
                        <p class="error"><?= empty($formError['firstname']) ? '' : $formError['firstname']; ?></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="phone">N° de téléphone </label>
                        <input type="text" name="phone" class="form-control" placeholder="Phone *" value="<?= $emergencyContactInfo->phone ?>">
                        <p class="error"><?= empty($formError['phone']) ? '' : $formError['phone']; ?></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <input class="button btn" type="submit" value="Valider" name="validate"  />
                    <a class="button btn" href="childList.php">Annuler</a>
                </div>
            </div>
        </div>
    </form>
<?php
}
include '../footer.php';
?>
