<?php
session_start();
include '../header.php';
?>
<div class="connexion">
    <h2>Se connecter</h2>
</div>
    <div class="connexion">
        <h3><a class="button btn" href="newAccount.php">Créer un compte</a></h3>
        <h3><a class="button btn" href='accountExist.php'>J'ai déja un compte</a></h3>
    </div>
<?php
include '../footer.php';
?>