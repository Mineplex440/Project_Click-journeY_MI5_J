

    <?php
        $connected=0;   //a variable that will be equal to 1 if the users is succsfully connected
        include"page1.php";
        if(session_status()==PHP_SESSION_NONE){
            session_start();
            $_SESSION["connected"] = $connected;
            if(isset($_POST["email"])&&isset($_POST["Code"])&&isset($_POST["prenom"])&&isset($_POST["nom"])&&isset($_POST["Age"])){ //check if it is an inscription
                $_SESSION["connected"]=1;
                $save=array("prenom"=>$_POST["prenom"],"nom"=> $_POST["nom"],"email"=> $_POST["email"],"password"=> $_POST["Code"],"date_of_birth"=>$_POST["Age"],"sex"=>$_POST["Sexe"], "Admin"=>"0", "Voyages_reserve"=>array());
                new_account($save);
                $_SESSION["email"]=$_POST["email"];
                $_SESSION["password"]=$_POST["Code"];
                $_SESSION["admin"]=$save["Admin"];
                $_SESSION["Voyages_reserve"]=$table["Voyages_reserve"];
            }
            elseif(isset($_POST["Email"])&& isset($_POST["Code"])){  //if you just connected
                $table=searchjson($_POST["Email"]);
                if($table["password"]==$_POST["Code"]){ //check if the password is correct
                        $_SESSION["connected"]=1;
                        $_SESSION["email"]=$_POST["Email"];
                        $_SESSION["password"]=$_POST["Code"];
                        $_SESSION["admin"]=$table["Admin"];
                        $_SESSION["Voyages_reserve"]=$table["Voyages_reserve"];
                        if (!empty($_SESSION["Voyages_reserve"])){
                            
                                if (file_exists("voyage.json")) {
                                    $array = json_decode(file_get_contents("voyage.json"), true);
                                    $_SESSION["panier"] = 0;
                                    foreach ($_SESSION["Voyages_reserve"] as $id){
                                        $_SESSION["panier"] += $array[$id]["prix_total"];
                                    }
                                }
                            
                        }
            
                    /*$array=array("prenom","nom","email","age","code") ;
                    foreach($array as $value){
                        $_SESSION[$value]=$_POST[$value] ;
                        echo $_SESSION[$value]."<br><br><br>" ;
                    }*/
                }
            }
            elseif(isset($_SESSION["email"])&&isset($_SESSION["password"])){    //if you changed page before
                $table=searchjson($_SESSION["email"]);
                if($table["password"]==$_SESSION["password"]){
                    $_SESSION["connected"]= 1;
                }
            }
            else{
                $_SESSION["connection"] = 0;
                $_SESSION["admin"] = 0;
                $_SESSION["Voyages_reserve"]=array();
            }
        }


        header("location:pageAcceuil.php");
    
    ?>
