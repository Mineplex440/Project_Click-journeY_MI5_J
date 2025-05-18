<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" id="theme-style" href="style-light.css">
    <title>Exotic Birder</title>
</head>

<body class="Accueil" id="top">

        
    
    <div class="imgbox">
        <img class="background_image" src="img/forte.jpeg" alt="foret">
    </div>

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

        
    
    

        
        <div class="first">
            <p class="suivant"><u>Exotic Birder est un site spécialisé dans les voyages et les expéditions dédiées à l'observation des oiseaux éxotiques</u></p>

            <div class="recherche">
                <form action="L'ensemble_des_voyages.php" method="get">

                    <ul class="recherche-ul">

                        <li class="recherche-li-loca">
                            <input type="text" name="localisation" id="localisation" maxlength="30" placeholder="Pays, région, ville, nom d'oiseaux, ..." />
                        </li>
                        <li class="recherche-li">
                            <input type='text' name='prix' id='prix' maxlength='6' placeholder='Prix max en euros'>
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
                                <option value="7">Moins d'une semaine</option>
                                <option value="12">Une semaine (7 à 12 jours)</option>
                                <option value="17">Deux semaine (14 à 19 jours)</option>
                                <option value="20">Plus de deux semaine (plus de 20 jours)</option>
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
                        
                        echo "<label for='Voyage".$nb."'>";
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
                        echo"</label>";
                        $nb++;
                    }
                    
                }
                else{
                    for($i=0; $i<6; $i++) {
                        
                        echo "<label for='Voyage".($i+1)."'>";
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
                        echo"</label>";
                    }
                    
                }
            }
        ?>

        

        </div>
               

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


    <script src="fonction.js"></script>
</body>
</html>