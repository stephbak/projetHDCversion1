<?php

session_start();
//on détruit la session de l'utilisateur
session_destroy();
//et on redirige vers l'index du site
header('Location:../index.php');
exit;
?>