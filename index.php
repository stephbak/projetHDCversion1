<?php
session_start();
include 'header.php';
?>
<div class="row col-lg-12">
    <div class="card-body col-lg-6" id="presentation">
        <h2 class="card-title">Qui sommes-nous?</h2>
        <p class="card-text"><strong>Happy Dance Club</strong> est une association de loi 1901 et qui a vu le jour en 2017 et qui propose des cours de danse moderne pour les enfants âgés d'au moins 3 ans jusqu'aux jeunes adultes.</p>
        <p class="card-text">Tout les ans, nous organisons un gala de fin d'année, afin de présenter aux parents et au public ce que nos danseurs et danseuses on préparer tout au long de l'année.</p>
        <p class="card-text"><strong>Happy Dance Club</strong> se compose de 4 bénevoles : </p>
        <div class="row col-lg-12">
            <div class="col-lg-6">
                <p class="member">Le Président : Stéphane Bakum</p>
                <p class="member">La Trésorière : Angélique Chane-Ashing</p>
                <p class="member">La Secrétaire : Corinne Bakum</p>
                <p class="member">Professeur de danse : Camille Isambert</p>
            </div>
            <div class="col-lg-6">
                <!--a href : pour ouvrir l'image en grand et target= _blank pour ouvrir l'image sur une autre page-->
                <a href="assets/img/membres.png" target="_blank"><img class="img-fluid" src="assets/img/membres.png" alt="member" /></a>
            </div>
        </div>
    </div>
    <div id="img" class="row col-lg-6 justify-content-center">
        <a href="assets/img/spectacle 10 juin 2018/spectacle_10_juin_2018_3.png" target="_blank"><img class="img-fluid" src="assets/img/spectacle 10 juin 2018/spectacle_10_juin_2018_3.png" alt="show" /></a>
        <div class="row offset-1-col-lg-3 justify-content-center">
            <a href="assets/img/salon du tatouage/salon_du_tatouage_2018_1.png" target="_blank"><img id="img1" class="img-fluid" src="assets/img/salon du tatouage/salon_du_tatouage_2018_1.png" alt="show" /></a>
        </div>
        <div class="row offset-1-col-lg-3 justify-content-center">
            <a href="assets/img/spectacle 21 mai 2018/21_mai_2018_4.png" target="_blank"><img id="img1" class="img-fluid" src="assets/img/spectacle 21 mai 2018/21_mai_2018_4.png" alt="show" /></a>
        </div>
        <div class="row offset-1-col-lg-3 justify-content-center">
            <a href="assets/img/Arbre de Noël 2017/arbre_de_noel_2017_3.png"  target="_blank">
                <img id="img1" class="img-fluid" src="assets/img/Arbre de Noël 2017/arbre_de_noel_2017_3.png" alt="christmas" />
            </a>
        </div>
    </div>
</div>
<div class="row col-lg-12">
    <div class="card-body" id="contact">
        <h2 class="card-title">Nous contacter</h2>
        <ul>
            <li><i class="fas fa-phone-square"></i><a id="phoneContact1"> Stéphane Bakum : 06.29.93.37.49</a></li>
            <li><i class="fas fa-phone-square"></i><a id="phoneContact2"> Corinne Bakum : 06.20.62.42.52</a></li>
            <li><i class="fas fa-envelope" ></i><a id="mail" href="mailto:happydanceclub@sfr.fr"> happydanceclub@sfr.fr </a></li>
            <li><i class="fab fa-facebook"></i><a id="facebook" href="https://www.facebook.com/Happy-Dance-Club-441233279592951/"> Happy Dance Club</a></li>
        </ul>
    </div>
</div>
<div class="card-body" id="location">
    <h2 class="card-title">Nous trouver</h2>
    <div class="row col-lg-12 justify-content-center">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2591.5777194259917!2d3.005728450544385!3d49.49248326370319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e8709cf7ce4187%3A0x511b382586e4146e!2sRue+Pierre+et+Marie+Curie%2C+60170+Tracy-le-Val!5e0!3m2!1sfr!2sfr!4v1547734983197" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>        
    </div>
</div>
<?php
include 'footer.php';
?>

