    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Exotic Birder</title>
</head>
    <?php
        $connected=0;   //a variable that will be equal to 1 if the users is succsfully connected
        include"page1.php";
        if(session_status()==PHP_SESSION_NONE){
            session_start();
            if(isset($_POST["email"])&&isset($_POST["Code"])&&isset($_POST["prenom"])&&isset($_POST["nom"])&&isset($_POST["Age"])){ //check if it is an inscription
                $connected=1;
                $save=array("prenom"=>$_POST["prenom"],"nom"=> $_POST["nom"],"email"=> $_POST["email"],"password"=> $_POST["Code"],"date_of_birth"=>$_POST["Age"],"sex"=>$_POST["Sexe"]);
                new_account($save);
                $_SESSION["email"]=$_POST["email"];
                $_SESSION["password"]=$_POST["Code"];
            }
            elseif(isset($_POST["email"])&&isset($_POST["Code"])){  //if you just connected
                $table=searchjson($_POST["email"]);
                if($table["password"]==$_POST["Code"]){ //check if the password is correct
                        $connected=1;
                        $_SESSION["email"]=$_POST["email"];
                        $_SESSION["password"]=$_POST["Code"];
            
                    /*$array=array("prenom","nom","email","age","code") ;
                    foreach($array as $value){
                        $_SESSION[$value]=$_POST[$value] ;
                        echo $_SESSION[$value]."<br><br><br>" ;
                    }*/
                }
            }
            elseif(isset($_SESSION["email"])&&isset($_SESSION["password"])){    //if you changed page before
                $table=searchjson($_SESSION["email"]);
                if($table["password"]==$_SESSION["password"]){
                    $connected= 1;
                }
            }
        }
        


    
    echo "<body class='Accueil'>

    <div class='menu-top'>

        <img class='logo' src='img/logo.png' alt='logo'>
        
        <div class='deroule'>
            <label for='menucheck' class='menu-lb'>
                <img class='img-menu' src='img/menu_deroulant.png' alt='bird' />
            </label>
        </div>
        
        <h1 class='titre'>Exotic Birder</h1>
        <h6 class='titre'>Les plus beaux parcours d'observation d'oiseaux exotiques</h6>";

        if($connected==0){
            echo "<div class = a-utilisateur>
            <ul>
                <li><a href='formulaire_connexion.html'>Se connecter</a></li>
                <li><a href='formulaire_inscription.html'>S'inscrire</a></li>
            </ul>
        </div>";
        }
        else{
            echo "<div class = a-utilisateur>
            <ul>
                <li>
                    <a href='disconnect.php'>Se deconnecter</a>
                </li>
            </ul>
        </div>";   
        }
