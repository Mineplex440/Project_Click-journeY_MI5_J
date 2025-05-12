<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="style.css">
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

            if(isset($_POST["change_image"])){
                move_uploaded_file($_POST["change_image"], "/images/profil".$_SESSION["email"]);
            }
            if(isset($_POST["change_prenom"])){
                $save["prenom"]=$_POST["change_prenom"];
                echo $save["prenom"];
                change_account($save);
            }
            if(isset($_POST["change_nom"])){
                $save["nom"]=$_POST["change_nom"];
                change_account($save);
            }
            if(isset($_POST["change_email"])){
                $save["email"]=$_POST["change_email"];
                change_account($save);
                $_SESSION["email"]=$_POST["change_email"];
            }
            if(isset($_POST["change_sexe"])){
                $save["sex"]=$_POST["change_sexe"];
                change_account($save);
            }
            if(isset($_POST["change_birth"])){
                $save["date_of_birth"]=$_POST["change_birth"];
                change_account($save);
            }
            if(isset($_POST["change_password"])){
                $save["password"]=$_POST["change_password"];
                change_account($save);
                $_SESSION["password"]=$_POST["change_password"];
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

        <br>
    <?php
        echo"
        <form action='profil.php' method='post'>
        <table class='t-profil'>
            <tr class='tr-profil'> 
                <th colspan='3'> Profil : </th>
            </tr>
            
            <tr class='tr-profil' id='photo_change'>
                <th class='th-profil'> Photo de profil : </th>
                <th class='th-profil' id='photo_information'> <img class='img-profil' src='image/profil".$_SESSION["email"].".png' alt='logo'/> </th>
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




</html>