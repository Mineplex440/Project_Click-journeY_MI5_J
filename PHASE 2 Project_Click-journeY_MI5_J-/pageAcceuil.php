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
                    <li class="menu-li"><a href="Apropos.php">A propos de nous</a></li>
                    
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


        <div class="imgbox">
            <img class="background_image" src="img/forte.jpeg" alt="foret">
        </div>
    
    

        
        <div class="first">
            <p class="suivant"><u>Exotic Birder est un site spécialisé dans les voyages et les expéditions dédiées à l'observation des oiseaux éxotiques</u></p>

            <div class="recherche">
                <form action="L'ensemble_des_voyages.php" method="get">

                    <ul class="recherche-ul">

                        <li class="recherche-li-loca">
                            <input type="text" name="localisation" id="localisation" maxlength="30" placeholder="Pays, région, ville, nom d'oiseaux, ..." />
                        </li>
                        <li class="recherche-li">
                            <input type="date" name="date" />
                        </li>
                        <li class="recherche-li">

                            <select name="type_sejour" id="type_sejour">
                                <option value="tout-endroit">l'ensemble des parcours</option>
                                <option value="foret">Principalement en forêt</option>
                                <option value="aquatique">Principalement en zone aquatique</option>
                                <option value="montagne">Principalement en montagne</option>
                                <option value="special">Parcours spécial de l'aventurier</option>
                            </select>

                        </li>
                        <li class="recherche-li">
                            <select name="duree" id="duree">
                                <option value="toute-duree">Peux importe la durée</option>
                                <option value="moins-une-semaine">Moins d'une semaine</option>
                                <option value="une-semaine">Une semaine (7 à 12 jours)</option>
                                <option value="deux-semaine">Deux semaine (14 à 19 jours)</option>
                                <option value="plus-long">Plus de deux semaine (plus de 20 jours)</option>
                            </select>
                        </li>
                        <li class="recherche-li">
                            <input type="submit" value="Rechercher" name="send" id="send" />
                        </li>
                    </ul>

                </form>
            </div>
        </div>
        

       

        <div class="coups-de-coeur">
            <h1 class="h1-cc1"><u>Nos voyages coups de coeurs :</u></h1>
            <div class="cc1"></div>

            <ul>
                <li><u>Au coeur de la nature, Panama</u></li>
                <ul>
                    <li>Située dans le Parc National Soberanía</li>
                    <li>Vue panoramique sur la canopée</li>
                    <li>Budget : 2040 € par personne (tout compris : avion, logement...)</li>
                    <li>Hébergement en pension complète</li>
                </ul>
                <br/>
                <li><u>La forêt des rêves, Île Maurice</u></li>
                <ul>
                    <li>Excursions pour observer des oiseaux endémiques (perruche de Maurice, pigeon rose)</li>
                    <li>Randonnée guidée à travers des forêts protégées</li>
                    <li>Budget : 1500 € par personne (tout compris : avion, logement...)</li>
                    <li>Hotel Paradis (comprend 9 restaurants, une vue sur la mer...)</li>
                </ul>
                <li><u>Parc National de Tijuca, Brésil</u></li>
                <ul>
                    <li>Situé près de Rio de Janeiro, offre un accès facile aux ornithologues</li>
                    <li>Excursions guidées pour observer la faune aviaire locale</li>
                    <li>Budget : 1300 € par personne (tout compris : avion, logement...)</li>
                    <li>Espèces observables : Tangara à sept couleurs, Toucan à bec noir</li>
                </ul>
                <li><u>Parc National d’Anavilhanas, Amazonie</u></li>
                <ul>
                    <li>Ecosystème riche et diversifié de l'Amazonie</li>
                    <li>Observation en bateau des oiseaux tropicaux tels que le Coq-de-roche orange et le Jacamar à queue rousse.</li>
                    <li>Budget : 1600 € par personne (tout compris : avion, logement...)</li>
                    <li>Exploration de l’un des plus grands archipels fluviaux du monde</li>
                </ul>
            </ul>

        </div>

        <hr>

        <div class="boitedel">

        <?php
            if (file_exists("voyage.json")) {
                $nb = 1;
                $array = json_decode(file_get_contents("voyage.json"), true); 

                if(count($array) < 6){
                    foreach ($array as $voyage) {
                        
                        echo "<div class='box-voy'>
                            <img src=".$voyage["image"]." alt='voyage1'>
                            <ul>
                                <li><u>".$voyage["titre"]."</u></li>
                                <ul>";

                                foreach($voyage["spécificités"] as $ch){
                                    echo "<li>".$ch."</li>";
                                }
                                    
                        echo        "</ul>
                            </ul>
                            <form action='Voyage.php'>
                                <input type='submit' value='Je réserve' name=".$voyage["id"]." id='Voyage".$nb."'>
                            </form>
                            </div>
                            ";
                        $nb++;
                    }
                    
                }
                else{
                    for($i=0; $i<6; $i++) {
                        
                        echo "<div class='box-voy'>
                            <img src=".$array[$i]["image"]." alt='voyage1'>
                            <ul>
                                <li><u>".$array[$i]["titre"]."</u></li>
                                <ul>";

                                foreach($array[$i]["spécificités"] as $ch){
                                    echo "<li>".$ch."</li>";
                                }
                                    
                        echo        "</ul>
                            </ul>
                            <form action='Voyage.php'>
                                <input type='submit' value='Je réserve' name=".$array[$i]["id"]." id='Voyage".($i+1)."'>
                            </form>
                            </div>
                            ";
                    }
                    
                }
            }
        ?>

        </div>
               

        <footer class="foot">

            <hr>

            <p class="copyright">Tous droits réservés</p>
            <p class="copyright">&copy; 2025 Exotic Birder</p>

        </footer>


    
</body>
</html>