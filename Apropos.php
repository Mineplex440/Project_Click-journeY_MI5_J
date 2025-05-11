<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Exotic Birder A propos</title>
	</head>

    <body class="Voyage">

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
            
        </ul class="menu-ul">
    </nav>

    </div>

        <br/>



        <div class="div-apropos">
            <fieldset class="fieldset-apropos">
                <p class="titre">A propos de nous : </p>
                <p class="para">Nous sommes un groupe d'étudiants de CY-Tech.</p>
            </fieldset>
        </div>



    </body>



</html>