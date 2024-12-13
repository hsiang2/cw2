<?php
    include("connection.php");

    $response = [
        "success" => true,
        "message" => "",
    ];

    $sqlEdit = "UPDATE People SET People_name='" . $_POST['nameEdit'] . "', People_address='" . $_POST['addressEdit'] . "', People_DOB='" . $_POST['dobEdit'] . "', People_licence='" . $_POST['licenceEdit'] . "' WHERE People_ID=" . $_POST['idEdit'];

    if (!mysqli_query($conn, $sqlEdit)) {
        $response['success'] = false; 
        $response['message'] = "Error updating people"; 
        echo json_encode($response); 
        exit;
    } 

    $response['message'] = "People updated successfully";
    echo json_encode($response); 
?>
