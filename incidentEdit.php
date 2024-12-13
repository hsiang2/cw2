<?php
    include("connection.php");

    $response = [
        "success" => true,
        "message" => "",
    ]; 
    $sqlEdit = "UPDATE Incident SET Incident_time='" . $_POST['timeEdit'] . "', Incident_statement='" . $_POST['statementEdit'] . "', Offence_ID='" . $_POST['offenceEdit'] . "', Vehicle_ID='" . $_POST['vehicleEdit'] . "', People_ID='" . $_POST['peopleEdit'] . "' WHERE Incident_ID=" . $_POST['idEdit'];

    if (!mysqli_query($conn, $sqlEdit)) {
        $response['success'] = false;  // If vehicle update fails, set success to false
        $response['message'] = "Error updating vehicle details";  // Immediate failure message
        echo json_encode($response); 
        exit;
    } 
   
    // if ($_POST['peopleEdit']) {
    //     $sqlOwner = "SELECT People_ID FROM Ownership WHERE Vehicle_ID=" . $_POST['idEdit'];
    //     $resultOwner = mysqli_query($conn, $sqlOwner);
    //     if (mysqli_num_rows($resultOwner) > 0) {
    //         $row = mysqli_fetch_assoc($resultOwner);
    //         $peopleID = $row['People_ID'];
    //         if ($peopleID == $_POST['ownerEdit']) {
    //             $response['message'] = "Vehicle and Ownership updated successfully";
    //             echo json_encode($response);
    //             exit;
    //         } else {
    //             $sqlDeleteOwner = "DELETE FROM Ownership WHERE Vehicle_ID=" . $_POST['idEdit'];
    //             if (!mysqli_query($conn, $sqlDeleteOwner)) {
    //                 $response['success'] = false;  // If ownership update fails, set success to false
    //                 $response['message'] = "Error deleting previous owner";  // Immediate failure message
    //                 echo json_encode($response);  // Return error message and stop execution
    //                 exit;  
    //             }
    //         }
    //     } 
    //     $sqlAddOwner = "INSERT INTO Ownership(Vehicle_ID, People_ID) VALUES ('" .$_POST['idEdit'] . "','" . $_POST['ownerEdit'] . "');";

    //     if (!mysqli_query($conn, $sqlAddOwner)) {
    //         $response['success'] = false;
    //         $response['message'] = "Error updating ownership details";  // Immediate failure message
    //         echo json_encode($response);  // Return error message and stop execution
    //         exit; 
    //     }
    // }

    $response['message'] = "Vehicle and Ownership updated successfully";
    echo json_encode($response); 
?>
