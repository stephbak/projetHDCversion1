<?php
session_start();
include '../Models/dataBase.php';
include '../Models/childs.php';
include '../Models/users.php';
include '../Models/genre.php';
include '../Models/emergencyContact.php';
include '../Models/paiementTypes.php';
include '../Models/inscriptionsYear.php';
include '../Controllers/infoUserModificationCtrl.php';
include '../header.php';
?>
<?php
if ($success == true) {
    ?>
    <div class="connexion">
        <h2>Infos du parent</h2>
        <p>Nom : <?= $getUserInfoByIdUser->lastname ?></p>
        <p>Prénom : <?= $getUserInfoByIdUser->firstname ?></p>
        <p>N° de téléphone : <?= $getUserInfoByIdUser->phone ?></p>
        <p>Mail : <?= $getUserInfoByIdUser->mail ?></p>
    </div>
<?php } else { ?>
<form method="POST">
    <div id="informationChild">
        <h2>Infos du parent</h2>
        <div class="row col-lg-12 justify-content-center">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="lastname">Nom : </label>
                    <input type="text" name="lastnameUser" class="form-control" value="<?= $getUserInfoByIdUser->lastname ?>">
                    <p class="error"><?= empty($formError['lastnameUser']) ? '' : $formError['lastnameUser']; ?></p> 
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="firstname">Prénom : </label>
                    <input type="text" name="firstnameUser" class="form-control" placeholder="Prénom *" value="<?= $getUserInfoByIdUser->firstname ?>">
                    <p class="error"><?= empty($formError['firstnameUser']) ? '' : $formError['firstnameUser']; ?></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="phone">N° de téléphone </label>
                    <input type="text" name="phoneUser" class="form-control" placeholder="Phone *" value="<?= $getUserInfoByIdUser->phone ?>">
                    <p class="error"><?= empty($formError['phoneUser']) ? '' : $formError['phoneUser']; ?></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="mail">Mail : </label>
                    <input type="mail" name="mailUser" class="form-control" placeholder="Mail *" value="<?= $getUserInfoByIdUser->mail ?>">
                    <p class="error"><?= empty($formError['mailUser']) ? '' : $formError['mailUser']; ?></p>
                </div>
                <input class="button btn" type="submit" value="Valider" name="validate"  />
                <a class="button btn" href="childList.php">Annuler</a>
            </div>




        </div>

</div>
    </form>
<?php }
include '../footer.php';
?>

