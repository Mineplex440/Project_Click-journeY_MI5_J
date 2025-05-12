<?php echo"
<!DOCTYPE html>

<title></title>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body class='admin'>";
    
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

            //page allocation

            $all_table=[];
            $data=json_decode(file_get_contents('account.json'),true);
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
            </div>";
            

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
                <button class='vip' id='".$file["email"]."_vip' onclick=\"modif(true,'".$file["email"]."')\">V.I.P </button>
                <button class='banni'id='".$file["email"]."_banni' onclick=\"modif(true,'".$file["email"]."')\">Banni </button>
                <button class='standard' id='".$file["email"]."_standard' onclick=\"modif(true,'".$file["email"]."') \">Standard </button>
            </td>
        </tr>";
        }
        echo"<tr class='tr-admin'>
                <form action='admin.php' method='get'> <td colspan='4'align='center'> <button name='precedent' value=".strval($_SESSION["admin_page"]-1)."> precedent </button> ".$_SESSION["admin_page"]." <button name='suivant' value=".strval( ($_SESSION["admin_page"]+1) )."'1'> suivant </button></td> </form>
            </tr>";


    echo"</table>
    </body>
    </html>";
?>
<script src="/fonction.js">
    

</script>