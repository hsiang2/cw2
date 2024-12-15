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
        $sqlCheck = "SELECT COUNT(*) AS count FROM People WHERE People_licence = '" . $_POST['licence'] . "'";
        $resultCheck = mysqli_query($conn, $sqlCheck);
        $row = mysqli_fetch_assoc($resultCheck);
        if ($row['count'] > 0) {
            throw new Exception("The licence number already exists.");
        }
        $sqlAdd = "INSERT INTO People(People_name, People_address, People_DOB, People_licence) VALUES ('" . $_POST['name'] . "','" . $_POST['address'] ."','" . $_POST['dob'] . "','" . $_POST['licence'] . "');";
        $resultAdd = mysqli_query($conn, $sqlAdd); 

        if(!$resultAdd) {
            throw new Exception("Error adding people.");
        }  

        $sqlAudit = "INSERT INTO Audit(Officer_ID, Audit_table, Audit_action, Audit_record) VALUES ('$officerId', 'People', 'Add','" . $_POST['licence'] . "');";
        $resultAudit = mysqli_query($conn, $sqlAudit); 

        if(!$resultAudit) {
            throw new Exception("Error adding audit.");
        }

        $response['success'] = true;
        $response['message'] = "People added successfully.";
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response);
?>