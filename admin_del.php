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
    if(delete($data["email"])){
        $data["message"]="succes";
        echo json_encode($data);
    }
    else{
        $old_data["message"]="problem when with change_rights";
        echo json_encode($old_data);
    }
}


?>