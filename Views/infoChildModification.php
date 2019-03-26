<?php
session_start();
include '../Models/dataBase.php';
include '../Models/childs.php';
include '../Models/genre.php';
include '../Models/emergencyContact.php';
include '../Models/paiementTypes.php';
include '../Models/inscriptionsYear.php';
include '../Controllers/infoChildCtrl.php';
include '../header.php';
?>
<form method="POST">
    <div id="informationChild">
        <fieldset>
            <legend>Coordonnées de votre enfant</legend>
            <div class="row col-lg-12 justify-content-center">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="lastname">Nom : </label>
                        <input type="text" name="lastname" class="form-control" value="<?= $getChildInfoById->lastname ?>">
                        <p class="error"><?= empty($formError['lastname']) ? '' : $formError['lastname']; ?></p> 
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="firstname">Prénom : </label>
                        <input type="text" name="firstname" class="form-control" placeholder="Prénom *" value="<?= $getChildInfoById->firstname ?>">
                        <p class="error"><?= empty($formError['firstname']) ? '' : $formError['firstname']; ?></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="birthDate">Date de naissance : </label>
                        <input type="date" name="birthDate" class="form-control" min="1980-01-01" max="<?= date('Y-m-d') ?>" placeholder="Date de naissance *" value="<?= $formatedDate ?>">
                        <p class="error"><?= empty($formError['birthDate']) ? '' : $formError['birthDate']; ?></p>
                    </div>
                </div>
                <div>
                    <fieldset>
                        <legend>Genre </legend>


                        <input type="radio" name="genre" value="1" <?= isset($getChildInfoById->id_ab0yz_genre) && ($getChildInfoById->id_ab0yz_genre == 'Garçon') ? 'checked="checked"' : '' ?> /><label>Garçon</label>
                        <input type="radio" name="genre" value="2" <?= isset($getChildInfoById->id_ab0yz_genre) && ($getChildInfoById->id_ab0yz_genre == 'Fille') ? 'checked="checked"' : '' ?> /><label>Fille</label>


                    </fieldset>
                    <p class="error"><?= empty($formError['genre']) ? '' : $formError['genre']; ?></p>
                    <fieldset>
                        <legend>Droit à l'image </legend>
                        <input type="radio" name="imageLaw" value="1" <?= isset($getChildInfoById->imageLaw) && ($getChildInfoById->imageLaw == 'Oui') ? 'checked="checked"' : '' ?> /><label>J'autorise</label>
                        <input type="radio" name="imageLaw" value="2" <?= isset($getChildInfoById->imageLaw) && ($getChildInfoById->imageLaw == 'Non') ? 'checked="checked"' : '' ?>/><label>n'autorise pas la diffusion de l'image de mon enfant *</label>
                        <p class="error"><?= empty($formError['imageLaw']) ? '' : $formError['imageLaw']; ?></p>
                    </fieldset>
                </div>
            </div>
    </div>
</form>
<?php
include '../footer.php';
?>