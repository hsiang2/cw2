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
        $sqlCheck = "SELECT COUNT(*) AS count FROM Vehicle WHERE Vehicle_plate = '" . $_POST['plate'] . "'";
        $resultCheck = mysqli_query($conn, $sqlCheck);
        $row = mysqli_fetch_assoc($resultCheck);
        if ($row['count'] > 0) {
            throw new Exception("The vehicle plate already exists.");
        }
        
        $sqlAdd = "INSERT INTO Vehicle(Vehicle_plate, Vehicle_make, Vehicle_model, Vehicle_colour) VALUES ('" . $_POST['plate'] . "','" . $_POST['make'] ."','" . $_POST['model'] . "','" . $_POST['colour'] . "');";
        $resultAdd = mysqli_query($conn, $sqlAdd); 
    
        if($resultAdd) {
            $vehicleID = mysqli_insert_id($conn);
            if (isset($_POST['owner']) && is_numeric($_POST['owner'])){
                $sqlOwner = "INSERT INTO Ownership(Vehicle_ID, People_ID) VALUES ('" . $vehicleID . "','" . $_POST['owner'] . "');";
                if (!mysqli_query($conn, $sqlOwner)) {
                    throw new Exception("Error adding ownership");
                }
            }
        } else {
            throw new Exception("Error adding vehicle");
        }  

        $sqlAudit = "INSERT INTO Audit(Officer_ID, Audit_table, Audit_action, Audit_record) VALUES ('$officerId', 'Vehicle', 'Add','" . $_POST['plate'] . "');";
        $resultAudit = mysqli_query($conn, $sqlAudit); 

        if(!$resultAudit) {
            throw new Exception("Error adding audit.");
        }

        $response['success'] = true;
        $response['message'] = "Vehicle and Ownership added successfully";
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response); 
?>