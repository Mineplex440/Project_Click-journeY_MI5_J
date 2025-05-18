<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style-light.css" id="theme-style">
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


    <h1 class="ensemble-titre"><u>Rechercher parmis toutes nos offres</u></h1>

    <div class="recherche">
        <form action="L'ensemble_des_voyages.php" method="get" id="rechercheForm">

            <ul class="recherche-ul">

                <li class="recherche-li-loca">
                    <?php
                        if(isset($_GET["localisation"])){
                            echo "<input type='text' name='localisation' value='".$_GET["localisation"]."' id='localisation' maxlength='30' placeholder='Pays, région, ville, nom oiseaux, ...' />";
                        }
                        else{
                            echo "<input type='text' name='localisation' id='localisation' maxlength='30' placeholder='Pays, région, ville, nom oiseaux, ...' />";
                        }
                    ?>
                </li>
                <li class="recherche-li">
                    <?php 
                        if(isset($_GET["prix"])){
                            echo "<input type='text' name='prix' id='prix' value='".$_GET["prix"]."' maxlength='6' placeholder='Prix max en euros'>";
                        }
                        else{
                            echo "<input type='text' name='prix' id='prix' maxlength='6' placeholder='Prix max en euros'>";
                        }
                        
                    ?>
                </li>
                <li class="recherche-li">
                    <?php 
                        if(isset($_GET["date"])){
                            echo "<input type='date' name='date' id='date' value='".$_GET['date']."'/>";
                        } 
                        else{
                            echo "<input type='date' name='date' id='date'/>";
                        }
                    ?>
                </li>
                <li class="recherche-li">

                    <?php

                        if(isset($_GET["type_sejour"])){
                            if($_GET["type_sejour"] == "tout-endroit"){
                                echo "<select name='type_sejour' id='type_sejour'>
                                <option value='tout-endroit'>Ensemble des parcours</option>
                                <option value='foret'>Principalement en forêt</option>
                                <option value='aquatique'>Principalement en zone aquatique</option>
                                <option value='montagne'>Principalement en montagne</option>
                                <option value='special'>Parcours spécial de l'aventurier</option>
                                </select>";
                            }
                            else if($_GET["type_sejour"] == "foret"){
                                echo "<select name='type_sejour' id='type_sejour'>
                                <option value='foret'>Principalement en forêt</option>
                                <option value='tout-endroit'>Ensemble des parcours</option>
                                <option value='aquatique'>Principalement en zone aquatique</option>
                                <option value='montagne'>Principalement en montagne</option>
                                <option value='special'>Parcours spécial de l'aventurier</option>
                                </select>";
                            }
                            else if($_GET["type_sejour"] == "aquatique"){
                                echo "<select name='type_sejour' id='type_sejour'>
                                <option value='aquatique'>Principalement en zone aquatique</option>
                                <option value='tout-endroit'>Ensemble des parcours</option>
                                <option value='foret'>Principalement en forêt</option>
                                <option value='montagne'>Principalement en montagne</option>
                                <option value='special'>Parcours spécial de l'aventurier</option>
                                </select>";
                            }
                            else if($_GET["type_sejour"] == "montagne"){
                                echo "<select name='type_sejour' id='type_sejour'>
                                <option value='montagne'>Principalement en montagne</option>
                                <option value='tout-endroit'>Ensemble des parcours</option>
                                <option value='foret'>Principalement en forêt</option>
                                <option value='aquatique'>Principalement en zone aquatique</option>
                                <option value='special'>Parcours spécial de l'aventurier</option>
                                </select>";
                            }
                            else if ($_GET["type_sejour"] == "special") {
                                echo "<select name='type_sejour' id='type_sejour'>
                                    <option value='special'>Parcours spécial de l'aventurier</option>
                                    <option value='tout-endroit'>Ensemble des parcours</option>
                                    <option value='foret'>Principalement en forêt</option>
                                    <option value='aquatique'>Principalement en zone aquatique</option>
                                    <option value='montagne'>Principalement en montagne</option>
                                </select>";
                            }
                        }
                        else{

                            echo "<select name='type_sejour' id='type_sejour'>
                                <option value='tout-endroit'>Ensemble des parcours</option>
                                <option value='foret'>Principalement en forêt</option>
                                <option value='aquatique'>Principalement en zone aquatique</option>
                                <option value='montagne'>Principalement en montagne</option>
                                <option value='special'>Parcours spécial de l'aventurier</option>
                            </select>";
                        }

                    
                    ?>
                </li>
                <li class="recherche-li">
                    <?php 
                        if(isset($_GET["duree"])){
                            if($_GET["duree"]=="toute-duree"){
                                echo "<select name='duree' id='duree'>
                                    <option value='toute-duree'>Peux importe la durée</option>
                                    <option value='7'>Moins d'une semaine</option>
                                    <option value='12'>Une semaine (7 à 12 jours)</option>
                                    <option value='17'>Deux semaine (14 à 19 jours)</option>
                                    <option value='20'>Plus de deux semaine (plus de 20 jours)</option>
                                </select>";
                            }
                            else if($_GET["duree"]=="7"){
                                echo "<select name='duree' id='duree'>
                                    <option value='7'>Moins d'une semaine</option>
                                    <option value='toute-duree'>Peux importe la durée</option>
                                    <option value='12'>Une semaine (7 à 12 jours)</option>
                                    <option value='17'>Deux semaine (14 à 19 jours)</option>
                                    <option value='20'>Plus de deux semaine (plus de 20 jours)</option>
                                </select>";
                            }
                            else if($_GET["duree"]=="12"){
                                echo "<select name='duree' id='duree'>
                                        <option value='12'>Une semaine (7 à 12 jours)</option>
                                        <option value='toute-duree'>Peux importe la durée</option>
                                        <option value='7'>Moins d'une semaine</option>
                                        <option value='17'>Deux semaine (14 à 19 jours)</option>
                                        <option value='20'>Plus de deux semaine (plus de 20 jours)</option>
                                    </select>";
                            }
                            elseif($_GET["duree"]=="17"){
                                echo "<select name='duree' id='duree'>
                                    <option value='17'>Deux semaine (14 à 19 jours)</option>
                                    <option value='toute-duree'>Peux importe la durée</option>
                                    <option value='7'>Moins d'une semaine</option>
                                    <option value='12'>Une semaine (7 à 12 jours)</option>
                                    <option value='20'>Plus de deux semaine (plus de 20 jours)</option>
                                </select>";
                            }
                            else if($_GET["duree"]=="20"){
                                echo "<select name='duree' id='duree'>
                                <option value='20'>Plus de deux semaine (plus de 20 jours)</option>
                                <option value='toute-duree'>Peux importe la durée</option>
                                <option value='7'>Moins d'une semaine</option>
                                <option value='12'>Une semaine (7 à 12 jours)</option>
                                <option value='17'>Deux semaine (14 à 19 jours)</option>
                            </select>";
                            }
                        }
                        else{
                            echo "<select name='duree' id='duree'>
                                <option value='toute-duree'>Peux importe la durée</option>
                                <option value='7'>Moins d'une semaine</option>
                                <option value='12'>Une semaine (7 à 12 jours)</option>
                                <option value='17'>Deux semaine (14 à 19 jours)</option>
                                <option value='20'>Plus de deux semaine (plus de 20 jours)</option>
                            </select>";
                        }
                        
                    ?>
                </li>
            </ul>

        </form>
    </div>

    <hr>


    <div class="boitedel">

    
        <?php
        
            if (file_exists("voyage.json")) {
                
                /*
                if(isset($_GET["type_sejour"]) && isset($_GET["duree"])){
                    
                    $nb = 1;
                    $array = json_decode(file_get_contents("voyage.json"), true); 
                    if (!empty($_GET["localisation"]) || !empty($_GET["date"]) || $_GET["type_sejour"]!="tout-endroit"  || $_GET["duree"]!="toute-duree") {
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
                            else{
                                $valid1[] = $i;
                            }
    
                            if(!empty($_GET["date"])){
                                if ($_GET["date"] == $array[$i]["dates"]["début"]){
                                    if(!in_array($i, $valid2)){
                                        $valid2[] = $i;
                                    }
                                }
                            }
                            else{
                                $valid2[] = $i;
                            }
    
    
                            if(!empty($_GET["type_sejour"])){
                                if($_GET["type_sejour"] == "tout-endroit"){
                                    if(!in_array($i,$valid3)){
                                        $valid3[] = $i;
                                    }
                                }
                            }
                            
    
                            if(!empty($_GET["duree"])){
                                if ($_GET["duree"] == "moins-une-semaine"){
                                    if($array[$i]["dates"]["durée"] <= 6){
    
                                        if(!in_array($i, $valid4)){
                                            $valid4[] = $i;
                                        }
                                    }
                                }
    
                                elseif($_GET["duree"] == "toute-duree"){
                                        if(!in_array($i, $valid4)){
                                            $valid4[] = $i;
                                    }
                                }
    
                                elseif($_GET["duree"] == "une-semaine"){
                                    if($array[$i]["dates"]["durée"] > 6 && $array[$i]["dates"]["durée"] <= 12){
                                        if(!in_array($i, $valid4)){
                                            $valid4[] = $i;
                                        }
                                    }
                                }
    
                                elseif($_GET["duree"] == "deux-semaine"){
                                    if($array[$i]["dates"]["durée"] > 12 && $array[$i]["dates"]["durée"] <= 19){
                                        if(!in_array($i, $valid4)){
                                            $valid4[] = $i;
                                        }
                                    }
                                }
    
                                elseif($_GET["duree"] == "plus-long"){
                                    if($array[$i]["dates"]["durée"] >= 20){
                                        if(!in_array($i, $valid4)){
                                            $valid4[] = $i;
                                        }
                                    }
                                }
                            }
    
                            
    
                        }
    
                       
                            
                            if(empty($valid1) || empty($valid2) || empty($valid3) || empty($valid4)){
                                $validbis = [];
                            }
                            else{
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
                                            if(in_array($elm, $valid1)){
                                                $valid[] = $elm;
                                            }
                                        }
                                    }
                                }
        
                            $validbisbis = [];
        
                                if(!empty($valid) && !empty($valid4)){
                                    if(count($valid) >= count($valid4)){
                                        foreach($valid as $elm){
                                            if(in_array($elm, $valid4)){
                                                $validbisbis[] = $elm;
                                            }
                                        }
                                    }
                                    else{
                                        foreach($valid4 as $elm){
                                            if(in_array($elm, $valid)){
                                                $validbisbis[] = $elm;
                                            }
                                        }
                                    }
                                }
                                
                                $validbis = [];
    
                                if(!empty($validbisbis) && !empty($valid3)){
                                    if(count($validbisbis) >= count($valid3)){
                                        foreach($validbisbis as $elm){
                                            if(in_array($elm, $valid3)){
                                                $validbis[] = $elm;
                                            }
                                        }
                                    }
                                    else{
                                        foreach($valid3 as $elm){
                                            if(in_array($elm, $validbisbis)){
                                                $validbis[] = $elm;
                                            }
                                        }
                                    }
                                }
                            }
    
                            
                        
                            
    
                        for($i=0; $i<count($validbis); $i++){
    
                            echo "<div class='box-voy'>
                                <img src=".$array[$validbis[$i]]["image"]." alt='voyage".$nb."'>
                                <ul>
                                    <li><u>".$array[$validbis[$i]]["titre"]."</u></li>
                                    <ul>";
    
                                    foreach($array[$validbis[$i]]["spécificités"] as $ch){
                                        echo "<li>".$ch."</li>";
                                    }
                                        
                            echo        "</ul>
                                </ul>
                                <form action='Voyage.php'>
                                    <input type='submit' value='Je réserve' name=".$array[$validbis[$i]]["id"]." id='Voyage".$nb."'>
                                </form>
                                </div>
                                ";
                            $nb++;
    
                        }
    
                    }
                    else{
                        echo "<script src='Ensemble_voyage.js'></script>";
                    }
                }
                else{
                    echo "<script src='Ensemble_voyage.js'></script>";
                }
                */
                echo "<script src='Ensemble_voyage.js'></script>";
            }
        ?>
        </div>
    

    <script src="Ensemble_voyage.js"></script>
    <script src="fonction.js"></script>
</body>
</html>