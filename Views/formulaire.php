<?php
session_start();
include '../Models/dataBase.php';
include '../Models/childs.php';
include '../Models/genre.php';
include '../Models/emergencyContact.php';
include '../Models/paiementTypes.php';
include '../Models/inscriptionsYear.php';
include '../header.php';
include '../Controllers/formulaireCtrl.php';
?>


<?php 
if($success == true){ ?>
        <div class="connexion">
        <h2>Votre demande a bien été prise en compte</h2>
        <p>Vous allez bientôt recevoir un mail de confirmation de l'inscription de votre enfant.</p>
    </div>
<?php }else{ 
if (isset($_SESSION['isConnect'])) { ?>
<div id="registration">
    <h2>Inscrire mon enfant</h2>
</div>
<form method="POST">
    <div id="informationChild">
        <fieldset>
            <legend>Coordonnées de votre enfant</legend>
            <div class="row col-lg-12 justify-content-center">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="lastname">Nom : </label>
                        <input type="text" name="lastname" class="form-control" placeholder="Nom *" value="<?= (isset($lastname)) ? $_POST['lastname'] : '' ?>">
                        <p class="error"><?= empty($formError['lastname']) ? '' : $formError['lastname']; ?></p> 
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="firstname">Prénom : </label>
                        <input type="text" name="firstname" class="form-control" placeholder="Prénom *" value="<?= (isset($firstname)) ? $_POST['firstname'] : '' ?>">
                        <p class="error"><?= empty($formError['firstname']) ? '' : $formError['firstname']; ?></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="birthDate">Date de naissance : </label>
                        <input type="date" name="birthDate" class="form-control" min="1980-01-01" max="<?= date('Y-m-d') ?>" placeholder="Date de naissance *" value="<?= (isset($birthDate)) ? $_POST['birthDate'] : '' ?>">
                        <p class="error"><?= empty($formError['birthDate']) ? '' : $formError['birthDate']; ?></p>
                    </div>
                </div>
                <div>
                   
                         <?php
                    foreach ($genreList as $genre) {
                        ?> 
                        <input type="radio" name="genre" value="<?= $genre->id ?>" /><label><?= $genre->genre ?></label>
                    <?php } ?>
                    
                    
                    <p class="error"><?= empty($formError['genre']) ? '' : $formError['genre']; ?></p>
                </div>
            </div>

            <small id="emailHelp">* champs obligatoire</small>
        </fieldset>
    </div>

    <div id="emergency">
        <fieldset>
            <legend>Personnes à prévenir en cas d'urgence</legend>
            <div class="row col-lg-12 justify-content-center">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="lastname">Nom : </label>
                        <input type="text" class="form-control" placeholder="Nom *" name="emergencyLastname" value="<?= (isset($emergencyLastname)) ? $_POST['emergencyLastname'] : '' ?>">
                        <p class="error"><?= empty($formError['emergencyLastname']) ? '' : $formError['emergencyLastname']; ?></p> 
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="firstname">Prénom : </label>
                        <input type="text" class="form-control" placeholder="Prénom *" name="emergencyFirstname" value="<?= (isset($emergencyFirstname)) ? $_POST['emergencyFirstname'] : '' ?>">
                        <p class="error"><?= empty($formError['emergencyFirstname']) ? '' : $formError['emergencyFirstname']; ?></p> 
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="phoneNumber">Numéro de téléphone : </label>
                        <input type="text" class="form-control" placeholder="Numéro de téléphone *" name="emergencyPhone" value="<?= (isset($emergencyPhone)) ? $_POST['emergencyPhone'] : '' ?>">
                        <p class="error"><?= empty($formError['emergencyPhone']) ? '' : $formError['emergencyPhone']; ?></p> 
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div id='imageRights'>
        <fieldset>
            <legend>Droit à l'image </legend>
            <input type="radio" name="imageLaw" value="1" /><label>J'autorise</label>
            <input type="radio" name="imageLaw" value="2" /><label>n'autorise pas la diffusion de l'image de mon enfant *</label>
            <p class="error"><?= empty($formError['imageLaw']) ? '' : $formError['imageLaw']; ?></p>
        </fieldset>
    </div>
    <div id='payment'>
        <fieldset>
            <legend>Modalités de paiement</legend>
            <p>Je règle le montant de la cotisation annuelle de 55 € ( chèque ou liquide ) en :</p>
            <input type="radio" name="paymentNumber" value="1" /><label> 1 fois</label>
            <input type="radio" name="paymentNumber" value="2" /><label> 2 fois</label>
            <input id="3" type="radio" name="paymentNumber" value="3" /><label> 3 fois *</label>
            <p class="error"><?= empty($formError['paymentNumber']) ? '' : $formError['paymentNumber']; ?></p>
            <div>
                <?php foreach ($paiementTypesList as $paiementType) { ?>
                    <input type="radio" name="paymentType" value="<?= $paiementType->id ?>" /><label><?= $paiementType->type ?></label>
                <?php }
?>
<!--                <input type="radio" name="paymentType" value="1" /><label> Chèque(s)</label>
                <input type="radio" name="paymentType" value="2" /><label> Espèces *</label>-->
                <p class="error"><?= empty($formError['paymentType']) ? '' : $formError['paymentType']; ?></p>
            </div>
            <p>Les chèques doivent êtres remis lors de l'inscription, ils doivent être datés et signés (fin Décembre dernier délai pour l'encaissement du dernier chèque) .</p>
            <p>Le premier versement est de 20€ minimum.</p>
        </fieldset>
    </div>
    <div  class="submit row col-lg-12 justify-content-center">
        <input class="button btn" type="submit" value="Valider l'inscription" name="submit" />
    </div>
</form>
<?php } else { ?>
<form>
    <div class="connexion">
        <h3>Pour accéder au formulaire vous devez être connecté à votre compte</h3>
        <h3><a href="newAccount.php">Créer un compte</a></h3>
        <h3><a href='accountExist.php'>Me connecter</a></h3>
    </div>
</form>
<?php } }
include '../footer.php';
?>