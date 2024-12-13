<?php
    include('connection.php');

    $response = [
        "success" => true,
        "message" => "",
    ];
    $sqlCheck = "SELECT COUNT(*) AS count FROM Officer WHERE Officer_ID = '" . $_POST['id'] . "'";
    $resultCheck = mysqli_query($conn, $sqlCheck);
    $row = mysqli_fetch_assoc($resultCheck);
    if ($row['count'] > 0) {
            $response['success'] = false;
            $response['message'] = "The officer ID already exists.";
            echo json_encode($response);
            exit;
    }
    
    $sqlAdd = "INSERT INTO Officer(Officer_id, Officer_name, Officer_username, Officer_password, Officer_admin) VALUES ('" . $_POST['id'] . "','" . $_POST['name'] ."','" . $_POST['username'] . "','" . $_POST['password'] . "','" . $_POST['admin'] . "');";
        // send query to the database
        $resultAdd = mysqli_query($conn, $sqlAdd); 

        if(!$resultAdd) {
            $response['success'] = false; 
            $response['message'] = "Error adding officer"; 
            echo json_encode($response); 
            exit;
        }  
        $response['message'] = "Officer added successfully";
        echo json_encode($response); 
?>