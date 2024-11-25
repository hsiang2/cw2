<?php

    // session_start();
    include('connection.php');

    $response = [
        "success" => true,
        "message" => "",
    ];
    $sqlCheck = "SELECT COUNT(*) AS count FROM Vehicle WHERE Vehicle_plate = '" . $_POST['plate'] . "'";
    $resultCheck = mysqli_query($conn, $sqlCheck);
    $row = mysqli_fetch_assoc($resultCheck);
    if ($row['count'] > 0) {
            $response['success'] = false;
            $response['message'] = "The vehicle plate already exists.";
            echo json_encode($response);
            exit;
    }
        // construct the INSERT query
        $sqlAdd = "INSERT INTO Vehicle(Vehicle_plate, Vehicle_make, Vehicle_model, Vehicle_colour) VALUES ('" . $_POST['plate'] . "','" . $_POST['make'] ."','" . $_POST['model'] . "','" . $_POST['colour'] . "');";
        // send query to the database
        $resultAdd = mysqli_query($conn, $sqlAdd); 
       

        if($resultAdd) {
            $vehicleID = mysqli_insert_id($conn);
            // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            // $id = $row['Vehicle_ID'];

            // if ($_POST['owner']) {
            if (isset($_POST['owner']) && is_numeric($_POST['owner'])){
                $sqlOwner = "INSERT INTO Ownership(Vehicle_ID, People_ID) VALUES ('" . $vehicleID . "','" . $_POST['owner'] . "');";
                if (!mysqli_query($conn, $sqlOwner)) {
                    $response['success'] = false;
                    $response['message'] = "Error adding ownership"; 
                    echo json_encode($response);
                    exit; 
                }
            }
        } else{
            $response['success'] = false;  // If vehicle update fails, set success to false
            $response['message'] = "Error adding vehicle";  // Immediate failure message
            echo json_encode($response); 
            exit;
        }  
        $response['message'] = "Vehicle and Ownership updated successfully";
        echo json_encode($response); 
?>