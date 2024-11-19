<?php
    session_start();
    include('connection.php');
       
    if (isset($_POST['plate']) && $_POST['plate']!="" 
    && isset($_POST['make']) && $_POST['make']!="" 
    && isset($_POST['model']) && $_POST['model']!=""
    && isset($_POST['colour']) && $_POST['colour']!=""
    ) // check contents of $_POST supervariables
    {     
        // construct the INSERT query
        $sql = "INSERT INTO Vehicle(Vehicle_plate, Vehicle_make, Vehicle_model, Vehicle_colour) VALUES ('" . $_POST['plate'] . "','" . $_POST['make'] ."','" . $_POST['model'] . "','" . $_POST['colour'] . "');";
        // send query to the database
        $result = mysqli_query($conn, $sql); 
        $vehicleID = mysqli_insert_id($conn);

        if($vehicleID) {
            // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            // $id = $row['Vehicle_ID'];

            if (isset($_POST['owner']) && isset($_POST['owner']) != null) {

                $sqlOwner = "INSERT INTO Ownership(Vehicle_ID, People_ID) VALUES ('" . $vehicleID . "','" . $_POST['owner'] . "');";
                if ($conn->query($sqlOwner) === TRUE) {
                    echo "Vehicle added successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else{
            echo "There was an error adding vehicle"; 
        }  
        // }
        // if ($conn->query($sql) === TRUE) {
        //     echo "Vehicle added successfully";
        // } else {
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }

       
    }
?>