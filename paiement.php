<!DOCTYPE html>

<title></title>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' href='style-light.css' id="theme-style">
</head>
<body>
<?php

if(session_status()==PHP_SESSION_NONE){
    session_start();
}
if(!isset($_SESSION["connected"])){
        $_SESSION["connected"] = 0;
}
if(!isset($_SESSION["admin"])){
        $_SESSION["admin"] = 0;
}


echo "<div class='menu-top'>

    <div class='lo'>
        <img class='logo' src='img/logo.png' alt='logo'>";

if($_SESSION["connected"]==0){
    echo "<div class = a-utilisateur>
    <ul>
        <li><a href='formulaire_connection.html'>Se connecter</a></li>
        <li><a href='formulaire_inscription.html'>S'inscrire</a></li>
    </ul>
</div>";
}
else{
    echo "<div class = a-utilisateur>
    <ul>
        <li>
            <a href='disconnect.php'>Se déconnecter</a>
        </li>
    </ul>
</div>";   
}
echo "</div>"
?>

    <div class="titre">
        <h1 class="titr">Exotic Birder</h1>
        <h6 class="titr">Les plus beaux parcours d'observation d'oiseaux exotiques</h6>
    </div>
    
    

    <div class="deroule">
        <label for="menucheck" class="menu-lb">
            <img class="img-menu" src="img/menu_deroulant.png" alt="bird" />
        </label>
    </div>

    <input id="menucheck" type="checkbox" class="menu-cb">

    <nav class="menu-nv">
        <ul class="menu-ul">
            <li class="menu-li"><a href="pageAcceuil.php">Page d'accueil</a></li>
            <?php 
                if($_SESSION["connected"] == 1){
                    echo "<li class='menu-li'><a href='profil.php'>Profil</a></li>";
                }
            ?>
            <li class="menu-li"><a href="L'ensemble_des_voyages.php">L'ensemble de nos voyages</a></li>
            <li class="menu-li"><a href="Apropos.php">A propos de nous</a></li>
            
            <?php
                if($_SESSION["admin"] == 1){
                    echo "<li class='menu-li'><a href='admin.php'>Page administateur</a></li>";
                }
                if(isset($_SESSION["panier"])){
                    echo "<li class='menu-li'><a href='panier.php'>Panier : ".$_SESSION["panier"]."€</a></li>";
                }
            ?>
            <li class="menu-li" id="status">
                <select onchange="changerStyle(this.value)">
                            <option value="style-light.css">Clair</option>
                            <option value="style-dark.css">Sombre</option>
                </select>
            </li>
            
        </ul class="menu-ul">
    </nav>

</div>

    <fieldset class="payement">
    <legend class="payement">Panier</legend>
