<!DOCTYPE html>

<title></title>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' href='projet.css'>
</head>
<body>
    <fieldset>
    <legend>Panier</legend>
<?php
    
    $status=$_GET["status"];
    if(isset(($status))){
        if($status== "denied"){

        }
        elseif($status== "accepted"){

        }

    }
    function getAPIKey($vendeur){
        if(in_array($vendeur, array('MI-1_A', 'MI-1_B', 'MI-1_C', 'MI-1_D', 'MI-1_E', 'MI-1_F', 'MI-1_G', 'MI-1_H', 'MI-1_I', 'MI-1_J', 'MI-2_A', 'MI-2_B', 'MI-2_C', 'MI-2_D', 'MI-2_E', 'MI-2_F', 'MI-2_G', 'MI-2_H', 'MI-2_I', 'MI-2_J', 'MI-3_A', 'MI-3_B', 'MI-3_C', 'MI-3_D', 'MI-3_E', 'MI-3_F', 'MI-3_G', 'MI-3_H', 'MI-3_I', 'MI-3_J', 'MI-4_A', 'MI-4_B', 'MI-4_C', 'MI-4_D', 'MI-4_E', 'MI-4_F', 'MI-4_G', 'MI-4_H', 'MI-4_I', 'MI-4_J', 'MI-5_A', 'MI-5_B', 'MI-5_C', 'MI-5_D', 'MI-5_E', 'MI-5_F', 'MI-5_G', 'MI-5_H', 'MI-5_I', 'MI-5_J', 'MEF-1_A', 'MEF-1_B', 'MEF-1_C', 'MEF-1_D', 'MEF-1_E', 'MEF-1_F', 'MEF-1_G', 'MEF-1_H', 'MEF-1_I', 'MEF-1_J', 'MEF-2_A', 'MEF-2_B', 'MEF-2_C', 'MEF-2_D', 'MEF-2_E', 'MEF-2_F', 'MEF-2_G', 'MEF-2_H', 'MEF-2_I', 'MEF-2_J', 'MIM_A', 'MIM_B', 'MIM_C', 'MIM_D', 'MIM_E', 'MIM_F', 'MIM_G', 'MIM_H', 'MIM_I', 'MIM_J', 'SUPMECA_A', 'SUPMECA_B', 'SUPMECA_C', 'SUPMECA_D', 'SUPMECA_E', 'SUPMECA_F', 'SUPMECA_G', 'SUPMECA_H', 'SUPMECA_I', 'SUPMECA_J', 'TEST'))) {
            return substr(md5($vendeur), 1, 15);
        }
        return "zzzz";
    }
    
    
    
    
    
    $montant=0;
    if(isset($_SESSION["panier"])){
        foreach($travels as $_SESSION["panier"]){
            echo"<div class='div1'>".$travels["titre"]."</div>";
            $montant+= $travels["prix_total"];
        }
        echo"<div class='div1'> <label for='Valider et payer'> montant : </label></div>"."<div class='div2'>".$montant."</div>;";
    }else{
        header("location: pageAcceuil.php");  
    }
    $transaction="154632ABCD";
    $vendeur="MI-5_J";
    $retour="http://localhost/paiement.php?session=s";
    $api_key=getAPIKey($vendeur);
    $control=md5($api_key. "#" .$transaction. "#" . $montant. "#" .$vendeur. "#" . $retour . "#" );

echo"<form action='https://www.plateforme-smc.fr/cybank/index.php' method='POST'>
    <input type='hidden' name='transaction' value=".$transaction.">
    <input type='hidden' name='montant' value=".$montant.">
    <input type='hidden' name='vendeur' value=".$vendeur.">
    <input type='hidden' name='retour' value=".$retour.">
    <input type='hidden' name='control' value=".$control.">
    <input type='submit' value='Valider et payer'>
    </form>";
?>

</fieldset>
</body>
</html>