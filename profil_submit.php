<?php
include"page1.php";
$data = json_decode(file_get_contents("php://input"), true);
$old_data=searchjson($data["email"]);

if ($data === null) {
    http_response_code(400);
    $old_data["message"]="Invalid JSON";
    echo json_encode($old_data);
    exit();
}
else{
    
    if(isset($old_data["travel"])){
        $data["travel"]=$old_data["travel"];
    }
    else{
        $data["travel"]=[];
    }

    if(isset($old_data["admin"])){
        $data["admin"]=$old_data["admin"];
    }
    else{
        $data["admin"]=0;
    }

    if(change_account($data)){
        $data["message"]="succes";
        
        echo json_encode($data);
    }
    else{
        $old_data["message"]="problem when with modification";
        echo json_encode($old_data);
    }
}


?>