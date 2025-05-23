
<!DOCTYPE html>
<html>
<title></title>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' href='style-light.css' id="theme-style">
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

        $all_table=[];
            $data=json_decode(file_get_contents('save.json'),true);
            foreach($data as $file){
                $all_table[]=array("prenom"=>$file["prenom"], "nom"=>$file["nom"],"email"=> $file["email"]);
            }
            for($i=0; $i<count($all_table)/5;$i++){
                $all[$i]=array_slice($all_table,$i*5,($i+1)*5);
            }
            

            

            if(isset($_GET["suivant"])){
                if( intval($_GET["suivant"])<=count($all)-1 ){
                    $_SESSION["admin_page"]=intval($_GET["suivant"]);
                }
            }
            elseif(isset($_GET["precedent"])){
                if( intval($_GET["precedent"])>=0 ){
                    $_SESSION["admin_page"]=intval($_GET["precedent"]);
                }
                
            }
            else{
                $_SESSION["admin_page"]=0;
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
            


    <br/>
    <br/>
    <br/>



<?php
    echo"
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
        </tr>";
                    
        foreach($all[$_SESSION["admin_page"]] as $file){    //browse throught the file 
            echo "<tr class='tr-admin'>         
            <td id='td-admin' class='title_name'>".$file["prenom"].
            "</td><td id='td-admin' class='title_first_name'>".$file["nom"].
            " </td><td id='td-admin' class='title_mail'> ".$file["email"].
            "<td id='td-admin' class='button_choix_l'>
                <button class='vip' id='".$file["email"]."_admin' onclick=\"true_modif('".$file["email"]."',1)\">Admin </button>
                <button class='banni'id='".$file["email"]."_banni' onclick=\"supr('".$file["email"]."')\">Banni </button>
                <button class='standard' id='".$file["email"]."_standard' onclick=\"true_modif('".$file["email"]."',0) \">Standard </button>
            </td>
        </tr>";
        }
        echo"<tr class='tr-admin'>
                <form action='admin.php' method='get'> <td colspan='4'align='center'> <button name='precedent' value=".strval($_SESSION["admin_page"]-1)."> precedent </button> ".$_SESSION["admin_page"]." <button name='suivant' value=".strval( ($_SESSION["admin_page"]+1) )."'1'> suivant </button></td> </form>
            </tr>";

?>
    
        </table>
        <script src="fonction.js"></script>
        <script src="admin.js"></script>
    </body>

</html>