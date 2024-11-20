<?php
    if (isset($_POST['username']) && $_POST['username']!="" 
    && isset($_POST['password']) && $_POST['password']!="" 
    && isset($_POST['name']) && $_POST['name']!=""
    ) // check contents of $_POST supervariables
    {     
        // construct the INSERT query
        $sql = "UPDATE Officer SET `Officer_username`='" . $_POST['username'] . "', `Officer_password`='" . $_POST['password'] ."', `Officer_name`='" . $_POST['name'] . 
        "' WHERE `Officer_ID`='$officerId'";

        // send query to the database
        // $result = mysqli_query($conn, $sql); 
        if ($conn->query($sql) === TRUE) {
                    // echo "Vehicle added successfully";
        } else {
                // echo "Error: " . $sql . "<br>" . $conn->error;
        } 
    }
?>