<?php

    include"page1.php";

    
    if(isset($_POST["status"])){

        $status=$_POST["status"];
        if($status== "denied"){
            
        }
        elseif($status== "accepted"){
            add_travel2($_SESSION["email"]);
            $_SESSION["Voyages_reserve"] = [];
            $_SESSION["panier"] = null;
        }
    }


    function getAPIKey($vendeur){
        if(in_array($vendeur, array('MI-1_A', 'MI-1_B', 'MI-1_C', 'MI-1_D', 'MI-1_E', 'MI-1_F', 'MI-1_G', 'MI-1_H', 'MI-1_I', 'MI-1_J', 'MI-2_A', 'MI-2_B', 'MI-2_C', 'MI-2_D', 'MI-2_E', 'MI-2_F', 'MI-2_G', 'MI-2_H', 'MI-2_I', 'MI-2_J', 'MI-3_A', 'MI-3_B', 'MI-3_C', 'MI-3_D', 'MI-3_E', 'MI-3_F', 'MI-3_G', 'MI-3_H', 'MI-3_I', 'MI-3_J', 'MI-4_A', 'MI-4_B', 'MI-4_C', 'MI-4_D', 'MI-4_E', 'MI-4_F', 'MI-4_G', 'MI-4_H', 'MI-4_I', 'MI-4_J', 'MI-5_A', 'MI-5_B', 'MI-5_C', 'MI-5_D', 'MI-5_E', 'MI-5_F', 'MI-5_G', 'MI-5_H', 'MI-5_I', 'MI-5_J', 'MEF-1_A', 'MEF-1_B', 'MEF-1_C', 'MEF-1_D', 'MEF-1_E', 'MEF-1_F', 'MEF-1_G', 'MEF-1_H', 'MEF-1_I', 'MEF-1_J', 'MEF-2_A', 'MEF-2_B', 'MEF-2_C', 'MEF-2_D', 'MEF-2_E', 'MEF-2_F', 'MEF-2_G', 'MEF-2_H', 'MEF-2_I', 'MEF-2_J', 'MIM_A', 'MIM_B', 'MIM_C', 'MIM_D', 'MIM_E', 'MIM_F', 'MIM_G', 'MIM_H', 'MIM_I', 'MIM_J', 'SUPMECA_A', 'SUPMECA_B', 'SUPMECA_C', 'SUPMECA_D', 'SUPMECA_E', 'SUPMECA_F', 'SUPMECA_G', 'SUPMECA_H', 'SUPMECA_I', 'SUPMECA_J', 'TEST'))) {
            return substr(md5($vendeur), 1, 15);
        }
        return "zzzz";
    }
    
    
    
    
    
    $montant=0;

    if(!isset($_SESSION["panier"])){
        header("location: pageAcceuil.php");
    }

    if(isset($_SESSION["panier"])){
        if ($_SESSION["panier"] > 0){
            $montant = $_SESSION["panier"];
        }
    }

    if(isset($_SESSION["Voyages_reserve"])){
        foreach($_SESSION["Voyages_reserve"] as $travels){
            if(file_exists("voyage.json")){
                $voy = json_decode(file_get_contents("voyage.json"), true);
                echo"<div class='payement'><p>".$voy[$travels]["titre"]."</p></div>";
            }
        }
        echo"<p> montant : ".$montant."</p>";
    }else{
        header("location: pageAcceuil.php");  
    }
    $transaction="154632ABCD";
    $vendeur="MI-5_J";
    $retour="http://localhost/paiement.php?session=s";
    $api_key=getAPIKey($vendeur);
    $control=md5($api_key. "#" .$transaction. "#" . $montant. "#" .$vendeur. "#" . $retour . "#" );

echo"<form action='coordonne_banque.php' method='POST'>
    <input type='hidden' name='transaction' value=".$transaction.">
    <input type='hidden' name='montant' value=".$montant.">
    <input type='hidden' name='vendeur' value=".$vendeur.">
    <input type='hidden' name='retour' value=".$retour.">
    <input type='hidden' name='control' value=".$control.">
    <input class='payement' type='submit' value='Valider et payer'>
    </form>";
?>

</fieldset>

<script src="fonction.js"></script>


</body>

<footer class="foot">

            <br>

            <div class="footer-content">
                <h3>Exotic Birder</h3>
                <p>Explorez le monde à travers nos voyages et expéditions dédiés à l’observation des oiseaux exotiques. Vivez des expériences uniques au cœur des plus beaux habitats naturels.</p>
                
                <div class="footer-links">
                <div class="footer-section">
                    <h4>Liens utiles :</h4>
                    <ul>
                    <li><a href="L'ensemble_des_voyages.php">Destinations</a></li>
                    <li><a href="Apropos.php">À propos</a></li>
                    <li><a href="#top">Haut de la page</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Contactez-nous :</h4>
                    <p>Email : <a href="mailto:contact@exoticbirder.com">contact@exoticbirder.com</a></p>
                    <p>Téléphone : +33 1 23 45 67 89</p>
                    <p>Adresse : 12 rue des Oiseaux, 75000 Paris, France</p>
                </div>
                
                <div class="footer-section">
                    <h4>Suivez-nous :</h4>
                    <a href="#" aria-label="Facebook"><img src="icons/facebook.svg.png" alt="Facebook" /></a>
                    <a href="#" aria-label="Instagram"><img src="icons/instagram.svg.png" alt="Instagram" /></a>
                    <a href="#" aria-label="Twitter"><img src="icons/twitter.svg.png" alt="Twitter" /></a>
                    <a href="#" aria-label="LinkedIn"><img src="icons/linkedIn.svg.png" alt="LinkedIn" /></a>
                </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Exotic Birder. Tous droits réservés.</p>
            </div>

        </footer>
</html>