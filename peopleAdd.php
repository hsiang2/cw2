<?php
    include('connection.php');

    $response = [
        "success" => true,
        "message" => "",
    ];

    $sqlCheck = "SELECT COUNT(*) AS count FROM People WHERE People_licence = '" . $_POST['licence'] . "'";
    $resultCheck = mysqli_query($conn, $sqlCheck);
    $row = mysqli_fetch_assoc($resultCheck);
    if ($row['count'] > 0) {
            $response['success'] = false;
            $response['message'] = "The licence number already exists.";
            echo json_encode($response);
            exit;
    }
    $sqlAdd = "INSERT INTO People(People_name, People_address, People_DOB, People_licence) VALUES ('" . $_POST['name'] . "','" . $_POST['address'] ."','" . $_POST['dob'] . "','" . $_POST['licence'] . "');";
    $resultAdd = mysqli_query($conn, $sqlAdd); 

    if(!$resultAdd) {
        $response['success'] = false;  // If vehicle update fails, set success to false
        $response['message'] = "Error adding people";  // Immediate failure message
        echo json_encode($response); 
        exit;
    }  
    $response['message'] = "People added successfully";
    echo json_encode($response); 
?>