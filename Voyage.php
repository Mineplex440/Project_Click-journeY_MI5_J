<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Exotic Birder</title>
</head>
<body class='Accueil'>
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
                    <li class="menu-li"><a href="Apropos.html">A propos de nous</a></li>
                    
                    <?php
                        if($_SESSION["admin"] == 1){
                            echo "<li class='menu-li'><a href='admin.php'>Page administateur</a></li>";
                        }
                        if(isset($_SESSION["panier"])){
                            echo "<li class='menu-li'>Panier : ".$_SESSION["panier"]."€</li>";
                        }
                    ?>
                </ul class="menu-ul">
            </nav>

                    
        </div>
                    
        <?php

            $id = -1;

            foreach($_GET as $key=>$elm){
                $id = $key-1;
            }
            
            $array = json_decode(file_get_contents("voyage.json"), true);

            echo " <h1 class='Voyageh1'>".$array[$id]["titre"]."</h1>";

            echo "<img class='imgVoyage' src='".$array[$id]["image"]."' alt='image_du_voyage'>";

            echo "<h3>Spécificités</h3>
            <ul>";
                foreach($array[$id]["spécificités"] as $elm){
                    echo "<li>".$elm."</li>";
                }
            echo "</ul>";

            echo "<h3>Dates</h3>
                <ul>
                <li>Début du voyage : ".$array[$id]["dates"]["début"]."</li>
                <li>Fin du voyage : ".$array[$id]["dates"]["fin"]."</li>
                <li>Durée du voyage : ".$array[$id]["dates"]["durée"]." jours</li>
                </ul>";


            echo "<h3>Etapes</h3>
            <ul>";

            foreach($array[$id]["étapes"] as $elm){
                echo "<li>".$elm."</li>";
            }
            
    
            echo "</ul>";

            echo "<h3>Prix : ".$array[$id]["prix_total"]."€</h3>
                    <form action='Reservation.php'>
                    <input type='submit' value='Je réserve' name=".$array[$id]["id"]." id='Voyage".($id+1)."'>
                  </form>";

        ?>
               

        <footer class="foot">

            <hr>

            <p class="copyright">Tous droits réservés</p>
            <p class="copyright">&copy; 2025 Exotic Birder</p>

        </footer>


    
</body>
</html>