<?php
    include("connection.php");
    session_start();
    $officerId = $_SESSION["id"];

    header('Content-Type: application/json');

    $response = [
        "success" => false,
        "message" => "Unknown error",
    ];

    try {
        $sqlEdit = "UPDATE Vehicle SET Vehicle_plate='" . $_POST['plateEdit'] . "', Vehicle_make='" . $_POST['makeEdit'] . "', Vehicle_model='" . $_POST['modelEdit'] . "', Vehicle_colour='" . $_POST['colourEdit'] . "' WHERE Vehicle_ID=" . $_POST['idEdit'];

        if (!mysqli_query($conn, $sqlEdit)) {
            throw new Exception("Error updating vehicle details");
        } 

        $sqlDeleteOwner = "DELETE FROM Ownership WHERE Vehicle_ID=" . $_POST['idEdit'];
        if (!mysqli_query($conn, $sqlDeleteOwner)) {
            throw new Exception("Error deleting previous owner");
        }
    
        if ($_POST['ownerEdit']) {
            $sqlAddOwner = "INSERT INTO Ownership(Vehicle_ID, People_ID) VALUES ('" . $_POST['idEdit'] . "','" . $_POST['ownerEdit'] . "');";
            if (!mysqli_query($conn, $sqlAddOwner)) {
                throw new Exception("Error adding ownership");
            }
        }

        $sqlAudit = "INSERT INTO Audit(Officer_ID, Audit_table, Audit_action, Audit_record) VALUES ('$officerId', 'Vehicle', 'Edit','" . $_POST['plateEdit'] . "');";
        $resultAudit = mysqli_query($conn, $sqlAudit); 

        if(!$resultAudit) {
            throw new Exception("Error adding audit.");
        }

        $response['success'] = true;
        $response['message'] = "Vehicle and Ownership updated successfully";
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response); 
?>
