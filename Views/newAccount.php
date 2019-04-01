<?php
session_start();
include '../Models/dataBase.php';
include '../Models/userStatus.php';
include '../Models/users.php';
include '../header.php';
include '../Controllers/newAccountCtrl.php';
?>
<?php if ($success == true) { ?>
    <div class="connexion">
        <h2>Votre compte a bien été créé</h2>
        <p>Votre nom : <?= $lastname ?></p>
        <p>Votre Prénom : <?= $firstname ?></p>
        <p>Votre N° de téléphone est : <?= $phoneNumber ?></p>
        <p>Votre identifiant de connexion : <?= $mail ?></p>
    </div>
<?php } else { ?>
    <div class="connexion">
        <h2>Se connecter</h2>
    </div>
    <div class="connexion">
        <form method="POST">
            <fieldset>
                <legend>Créer vos identifiants</legend>
                <div class="row col-lg-12 justify-content-center">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="lastname">Nom : </label>
                            <input name="lastname" type="text" class="form-control" placeholder="Nom *" value="<?= (isset($lastname)) ? $_POST['lastname'] : '' ?>">
                            <p class="error"><?= empty($formError['lastname']) ? '' : $formError['lastname']; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="firstname">Prénom : </label>
                            <input name="firstname" type="text" class="form-control" placeholder="Prénom *" value="<?= (isset($firstname)) ? $_POST['firstname'] : '' ?>">
                            <p class="error"><?= empty($formError['firstname']) ? '' : $formError['firstname']; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="phoneNumber">Numéro de téléphone : </label>
                            <input name="phoneNumber" type="text" class="form-control" placeholder="n° de téléphone *" value="<?= (isset($phoneNumber)) ? $_POST['phoneNumber'] : '' ?>">
                            <p class="error"><?= empty($formError['phoneNumber']) ? '' : $formError['phoneNumber']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="row col-lg-12 justify-content-center">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="mail">Email : </label>
                            <input name="mail" type="text" class="form-control" placeholder="Email *" value="<?= (isset($mail)) ? $_POST['mail'] : '' ?>">
                            <p class="error"><?= empty($formError['mail']) ? '' : $formError['mail']; ?></p>
                            <p class="error"><?= empty($formError['existMail']) ? '' : $formError['existMail']; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="password">Créer votre mot de passe : </label>
                            <input name="password" type="password" class="form-control" placeholder="Mot de passe *" value="<?= (isset($password)) ? $_POST['password'] : '' ?>">
                            <p class="error"><?= empty($formError['password']) ? '' : $formError['password']; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="password">Confirmez votre mot de passe : </label>
                            <input name="confirmPassword" type="password" class="form-control" placeholder="Mot de passe *" value="<?= (isset($confirmPassword)) ? $_POST['confirmPassword'] : '' ?>">
                            <p class="error"><?= empty($formError['confirmPassword']) ? '' : $formError['confirmPassword']; ?></p>
                        </div>
                    </div>
                </div>
                <input name="rules" type="checkbox" value="1" /><label>J'ai bien pris connaissance du <a href='reglement.php'>réglement intérieur</a> et m'engage à l'appliquer et le faire appliquer par mon enfant.</label>
                <p class="error"><?= empty($formError['rules']) ? '' : $formError['rules']; ?></p>
                <input name="CGU" type="checkbox" value="1" /><label>J'ai bien pris connaissance des <a href='CGU.php'>CGU</a></label>
                <p class="error"><?= empty($formError['CGU']) ? '' : $formError['CGU']; ?></p>
            </fieldset>  
            <div  class="submit row col-lg-12 justify-content-center">
                <input class="button btn" type="submit" value="Envoyer" name="submit" />
            </div>
        </form>
    </div>
    <?php
}
include '../footer.php';
?>