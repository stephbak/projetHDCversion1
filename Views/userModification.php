<?php
session_start();
include '../Models/dataBase.php';
include '../Models/users.php';
include '../header.php';
include '../Controllers/infoUserCtrl.php';
?>
<?php 

if($success == true){
?>
   <div class="connexion">
        <h2>Vos infos personnelles</h2>
        <p>Votre nom : <?= $userConnection->lastname ?></p>
        <p>Votre Prénom : <?= $userConnection->firstname ?></p>
        <p>Votre N° de téléphone : <?= $userConnection->phone ?></p>
        <p>Votre identifiant de connexion : <?= $userConnection->mail ?></p>
    </div>
<?php } else { ?>
<div class="connexion">
        <h2>Vos infos personnelles</h2>
    </div>
    <div class="connexion">
        <form method="POST" action="userModification.php">
            <fieldset>
                <legend>Modifier vos informations personnelles</legend>
                <div class="row col-lg-12 justify-content-center">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="lastname">Nom : </label>
                            <input name="lastname" type="text" class="form-control" placeholder="Nom *" value="<?= $_SESSION['lastname'] ?>">
                            <p class="error"><?= empty($formError['lastname']) ? '' : $formError['lastname']; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="firstname">Prénom : </label>
                            <input name="firstname" type="text" class="form-control" placeholder="Prénom *" value="<?= $_SESSION['firstname'] ?>">
                            <p class="error"><?= empty($formError['firstname']) ? '' : $formError['firstname']; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="phoneNumber">Numéro de téléphone : </label>
                            <input name="phoneNumber" type="text" class="form-control" placeholder="n° de téléphone *" value="<?= $_SESSION['phoneNumber'] ?>">
                            <p class="error"><?= empty($formError['phoneNumber']) ? '' : $formError['phoneNumber']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="row col-lg-12 justify-content-center">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="mail">Email : </label>
                            <input name="mail" type="text" class="form-control" placeholder="Email *" value="<?= $_SESSION['mail'] ?>">
                            <p class="error"><?= empty($formError['mail']) ? '' : $formError['mail']; ?></p>
                            <p class="error"><?= empty($formError['existMail']) ? '' : $formError['existMail']; ?></p>
                        </div>
                    </div> 
                </div>
            </fieldset>  
            <div  class="submit row col-lg-12 justify-content-center">
                <input class="button btn" type="submit" value="Envoyer" name="validate" />
                <a class="button btn" href="infoUser.php">Annuler</a>
            </div>
        </form>
    </div>
<div class="connexion">
        <h2>Mot de passe</h2>
    </div>
    <div class="connexion">
        <form method="POST">
            <fieldset>
                <legend>Modifier votr mot de passe</legend>
                <div class="row col-lg-12 justify-content-center">
                  
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="password">Nouveau mot de passe : </label>
                            <input name="password" type="password" class="form-control" placeholder="Mot de passe *" >
                            <p class="error"><?= empty($formError['password']) ? '' : $formError['password']; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="password">Confirmez votre mot de passe : </label>
                            <input name="confirmPassword" type="password" class="form-control" placeholder="Mot de passe *" >
                            <p class="error"><?= empty($formError['confirmPassword']) ? '' : $formError['confirmPassword']; ?></p>
                        </div>
                    </div>
                </div>
                <p class="error"><?= isset($message) ? $message : '' ?></p>
            </fieldset>  
            <div  class="submit row col-lg-12 justify-content-center">
                <input class="button btn" type="submit" value="Envoyer" name="newPassword" />
            </div>
        </form>
    </div>
<?php }
include '../footer.php';
?>

