<?php
session_start();
include '../Models/dataBase.php';
include '../Models/childs.php';
include '../Models/users.php';
include '../Models/genre.php';
include '../Models/emergencyContact.php';
include '../Models/paiementTypes.php';
include '../Models/inscriptionsYear.php';
include '../Controllers/infoChildCtrl.php';
include '../header.php';
?>
<?php
if ($success == true) {
    ?>
    <div class="connexion">
        <h2>Infos de l'enfant</h2>
        <p>Nom : <?= $getChildInfoById->lastname ?></p>
        <p>Prénom : <?= $getChildInfoById->firstname ?></p>
        <p>Genre : <?= $getChildInfoById->id_ab0yz_genre ?></p>
        <p>Date de naissance : <?= $getChildInfoById->birthDate ?></p>
        <p>Droit à l'image : <?= $getChildInfoById->imageLaw ?></p>
    </div>
<?php } else { ?>
    <form method="POST">
        <div id="informationChild">        
            <h2>Infos de l'enfant</h2>
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
                    <h3>Genre </h3>
                    <input type="radio" name="genre" value="1" <?= isset($getChildInfoById->id_ab0yz_genre) && ($getChildInfoById->id_ab0yz_genre == 'Garçon') ? 'checked="checked"' : '' ?> /><label>Garçon</label>
                    <input type="radio" name="genre" value="2" <?= isset($getChildInfoById->id_ab0yz_genre) && ($getChildInfoById->id_ab0yz_genre == 'Fille') ? 'checked="checked"' : '' ?> /><label>Fille</label>
                    <p class="error"><?= empty($formError['genre']) ? '' : $formError['genre']; ?></p>
                    <h3>Droit à l'image </h3>
                    <input type="radio" name="imageLaw" value="1" <?= isset($getChildInfoById->imageLaw) && ($getChildInfoById->imageLaw == 'Oui') ? 'checked="checked"' : '' ?> /><label>J'autorise</label>
                    <input type="radio" name="imageLaw" value="2" <?= isset($getChildInfoById->imageLaw) && ($getChildInfoById->imageLaw == 'Non') ? 'checked="checked"' : '' ?>/><label>n'autorise pas la diffusion de l'image de mon enfant *</label>
                    <p class="error"><?= empty($formError['imageLaw']) ? '' : $formError['imageLaw']; ?></p>
                </div>
            </div>
            <input class="button btn" type="submit" value="Valider" name="submit" />
            <?php if (isset($_SESSION['isConnect']) && ($_SESSION['id_ab0yz_status'] == 1)) { ?>
                <a class="button btn" href="childList.php">Annuler</a>
            <?php } else { ?>
                <a class="button btn" href="infoUser.php">Annuler</a>
            <?php } ?>
        </div>
    </form>
    <?php
}
include '../footer.php';
?>