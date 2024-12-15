<?php
    include("../common/connection.php");
    session_start();
    $officerId = $_SESSION["id"];

    header('Content-Type: application/json');

    $response = [
        "success" => false,
        "message" => "Unknown error",
    ];

    try {
        $sqlEdit = "UPDATE Officer SET Officer_name='" . $_POST['nameEdit'] . "', Officer_username='" . $_POST['usernameEdit'] . "', Officer_password='" . $_POST['passwordEdit'] . "', Officer_admin='" . $_POST['adminEdit'] . "' WHERE Officer_ID='" . $_POST['idEdit'] ."'";

        if (!mysqli_query($conn, $sqlEdit)) {
            throw new Exception("Error updating officer details");
        } 

        $sqlAudit = "INSERT INTO Audit(Officer_ID, Audit_table, Audit_action, Audit_record) VALUES ('$officerId', 'Officer', 'Edit','" . $_POST['idEdit'] . "');";
        $resultAudit = mysqli_query($conn, $sqlAudit); 

        if(!$resultAudit) {
            throw new Exception("Error adding audit.");
        }
    
        $response['success'] = true;
        $response['message'] = "Officer updated successfully";
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
 
    echo json_encode($response); 
?>
