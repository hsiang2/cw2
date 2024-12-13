<?php
    include("connection.php");

    $response = [
        "success" => true,
        "message" => "",
    ];

    // $vehicleID = (int)$_POST['idEdit'];

    // if (isset($_POST['plateEdit']) && $_POST['plateEdit']!="" 
    // && isset($_POST['makeEdit']) && $_POST['makeEdit']!="" 
    // && isset($_POST['modelEdit']) && $_POST['modelEdit']!=""
    // && isset($_POST['colourEdit']) && $_POST['colourEdit']!=""
    // ) 
    // {     
        $sqlEdit = "UPDATE Vehicle SET Vehicle_plate='" . $_POST['plateEdit'] . "', Vehicle_make='" . $_POST['makeEdit'] . "', Vehicle_model='" . $_POST['modelEdit'] . "', Vehicle_colour='" . $_POST['colourEdit'] . "' WHERE Vehicle_ID=" . $_POST['idEdit'];

        if (!mysqli_query($conn, $sqlEdit)) {
            $response['success'] = false;  // If vehicle update fails, set success to false
            $response['message'] = "Error updating vehicle details";  // Immediate failure message
            echo json_encode($response); 
            exit;
        } 
    // }

    // if (isset($_POST['ownerEdit']) && isset($_POST['ownerEdit']) != null) {
    if ($_POST['ownerEdit']) {

        $sqlDeleteOwner = "DELETE FROM Ownership WHERE Vehicle_ID=" . $_POST['idEdit'];
        if (!mysqli_query($conn, $sqlDeleteOwner)) {
            $response['success'] = false;
            $response['message'] = "Error deleting previous owner";
            echo json_encode($response);
            exit;
        }
 
        $sqlAddOwner = "INSERT INTO Ownership(Vehicle_ID, People_ID) VALUES ('" . $_POST['idEdit'] . "','" . $_POST['ownerEdit'] . "');";
        if (!mysqli_query($conn, $sqlAddOwner)) {
            $response['success'] = false;
            $response['message'] = "Error adding ownership details";
            echo json_encode($response);
            exit;
        }
    }

    $response['message'] = "Vehicle and Ownership updated successfully";
    echo json_encode($response); 
?>
