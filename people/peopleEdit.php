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
        $sqlEdit = "UPDATE People SET People_name='" . $_POST['nameEdit'] . "', People_address='" . $_POST['addressEdit'] . "', People_DOB='" . $_POST['dobEdit'] . "', People_licence='" . $_POST['licenceEdit'] . "' WHERE People_ID=" . $_POST['idEdit'];

        if (!mysqli_query($conn, $sqlEdit)) {
            throw new Exception("Error updating people");
        } 

        $sqlAudit = "INSERT INTO Audit(Officer_ID, Audit_table, Audit_action, Audit_record) VALUES ('$officerId', 'People', 'Edit','" . $_POST['licenceEdit'] . "');";
        $resultAudit = mysqli_query($conn, $sqlAudit); 

        if(!$resultAudit) {
            throw new Exception("Error adding audit.");
        }

        $response['success'] = true;
        $response['message'] = "People updated successfully";
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response); 
?>
