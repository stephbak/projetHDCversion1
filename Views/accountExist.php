<?php
session_start();
include '../Models/dataBase.php';
include '../Models/userStatus.php';
include '../Models/users.php';
include '../Controllers/accountExistCtrl.php';
include '../header.php';
?>
<?php if (isset($_SESSION['isConnect'])) { ?>
    <div class="connexion">
        <h2>Bonjour <?= $_SESSION['firstname'] ?></h2>
        <p>Toute l'équipe Happy Dance Club vous souhaite la bienvenue</p>
    </div>
<?php } else { ?>
    <div class="connexion">
        <h2>Se connecter</h2>
    </div>
    <div class="connexion">
        <form method="POST" action="accountExist.php">
            <fieldset>
                <legend>Veuillez vous connecter</legend>
                <div class="row col-lg-12 justify-content-center">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="mail">Email : </label>
                            <input name="mail" type="text" class="form-control" placeholder="Email *" value="<?= isset($login) ? $login : '' ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="password">Mot de passe : </label>
                            <input name="password" type="password" class="form-control" placeholder="Mot de passe *" value="<?= isset($password) ? $password : '' ?>">
                        </div>
                    </div>
                    <p class="error"><?= empty($formError['login']) ? '' : $formError['login']; ?></p>
                </div>
            </fieldset>  
            <div  class="submit row col-lg-12 justify-content-center">
                <input class="button btn" type="submit" value="Envoyer" name="login" />
            </div>
        </form>
    </div>
    <?php
}
include '../footer.php';
?>

