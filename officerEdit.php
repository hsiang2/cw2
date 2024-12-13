<?php
    include("connection.php");

    $response = [
        "success" => true,
        "message" => "",
    ];
 
    $sqlEdit = "UPDATE Officer SET Officer_name='" . $_POST['nameEdit'] . "', Officer_username='" . $_POST['usernameEdit'] . "', Officer_password='" . $_POST['passwordEdit'] . "', Officer_admin='" . $_POST['adminEdit'] . "' WHERE Officer_ID='" . $_POST['idEdit'] ."'";

    if (!mysqli_query($conn, $sqlEdit)) {
        $response['success'] = false;  
        $response['message'] = "Error updating officer details"; 
        echo json_encode($response); 
        exit;
    } 

    $response['message'] = "Officer updated successfully";
    echo json_encode($response); 
?>
