<?php
    include('../common/connection.php');
    session_start();
    $officerId = $_SESSION["id"];

    header('Content-Type: application/json');

    $response = [
        "success" => false,
        "message" => "Unknown error",
    ];

    try {
        $sqlCheck = "SELECT COUNT(*) AS count FROM Officer WHERE Officer_ID = '" . $_POST['id'] . "'";
        $resultCheck = mysqli_query($conn, $sqlCheck);
        $row = mysqli_fetch_assoc($resultCheck);
        if ($row['count'] > 0) {
            throw new Exception("The officer ID already exists.");
        }
        
        $sqlAdd = "INSERT INTO Officer(Officer_id, Officer_name, Officer_username, Officer_password, Officer_admin) VALUES ('" . $_POST['id'] . "','" . $_POST['name'] ."','" . $_POST['username'] . "','" . $_POST['password'] . "','" . $_POST['admin'] . "');";
        $resultAdd = mysqli_query($conn, $sqlAdd); 
    
        if(!$resultAdd) {
            throw new Exception("Error adding officer");
        }

        $sqlAudit = "INSERT INTO Audit(Officer_ID, Audit_table, Audit_action, Audit_record) VALUES ('$officerId', 'Officer', 'Add','" . $_POST['id'] . "');";
        $resultAudit = mysqli_query($conn, $sqlAudit); 

        if(!$resultAudit) {
            throw new Exception("Error adding audit.");
        }

        $response['success'] = true;  
        $response['message'] = "Officer added successfully";
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response); 
?>