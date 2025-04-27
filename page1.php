<?php
    /*session_start();
    $prenom=$_POST["prenom"];
    $nom=$_POST["nom"];
    $email=$_POST["email"];
    $date_of_birth=$_POST["Age"];
    $password=$_POST["Code"];
    echo "Bonjour ".$prenom." ".$nom." née le ".$date_of_birth;
    /*if(filesize("save.json")===0){
        file_put_contents("save.json","[\n",FILE_APPEND);
    }*/
    //$save=array("prenom"=>$prenom,"nom"=> $nom,"email"=> $email,"password"=> $password);
    
    function searchjson($email){
        /*Take an email and return an array with the information from that email adress*/
        if(file_exists("save.json")){   //check if the file exist to not try to open a non-existing file
            $data=json_decode(file_get_contents("save.json"),true);
            foreach($data as $file){
                if($file["email"]==$email){
                    return $file;
                }
            }
        }
    }

    function new_account($array){
        /*create a new account contained in the array $array in the file save.json  create a file if it doesn't exist or add $array at the end of the file return 1 if succsesful o else */
        if(!empty(searchjson(($array["email"])))){
            return 0;
        }
        else{
            if (file_exists("save.json")) {// Check if the file exists so it can open it
                $file = json_decode(file_get_contents("save.json"), true);  
                if ($file === null) {
                    echo "The file is empty or doesn't contain valid data.";
                    $file = []; // Initialize as an empty array
                }
            } else {
                // The file doesn't exist
                $file = [];
            }
            // Append array to existing file
            $file[] = $array;
            $jsonsave = json_encode($file, JSON_PRETTY_PRINT);
            file_put_contents("save.json", $jsonsave);
            return 1;   
        }
    }

    function change_account($array){
        $save=searchjson(($array["email"]));
        if(empty($save)){   //check if the file with this email exist
            return 0;
        }
        else{
                $json_old_save=json_decode(file_get_contents("save.json"), true);
                $file=[];
                foreach($json_old_save as $data){
                    if(!    ($data["email"]===$array["email"])  ){
                        $file[]=$data;
                    }
                }
                $file[]=$array;
                $json_new_save=json_encode($file, JSON_PRETTY_PRINT);
                file_put_contents("save.json", $json_new_save);
                return 1;
        }
        return 0;   //in case there was a problem
    }


    //file_put_contents("save.json","[\n",FILE_APPEND);
    /*$test="moi@gmail.com";
    $impri=searchjson($test);
    //addjson($save);
    //addnewjson(($save));
    //file_put_contents("save.json","\n]",FILE_APPEND);
    if(isset($impri)){
    echo $impri["nom"];
    }*/

    //$save=array("prenom"=>"themis","nom"=> "trantuthien","email"=> "toi@gmail.com","password"=> "mdpsecure");
    //addnewjson($save);
    //new_account($save);
    /*if(session_status()==PHP_SESSION_NONE){
        session_start();
        $array=array("prenom","nom","email","Age","Code") ;
        foreach($array as $value){
        $_SESSION[$value]=$_POST[$value] ;
        echo $_SESSION[$value]." <br>" ;
        
        }
        echo "<a href='pageAcceuil.php'>Page d'acceuil</a><br>";
        echo"<a href='admin.php'>Page d'admin</a>";
    }*/

    
?>