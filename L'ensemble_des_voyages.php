<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Exotic Birder</title>
</head>
<body class="tout-voy">

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
                <li class="menu-li"><a href="Apropos.html">A propos de nous</a></li>
                
                <?php
                    if($_SESSION["admin"] == 1){
                        echo "<li class='menu-li'><a href='admin.php'>Page administateur</a></li>";
                    }
                ?>
            </ul class="menu-ul">
        </nav>

        </div>


    <h1 class="ensemble-titre"><u>Rechercher parmis toutes nos offres</u></h1>

    <div class="recherche">
        <form action="L'ensemble_des_voyages.php" method="get">

            <ul class="recherche-ul">

                <li class="recherche-li-loca">
                    <input type="text" name="localisation" id="localisation" maxlength="30" placeholder="Pays, région, ville, nom d'oiseaux, ..." />
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
                        <option value="moins-une-semaine">Moins d'une semaine</option>
                        <option value="une-semaine">Une semaine (7 à 12 jours)</option>
                        <option value="deux-semaine">Deux semaine (14 à 19 jours)</option>
                        <option value="plus-long">Plus de deux semaine (plus de 20 jours)</option>
                    </select>
                </li>
                <li class="recherche-li">
                    <input type="submit" value="Rechercher" name="send" id="send" />
                </li>
            </ul>

        </form>
    </div>

    <hr>


    <div class="boitedel">

        <?php
            if (file_exists("voyage.json")) {
                $nb = 1;
                $array = json_decode(file_get_contents("voyage.json"), true); 

                if(!empty($array) && !isset($_GET["localisation"]) && !isset($_GET["date"]) && !isset($_GET["type_sejour"]) && !isset($_GET["duree"])){
                    foreach ($array as $voyage) {
                        
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
                                <input type='submit' value='Je réserve' name=".$voyage["titre"]." id='Voyage".$nb."'>
                            </form>
                            </div>
                            ";
                        $nb++;
                    }
                }

                elseif (isset($_GET["localisation"]) && isset($_GET["date"]) && isset($_GET["type_sejour"]) && isset($_GET["duree"])) {
                    $valid1 = [];
                    $valid2 = [];
                    $valid3 = [];
                    $valid4 = [];

                    $valid = [];

                    for($i=0; $i<count($array); $i++){
                        if(!empty($_GET["localisation"])){
                            if (in_array($_GET["localisation"], explode(" ",$array[$i]["titre"]))){

                                $valid1[] = $i;

                            }

                            foreach($array[$i]["étapes"] as $etapes){
                                if(in_array($_GET["localisation"], explode(" ",$etapes))){
                                    if(!in_array($i, $valid1)){
                                        $valid1[] = $i;
                                    }
                                }
                            }

                            foreach($array[$i]["spécificités"] as $specificites){
                                if(in_array($_GET["localisation"], explode(" ",$specificites))){
                                    if(!in_array($i, $valid1)){
                                        $valid1[] = $i;
                                    }
                                }
                            }
                        }

                        if(!empty($_GET["date"])){
                            if ($_GET["date"] == $array[$i]["dates"]["début"]){
                                if(!in_array($i, $valid2)){
                                    $valid2[] = $i;
                                }
                            }
                        }


                        
                        

                        if(!empty($_GET["duree"])){
                            if ($_GET["duree"] == "Moins d'une semaine"){
                                if($array[$i]["dates"]["durée"] <= 6){

                                    if(!in_array($i, $valid4)){
                                        $valid4[] = $i;
                                    }
                                }
                            }
                            elseif($_GET["duree"] == "Une semaine (7 à 12 jours)"){
                                if($array[$i]["dates"]["durée"] > 6 && $array[$i]["dates"]["durée"] <= 12){
                                    if(!in_array($i, $valid4)){
                                        $valid4[] = $i;
                                    }
                                }
                            }

                            elseif($_GET["duree"] == "Deux semaine (14 à 19 jours)"){
                                if($array[$i]["dates"]["durée"] > 12 && $array[$i]["dates"]["durée"] <= 19){
                                    if(!in_array($i, $valid4)){
                                        $valid4[] = $i;
                                    }
                                }
                            }

                            elseif($_GET["duree"] == "Plus de deux semaine (plus de 20 jours)"){
                                if($array[$i]["dates"]["durée"] >= 20){
                                    if(!in_array($i, $valid4)){
                                        $valid4[] = $i;
                                    }
                                }
                            }
                        }

                        

                    }

                    /*

                    $bigger = [];

                    if(count($valid1) >= count($valid2)){
                        
                        if(count($valid1) >= count($valid3)){

                            if(count($valid1) >= count($valid4)){
                                $bigger = $valid1;

                            }
                            else{
                                $bigger = $valid4;
                            }
                        }

                        else{

                            if(count($valid3) >= count($valid4)){
                                $bigger = $valid3;
                            }
                            else{
                                $bigger = $valid4;
                            }
                            
                        }

                    }
                    else{

                        if(count($valid2) >= count($valid3)){
                            if(count($valid2) >= count($valid4)){
                                $bigger = $valid2;
                            }
                            else{
                                $bigger = $valid4;
                            }
                        }
                        else{
                            if(count($valid3) >= count($valid4)){
                                $bigger = $valid3;
                            }
                            else{
                                $bigger = $valid4;
                            }
                        }
                        
                    }

                    $valid = [];

                    foreach($bigger as $elm){
                        if()
                    }
                    
                    */
                    
                        if(!empty($valid1) && !empty($valid2)){
                            if(count($valid1) >= count($valid2)){
                                foreach($valid1 as $elm){
                                    if(in_array($elm, $valid2)){
                                        $valid[] = $elm;
                                    }
                                }
                            }
                            else{
                                foreach($valid2 as $elm){
                                    if(in_array($elm, $valid2)){
                                        $valid[] = $elm;
                                    }
                                }
                            }
                        }
                        elseif(empty($valid1) && !empty($valid2)){
                            $valid = $valid2;
                        }
                        else{
                            $valid = $valid1;
                        }

                    $validbis = [];

                        if(!empty($valid) && !empty($valid4)){
                            if(count($valid) >= count($valid4)){
                                foreach($valid as $elm){
                                    if(in_array($elm, $valid4)){
                                        $validbis[] = $elm;
                                    }
                                }
                            }
                            else{
                                foreach($valid4 as $elm){
                                    if(in_array($elm, $valid)){
                                        $validbis[] = $elm;
                                    }
                                }
                            }
                        }
                        elseif(empty($valid) && !empty($valid4)){
                            $validbis = $valid4;
                        }
                        else{
                            $validbis = $valid;
                        }


                    for($i=0; $i<count($validbis); $i++){

                        echo "<div class='box-voy'>
                            <img src=".$array[$validbis[$i]]["image"]." alt='voyage1'>
                            <ul>
                                <li><u>".$array[$validbis[$i]]["titre"]."</u></li>
                                <ul>";

                                foreach($array[$validbis[$i]]["spécificités"] as $ch){
                                    echo "<li>".$ch."</li>";
                                }
                                    
                        echo        "</ul>
                            </ul>
                            <form action='Voyage.php'>
                                <input type='submit' value='Je réserve' name=".$array[$validbis[$i]]["titre"]." id='Voyage".$nb."'>
                            </form>
                            </div>
                            ";
                        $nb++;

                    }

                    echo $_GET["duree"];
                }
                    
                
            }
        ?>

        </div>
    
</body>
</html>