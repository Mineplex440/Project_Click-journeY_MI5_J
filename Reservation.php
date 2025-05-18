

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

            if(isset($_SESSION["email"]) && isset($_SESSION["password"])){
                $save=searchjson(($_SESSION["email"]));
                if(!empty($save)){
                    $json_old_save=json_decode(file_get_contents("save.json"), true);
                    $file=[];
                    $array1=[];
                    foreach($json_old_save as $data){
                        if(!    ($data["email"]===$_SESSION["email"])  ){
                            $file[]=$data;
                        }
                        else{
                            $array1 = $data;
                            $array1["Voyages_reserve"][] = $id;
                        }
                    }
                    if(isset($_SESSION["Voyages_reserve"])){
                        $_SESSION["Voyages_reserve"][] = $id;
                    }
                    else{
                        $_SESSION["Voyages_reserve"] = array();
                        $_SESSION["Voyages_reserve"][] = $id;
                    }
                    $file[]=$array1;
                    $json_new_save=json_encode($file, JSON_PRETTY_PRINT);
                    file_put_contents("save.json", $json_new_save);
    
                }
            }
            else{
                if(isset($_SESSION["Voyages_reserve"])){
                    $_SESSION["Voyages_reserve"][] = $id;
                }
                else{
                    $_SESSION["Voyages_reserve"] = array();
                    $_SESSION["Voyages_reserve"][] = $id;
                }
                
            }

        }


        header("location:pageacceuil.php");
    
    ?>
