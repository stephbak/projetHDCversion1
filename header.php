<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
        <link href="https://fonts.googleapis.com/css?family=Spicy+Rice" rel="stylesheet" /> 
        <link href="https://fonts.googleapis.com/css?family=Alegreya" rel="stylesheet" /> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://bootswatch.com/4/cosmo/bootstrap.min.css" />
        <link rel="stylesheet" href="/assets/css/style.css" />
        <title>Happy Dance Club</title>
    </head>
    <body>
        <h1>HAPPY DANCE CLUB</h1>
                <!--navbar admin-->
                <?php if(isset($_SESSION['isConnect']) && ($_SESSION['id_ab0yz_status'] == 1)){ ?>
        <nav class="admin navbar navbar-expand-lg navbar-light ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <select>
                            <option onclick="window.location.href = '../index.php#presentation'">Qui sommes-nous?</option>
                            <option onclick="window.location.href = '../index.php#contact'">Nous contacter</option>
                            <option onclick="window.location.href = '../index.php#location'">Nous trouver</option>
                        </select>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/calendrier.php">Agenda<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/news.php">Actualités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/galerie.php">Galerie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/formulaire.php">Inscrire mon enfant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/reglement.php">Règlement intérieur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/childList.php">Liste des enfants</a>
                    </li>
                    <?php if (isset($_SESSION['isConnect'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/Views/infoUser.php">Mes infos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Views/logOut.php?action=disconnect">Deconnexion</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/Views/connexion.php">Connexion/Inscription</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <?php } else { ?>
        
        
        
        <!--Navbar user-->
        
        <nav class="navbar navbar-expand-lg navbar-light ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <select>
                            <option onclick="window.location.href = '../index.php#presentation'">Qui sommes-nous?</option>
                            <option onclick="window.location.href = '../index.php#contact'">Nous contacter</option>
                            <option onclick="window.location.href = '../index.php#location'">Nous trouver</option>
                        </select>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/calendrier.php">Agenda<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/news.php">Actualités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/galerie.php">Galerie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/formulaire.php">Inscrire mon enfant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/reglement.php">Règlement intérieur</a>
                    </li>
                    <?php if (isset($_SESSION['isConnect'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/Views/infoUser.php">Mes infos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Views/logOut.php?action=disconnect">Deconnexion</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/Views/connexion.php">Connexion/Inscription</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        

<?php } ?>