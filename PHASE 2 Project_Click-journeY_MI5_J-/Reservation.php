

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

            $id = -1;

            foreach($_GET as $key=>$elm){
                $id = $key-1;
            }
            
            $array = json_decode(file_get_contents("voyage.json"), true);

            if(!isset($_SESSION["panier"])){
                $_SESSION["panier"] = $array[$id]["prix_total"];
            }
            else{
                $_SESSION["panier"] += $array[$id]["prix_total"];
            }
        }


        header("location:pageacceuil.php");
    
    ?>
