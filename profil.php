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
                    $admin=$table["admin"];
                }
            }

            if($connected== 1){
                $save=searchjson($_SESSION["email"]);
            }

            }
            if(isset($_POST["change_image"])){
                move_uploaded_file($_POST["change_image"], "/images/profil".$_SESSION["email"]);
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
                header("location: pageAcceuil.php");    //if you are not connected redirect to the homepage
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
        echo"
            <input id='menucheck' type='checkbox' class='menu-cb'>
            <nav class='menu-nv'>
                <ul class='menu-ul'>
                    <li class='menu-li'><a href='pageAcceuil.php'>Page d'acceuil</a></li>";
                    if($connected==1){
                        echo "<li class='menu-li'><a href='profil.php'>Mon profil</a></li>";
                    }
                    echo"
                    <li class='menu-li'><a href='L'ensemble_des_voyages.html'>L'ensemble de nos voyages</a></li>
                    <li class='menu-li'><a href='Apropos.html'>A propos de nous</a></li>";
                    if($admin==1){
                        echo "<li class='menu-li'><a href='admin.php'>page administateur</a></li>";
                    }
                echo" 
                </ul class='menu-ul'>
            </nav>
        </div>
        <br>";


        echo"
        <form action='profil.php' method='post'>
        <table class='t-profil'>
            <tr class='tr-profil'> 
                <th colspan='3'> Profil : </th>
            </tr>
            
            <tr class='tr-profil' id='photo_change'>
                <th class='th-profil'> Photo de profil : </th>
                <th class='th-profil' id='photo_information'> <img class='img-profil' src=/images/profil".$_SESSION["email"]." alt='logo'/> </th>
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
        <script src="/fonction.js">
        </script>




    </body>



</html>