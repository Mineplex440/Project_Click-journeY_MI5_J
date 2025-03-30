<!DOCTYPE html>

<title></title>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body class="admin">


    <div class="menu-top">

        <img class="logo" src="img/logo.png" alt="logo">
        
        <div class="deroule">
            <label for="menucheck" class="menu-lb">
                <img class="img-menu" src="img/menu_deroulant.png" alt="bird" />
            </label>
        </div>
        
        <h1 class="titre">Exotic Birder</h1>
        <h6 class="titre">Les plus beaux parcours d'observation d'oiseaux exotiques</h6>

        <div class = a-utilisateur>
            <ul>
                <li><a href="formulaire_connection.html">Se connecter</a></li>
                <li><a href="formulaire_inscription.html">S'inscrire</a></li>
            </ul>
        </div>

        <input id="menucheck" type="checkbox" class="menu-cb">

        <nav class="menu-nv">
            <ul class="menu-ul">
                <li class="menu-li"><a href="pageAcceuil.php">Page d'acceuil</a></li>
                <li class="menu-li"><a href="profil.html">Mon profil</a></li>
                <li class="menu-li"><a href="L'ensemble_des_voyages.html">L'ensemble de nos voyages</a></li>
                <li class="menu-li"><a href="Apropos.html">A propos de nous</a></li>
                <li class="menu-li"><a href="admin.html">page administateur</a></li>
            </ul class="menu-ul">
        </nav>

    </div>

    <br/>




    <h1 class="titre_admin">
         Page administrateur
    </h1>     
     <table class="table-admin" align="center">
        <tr class="tr-admin">
            <td id="td-admin" align="left" colspan="4">
                <h2 class="title_liste_user">
                    <b>
                        Liste d'utilisateurs:
                    </b>
                </h2>
            </td>
        </tr>




        <tr class="tr-admin">
            <th id="th-admin" class="title_name"> Prenom </th>
            <th id="th-admin" class="title_first_name"> Nom </th>
            <th id="th-admin" class="title_mail"> Mail </th>
            <th id="th-admin" class="title_action"> Action </th>
        </tr>

        <?php
                if(session_status()==PHP_SESSION_NONE){
                    session_start();
                    }
                    
        $data=json_decode(file_get_contents("account.json"),true);
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

        
        if(isset($_SESSION["email"])){
            echo$_SESSION["email"]; 
        }
        ?> 
    </table>





</body>