?>
        <input id='menucheck' type='checkbox' class='menu-cb'>

        <nav class='menu-nv'>
            <ul class='menu-ul'>
                <li class='menu-li'><a href='pageAcceuil.php'>Page d'acceuil</a></li>
                <li class='menu-li'><a href='profil.php'>Mon profil</a></li>
                <li class='menu-li'><a href='L'ensemble_des_voyages.html'>L'ensemble de nos voyages</a></li>
                <li class='menu-li'><a href='Apropos.html'>A propos de nous</a></li>
                <li class='menu-li'><a href='admin.php'>page administateur</a></li>
            </ul class='menu-ul'>
        </nav>

    </div>
    
    

   

    <p class='suivant'><u>Exotic Birder est un site spécialisé dans les voyages et les expéditions dédiées à l'observation des oiseaux éxotiques</u></p>

    <div class='recherche'>
        <form action='p.php' method='get'>

            <ul class='recherche-ul'>

                <li class='recherche-li-loca'>
                    <input type='text' name='localisation' id='localisation' maxlength='30' placeholder='Pays, région, ville, nom d'oiseaux, ...' />
                </li>
                <li class='recherche-li'>
                    <input type='date' name='date' />
                </li>
                <li class='recherche-li'>

                    <select name='type_sejour' id='type_sejour'>
                        <option value='tout-endroit'>l'ensemble des parcours</option>
                        <option value='foret'>Principalement en forêt</option>
                        <option value='aquatique'>Principalement en zone aquatique</option>
                        <option value='montagne'>Principalement en montagne</option>
                        <option value='special'>Parcours spécial de l'aventurier</option>
                    </select>

                </li>
                <li class='recherche-li'>
                    <select name='duree' id='duree'>
                        <option value='toute-duree'>Peux importe la durée</option>
                        <option value='moins-une-semaine'>Moins d'une semaine</option>
                        <option value='une-semaine'>Une semaine (7 à 12 jours)</option>
                        <option value='deux-semaine'>Deux semaine (14 à 19 jours)</option>
                        <option value='plus-long'>Plus de deux semaine (plus de 20 jours)</option>
                    </select>
                </li>
                <li class='recherche-li'>
                    <input type='submit' value='Rechercher' name='send' id='send' />
                </li>
            </ul>

        </form>
    </div>

    <h1 class='h1-cc1'><u>Nos voyages coups de coeurs :</u></h1>
    
    <div class='coups-de-coeur'>

        <div class='cc1'></div>

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

    <div class='boitedel'>
            <div class='box-voy'>
                <img src='img/Deux_oiseaux_bleu.jpeg' alt='voyage1'>
                <ul>
                    <li><u>Au coeur de la nature, Panama</u></li>
                    <ul>
                        <li>Située dans le Parc National Soberanía</li>
                        <li>Vue panoramique sur la canopée</li>
                        <li>Hébergement en pension complète</li>
                    </ul>
                </ul>
                <a href='environement-jungle.html'>Je reserve</a>
            </div>

            <div class='box-voy'>
                <img src='img/Quetzal.jpg' alt='voyage2'>
                <ul>
                    <li><u>Parque das Aves (Foz do Iguaçu), Bresil</u></li>
                    <ul>
                        <li>Parc dédié à la conservation des oiseaux exotiques</li>
                        <li>Rencontre rapprochée avec des perroquets, toucans et autres espèces tropicales</li>
                        <li>Expérience immersive dans un cadre protégé</li>
                    </ul>
                </ul>
                <a href='environement-jungle.html'>Je reserve</a>

            </div>

            <div class='box-voy'>
                <img src='img/Terra-oiseau.jpeg' alt='voyage3'>
                <ul>
                    <li><u>La forêt des rêves, Île Maurice</u></li>
                    <ul>
                        <li>Excursions pour observer des oiseaux endémiques (perruche de Maurice, pigeon rose)</li>
                        <li>Randonnée guidée à travers des forêts protégées</li>
                        <li>Hotel Paradis (comprend 9 restaurants, une vue sur la mer...)</li>
                    </ul>
                </ul>
                <a href='environement-jungle.html'>Je reserve</a>

            </div>

            <div class='box-voy'>
                <img src='img/petit-oiseau-rouge.avif' alt='voyage3'>
                <ul>
                    <li><u>Réserve Naturelle de Montezuma, Colombie</u></li>
                    <ul>
                        <li>Biodiversité riche près du Parc National Tatamá</li>
                        <li>Nombreuses espèces endémiques</li>
                        <li>Logement en lodges immersifs dans la nature</li>
                    </ul>
                </ul>
                <a href='environement-jungle.html'>Je reserve</a>

            </div>

            <div class='box-voy'>
                <img src='img/Oiseau_multicolor_jungle.jpg.avif' alt='voyage3'>
                <ul>
                    <li><u>Parc National d’Anavilhanas, Amazonie</u></li>
                    <ul>
                        <li>Ecosystème riche et diversifié de l'Amazonie</li>
                        <li>Observation en bateau des oiseaux tropicaux tels que le Coq-de-roche orange et le Jacamar à queue rousse.</li>
                        <li>Exploration de l’un des plus grands archipels fluviaux du monde</li>
                    </ul>
                </ul>
                <a href='environement-jungle.html'>Je reserve</a>

            </div>

            <div class='box-voy'>
                <img src='img/environement-special.jpg' alt='voyage3'>
                <ul>
                    <li><u>Parc National Sierra de Bahoruco, République Dominicaine</u></li>
                    <ul>
                        <li>Refuge pour 30 des 31 espèces endémiques du pays</li>
                        <li>Espèces observables : perruche d’Hispaniola, trogon d’Hispaniola</li>
                        <li>Hébergement disponible dans les villes voisines</li>
                    </ul>
                </ul>
                <a href='environement-jungle.html'>Je reserve</a>

            </div>
    </div>
    
        

    

    
</body>
</html>