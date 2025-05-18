<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="style-light.css" id="theme-style">
        <title>Exotic Birder profil</title>
	</head>

    <body class="profil">

        <?php
            $connected=0;   //a variable that will be equal to 1 if the users is succsfully connected
            include"page1.php";

            

            if(session_status()==PHP_SESSION_NONE){
                session_start();
                if(!isset($_SESSION["connected"])){
                    $_SESSION["connected"] = 0;
                }
                if(!isset($_SESSION["admin"])){
                    $_SESSION["admin"] = 0;
                }

                if(isset($_SESSION["email"])&&isset($_SESSION["password"])){    //if you changed page before

                    $table=searchjson($_SESSION["email"]);
                    if($table["password"]==$_SESSION["password"]){
                        $connected= 1;
                        $save=searchjson($_SESSION["email"]);
                    }
                }
            }
            if($_SESSION["connected"] == 0){
                header("location:pageAcceuil.php");
            }
            if($_SESSION["connected"]== 1){
                $save=searchjson($_SESSION["email"]);
            }

            if(isset($_FILES["photo_change"])){
                $fileExt = pathinfo($_FILES["photo_change"]["name"], PATHINFO_EXTENSION);
                //echo($_FILES["photo_change"]['tmp_name'].$fileExt);
                move_uploaded_file($_FILES["photo_change"]['tmp_name'], __DIR__."/images/".$_SESSION["email"].".".$fileExt);
                    //var_dump($_FILES["photo_change"]["error"]);
            }
            if(isset($_POST["prenom_change"])){
                $save["prenom"]=$_POST["prenom_change"];
                echo $save["prenom"];
                change_account($save);
            }
            if(isset($_POST["nom_change"])){
                $save["nom"]=$_POST["nom_change"];
                change_account($save);
            }
            if(isset($_POST["email_change"])){
                $save["email"]=$_POST["email_change"];
                change_account($save);
                $_SESSION["email"]=$_POST["email_change"];
            }
            if(isset($_POST["sex_change"])){
                $save["sex"]=$_POST["sex_change"];
                change_account($save);
            }
            if(isset($_POST["date_change"])){
                $save["date_of_birth"]=$_POST["date_change"];
                change_account($save);
            }
            if(isset($_POST["password_change"])){
                $save["password"]=$_POST["password_change"];
                change_account($save);
                $_SESSION["password"]=$_POST["password_change"];
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

        <br>
    <?php
        echo"
        <form action='profil.php' method='post' enctype='multipart/form-data'>
        <table class='t-profil'>
            <tr class='tr-profil'> 
                <th colspan='3'> Profil : </th>
            </tr>
            
            <tr class='tr-profil' id='photo_change'>
                <th class='th-profil'> Photo de profil : </th>
                <th class='th-profil' id='photo_information'> <img class='img-profil' src=/images/".$_SESSION["email"].".jpg"." alt='logo'/> </th>
                <th><button class='button-profil'  type='button' onclick=\"change_photo()\"><img src='img/modif.png' alt='modifier'></button></th>
            </tr>

            <tr class='tr-profil' id='prenom_change'>
                <th class='th-profil'> Prenom : </th>
                <th class='th-profil' id='prenom_information'> ".$save["prenom"]."</th>
                <th><button class='button-profil'  type='button' onclick=\"change('prenom')\"><img src='img/modif.png' alt='modifier'></button></th>
            </tr>

            <tr class='tr-profil' id='nom_change'>
                <th class='th-profil'> Nom : </th>
                <th class='th-profil' id='nom_information'>".$save["nom"]."</th>
                <th><button class='button-profil'  type='button' onclick=\"change('nom')\"><img src='img/modif.png' alt='modifier'></button></th>
            </tr>
            
            <tr class='tr-profil' id='email_change'>
                <th class='th-profil'> Adresse Email : </th>
                <th class='th-profil' id='email_information'>".$save["email"]."</th>
                <th><button class='button-profil' id='email_button' type='button' onclick=\"change('email')\"> <img src='img/modif.png' alt='modifier'> </button></th>
            </tr>
            
            <tr class='tr-profil' id='date_change'>
                <th class='th-profil' > Date de naissance : </th>
                <th class='th-profil' id='date_information'>".$save["date_of_birth"]."</th>
                <th><button class='button-profil' type='button' onclick=\"change('date')\"> <img src='img/modif.png' alt='modifier'> </button></th>
            </tr>

            <tr class='tr-profil' id='sex_change'>
                <th class='th-profil'> Sexe : </th>
                <th class='th-profil' id='sex_information'>".$save["sex"]."</th>
                <th><button class='button-profil' type='button' onclick=\"change_sex()\"> <img src='img/modif.png' alt='modifier'> </button></th>
            </tr>

            <tr class='tr-profil' id='password_change'>
                <th class='th-profil'> Code : </th>
                <th class='th-profil' id='password_information'>".$save["password"]."</th>
                <th><button class='button-profil'  type='button' onclick=\"change('password')\"><img src='img/modif.png' alt='modifier'></button></th>
            </tr>

        </table>
        </form>";
        ?>
        <script src="fonction.js">
        </script>




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