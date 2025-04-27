

    <?php
        $connected=0;   //a variable that will be equal to 1 if the users is succsfully connected
        include"page1.php";
        if(session_status()==PHP_SESSION_NONE){
            session_start();
            $_SESSION["connected"] = $connected;
            if(isset($_POST["email"])&&isset($_POST["Code"])&&isset($_POST["prenom"])&&isset($_POST["nom"])&&isset($_POST["Age"])){ //check if it is an inscription
                $_SESSION["connected"]=1;
                $save=array("prenom"=>$_POST["prenom"],"nom"=> $_POST["nom"],"email"=> $_POST["email"],"password"=> $_POST["Code"],"date_of_birth"=>$_POST["Age"],"sex"=>$_POST["Sexe"], "Admin"=>"0");
                new_account($save);
                $_SESSION["email"]=$_POST["email"];
                $_SESSION["password"]=$_POST["Code"];
                $_SESSION["admin"]=$save["Admin"];
            }
            elseif(isset($_POST["Email"])&& isset($_POST["Code"])){  //if you just connected
                $table=searchjson($_POST["Email"]);
                if($table["password"]==$_POST["Code"]){ //check if the password is correct
                        $_SESSION["connected"]=1;
                        $_SESSION["email"]=$_POST["Email"];
                        $_SESSION["password"]=$_POST["Code"];
                        $_SESSION["admin"]=$table["Admin"];
            
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
            }
        }


        header("location:pageacceuil.php");
    
    ?>