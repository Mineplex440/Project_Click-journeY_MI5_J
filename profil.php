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
                if(isset($_SESSION["email"])&&isset($_SESSION["password"])){    //if you changed page before

                    $table=searchjson($_SESSION["email"]);
                    if($table["password"]==$_SESSION["password"]){
                        $connected= 1;
                    }
                    else{
                        header("location: pageAcceuil.php");    //if you are not connected redirect to the homepage

                    }
                }
            } 
        
        echo"
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
    
        echo"    <input id='menucheck' type='checkbox' class='menu-cb'>
    
            <nav class='menu-nv'>
                <ul class='menu-ul'>
                    <li class='menu-li'><a href='pageAcceuil.html'>Page d'acceuil</a></li>
                    <li class='menu-li'><a href='profil.html'>Mon profil</a></li>
                    <li class='menu-li'><a href='L'ensemble_des_voyages.html'>L'ensemble de nos voyages</a></li>
                    <li class='menu-li'><a href='Apropos.html'>A propos de nous</a></li>
                    <li class='menu-li'><a href='admin.html'>page administateur</a></li>
                </ul class='menu-ul'>
            </nav>
    
        </div>

        <br>

        ";
        if($connected== 1){
            $save=searchjson($_SESSION["email"]);
        }
        echo"
        <table class='t-profil'>
            <tr class='tr-profil'> 
                <th colspan='3'> Profil : </th>
            </tr>
            <tr class='tr-profil'>
                <th class='th-profil'> Photo de profil : </th>
                <td> <img class='img-profil' src='img/logo.png' alt='logo'/> </td>
                <th><button class='button-profil'><img src='img/modif.png' alt='modifier'></button></th>
            </tr>
            <tr class='tr-profil'>
                <th class='th-profil'> Prenom : </th>
                <th class='th-profil'> ".$save["prenom"]."</th>
                <th><button class='button-profil'><img src='img/modif.png' alt='modifier'></button></th>
            </tr>
            <tr class='tr-profil'>
                <th class='th-profil'> Nom : </th>
                <th class='th-profil'> ".$save["nom"]." </th>
                <th><button class='button-profil'><img src='img/modif.png' alt='modifier'></button></th>
            </tr>
            <tr class='tr-profil'>
                <th class='th-profil'> Adresse Email : </th>
                <th class='th-profil'> ".$save["email"]." </th>
                <th><button class='button-profil'><img src='img/modif.png' alt='modifier'></button></th>
            </tr>
            <tr class='tr-profil'>
                <th class='th-profil'> Date de naissance : </th>
                <th class='th-profil'>01-01-2000</th>
                <th><button class='button-profil'><img src='img/modif.png' alt='modifier'></button></th>
            </tr>
            <tr class='tr-profil'>
                <th class='th-profil'> Sexe : </th>
                <th class='th-profil'> non renseigné </th>
                <th><button class='button-profil'><img src='img/modif.png' alt='modifier'></button></th>
            </tr>
            <tr class='tr-profil'>
                <th class='th-profil'> Code : </th>
                <th class='th-profil'> ".$save["password"]." </th>
                <th><button class='button-profil'><img src='img/modif.png' alt='modifier'></button></th>
            </tr>

        </table>";
        ?>

    </body>



</html>