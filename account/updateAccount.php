<?php
    if (isset($_POST['username']) && $_POST['username']!="" 
    && isset($_POST['password']) && $_POST['password']!="" 
    && isset($_POST['name']) && $_POST['name']!=""
    ) 
    {     
        $sql = "UPDATE Officer SET `Officer_username`='" . $_POST['username'] . "', `Officer_password`='" . $_POST['password'] ."', `Officer_name`='" . $_POST['name'] . 
        "' WHERE `Officer_ID`='$officerId'";

        if (mysqli_query($conn, $sql)) {
            $sql = "SELECT * FROM Officer WHERE Officer_ID='$officerId'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
   
            $officerUsername = $row['Officer_username'];
            $officerPassword = $row['Officer_password'];
            $officerName = $row['Officer_name'];

            $_SESSION["user"] = $officerUsername;
        } else {
            echo "<span class='text-danger'>Error managing account</span>";
        }
    } 
?>