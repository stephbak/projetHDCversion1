<?php
session_start();
include '../header.php';
?>
<form>
    <div class="connexion">
        <h3>Pour accéder au formulaire vous devez être connecté</h3>
        <h3><a href="newAccount.php">Créer un compte</a></h3>
        <h3><a href='accountExist.php'>J'ai déja un compte</a></h3>
    </div>
</form>
<div id="registration">
    <h2>Inscrire mon enfant</h2>
</div>
<form>
    <div id="informationChild">
        <fieldset>
            <legend>Coordonnées de votre enfant</legend>
            <div class="row col-lg-12 justify-content-center">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="name">Nom : </label>
                        <input type="text" class="form-control" placeholder="Nom *">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="firstname">Prénom : </label>
                        <input type="text" class="form-control" placeholder="Prénom *">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="birthDate">Date de naissance : </label>
                        <input type="text" class="form-control" placeholder="Date de naissance *">
                    </div>
                </div>
            </div>
            <div class="row col-lg-12 justify-content-center" id="hideShow">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="name">Nom : </label>
                        <input type="text" class="form-control" placeholder="Nom *">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="firstname">Prénom : </label>
                        <input type="text" class="form-control" placeholder="Prénom *">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="birthDate">Date de naissance : </label>
                        <input type="text" class="form-control" placeholder="Date de naissance *">
                    </div>
                </div>           
            </div>
            <div class="col-lg-12 justify-content-center">
                <button id="show" type="button">Ajouter un enfant</button>
                <button id="hide" type="button">Supprimer un enfant</button>
            </div>
            <small id="emailHelp">* champs obligatoire</small>
        </fieldset>
    </div>
    <div id="informationParents">
        <fieldset>
            <legend>Coordonnées des parents</legend>
            <div class="row col-lg-12 justify-content-center">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Nom : </label>
                        <input type="text" class="form-control" placeholder="Nom *">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="firstname">Prénom : </label>
                        <input type="text" class="form-control" placeholder="Prénom *">
                    </div>
                </div>
            </div>
            <div class="row col-lg-12 justify-content-center">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="phoneNumber">Numéro de téléphone : </label>
                        <input type="text" class="form-control" placeholder="n° de téléphone *">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="mail">Email : </label>
                        <input type="text" class="form-control" placeholder="Email *">
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div id="emergency">
        <fieldset>
            <legend>Personnes à prévenir en cas d'urgence</legend>
            <div class="row col-lg-12 justify-content-center">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="name">Nom : </label>
                        <input type="text" class="form-control" placeholder="Nom *">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="firstname">Prénom : </label>
                        <input type="text" class="form-control" placeholder="Prénom *">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="phoneNumber">Numéro de téléphone : </label>
                        <input type="text" class="form-control" placeholder="Numéro de téléphone *">
                    </div>
                </div>
            </div>
                        <div class="row col-lg-12 justify-content-center" id="hideShowContact">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="name">Nom : </label>
                        <input type="text" class="form-control" placeholder="Nom *">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="firstname">Prénom : </label>
                        <input type="text" class="form-control" placeholder="Prénom *">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="phoneNumber">Numéro de téléphone : </label>
                        <input type="text" class="form-control" placeholder="Numéro de téléphone *">
                    </div>
                </div>
            </div>
             <div class="col-lg-12 justify-content-center">
                <button id="showEmergencyContact" type="button">Ajouter un contact</button>
                <button id="hideEmergencyContact" type="button">Supprimer un contact</button>
            </div>
            <input type="checkbox" name="choix" /><label>Si aucune personne n'est joignable, j'autorise l'association à contacter les services de secours. *</label>
        </fieldset>
    </div>
    <div id='imageRights'>
        <fieldset>
            <legend>Droit à l'image </legend>
            <input type="radio" name="image" value="authorisation" /><label>J'autorise</label>
            <input type="radio" name="image" value="unauthorisation" /><label>n'autorise pas la diffusion de l'image de mon enfant *</label>
        </fieldset>
    </div>
    <div id='payment'>
        <fieldset>
            <legend>Modalités de paiement</legend>
            <p>Je règle le montant de la cotisation annuelle de 55 € ( chèque ou liquide ) en :</p>
            <input type="radio" name="payment" value="1" /><label> 1 fois</label>
            <input type="radio" name="payment" value="2" /><label> 2 fois</label>
            <input id="3" type="radio" name="payment" value="3" /><label> 3 fois *</label>
            <p>Les chèques doivent êtres remis lors de l'inscription, ils doivent être datés et signés (fin Décembre dernier délai pour l'encaissement du dernier chèque) .</p>
            <p>Le premier versement est de 20€ minimum.</p>
        </fieldset>
    </div>
    <div id='payment'>
        <fieldset>
            <legend>Règlement intérieur *</legend>
            <input type="checkbox" name="reglement" value="1" /><label>J'ai bien pris connaissance du <a href='reglement.php'>réglement intérieur</a> et m'engage à l'appliquer et le faire appliquer par mon enfant.</label>
        </fieldset>
    </div>
    <div  class="submit row col-lg-12 justify-content-center">
        <input  type="submit" value="Envoyer" name="submit" />
    </div>
    
</form>
<?php
include '../footer.php';
?>