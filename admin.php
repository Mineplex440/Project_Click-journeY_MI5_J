
<!DOCTYPE html>

<title></title>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body class='admin'>;

<?php 
        $connected=0;   //a variable that will be equal to 1 if the users is succsfully connected
        include"page1.php";

        if(session_status()==PHP_SESSION_NONE){
            session_start();
        }
        if(!isset($_SESSION["connected"])){
                $_SESSION["connected"] = 0;
        }
        if(!isset($_SESSION["admin"])){
                $_SESSION["admin"] = 0;
        }

        if(!isset($_SESSION["connected"]) || !isset($_SESSION["admin"])){
            header("location:transverse.php");
        }
            
            
            
            /*if(session_status()==PHP_SESSION_NONE){
                if(isset($_SESSION["email"])&&isset($_SESSION["password"])){    //if you changed page before
                $table=searchjson($_SESSION["email"]);
                if($table["password"]==$_SESSION["password"]){
                    $connected= 1;
                    $admin=$table["admin"];
                }
            }
        }*/

        echo "

        <div class='menu-top'>

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
            


    <br/>
    <br/>
    <br/>




    <h1 class='titre_admin'>
         Page administrateur
    </h1>     
     <table class='table-admin' align='center'>
        <tr class='tr-admin'>
            <td id='td-admin' align='left' colspan='4'>
                <h2 class='title_liste_user'>
                    <b>
                        Liste d'utilisateurs:
                    </b>
                </h2>
            </td>
        </tr>




        <tr class='tr-admin'>
            <th id='th-admin' class='title_name'> Prenom </th>
            <th id='th-admin' class='title_first_name'> Nom </th>
            <th id='th-admin' class='title_mail'> Mail </th>
            <th id='th-admin' class='title_action'> Action </th>
        </tr>;
<?php                   
        $data=json_decode(file_get_contents('save.json'),true);
        foreach($data as $file){    //browse throught the file 
            echo "<tr class='tr-admin'>         
            <td id='td-admin' class='title_name'>".$file["prenom"].
            "</td><td id='td-admin' class='title_first_name'>".$file["nom"].
            " </td><td id='td-admin' class='title_mail'> ".$file["email"].
            "<td id='td-admin' class='button_choix_l'>
                <button class='vip'>V.I.P</button>
                <button class='banni'>Banni</button>
                <button class='standard'>Standard</button>
            </td>
        </tr>";
        }

        

    echo"</table>
    </body>
    </html>";
?>