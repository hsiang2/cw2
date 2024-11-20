<?php
$targetPlate = $_POST["targetPlate"] ?? '';

if ($targetPlate !== '') {
    $sql = "SELECT Vehicle.Vehicle_ID, Vehicle.Vehicle_plate, Vehicle.Vehicle_make, Vehicle.Vehicle_model, Vehicle.Vehicle_colour, People.People_ID, People.People_Name, People.People_Licence  
    FROM Vehicle LEFT JOIN Ownership ON Vehicle.Vehicle_ID = Ownership.Vehicle_ID LEFT JOIN People ON People.People_ID = Ownership.People_ID 
    WHERE Vehicle.Vehicle_plate='$targetPlate'";
} else {
    $sql = "SELECT Vehicle.Vehicle_ID, Vehicle.Vehicle_plate, Vehicle.Vehicle_make, Vehicle.Vehicle_model, Vehicle.Vehicle_colour, People.People_ID, People.People_name, People.People_licence  
    FROM Vehicle LEFT JOIN Ownership ON Vehicle.Vehicle_ID = Ownership.Vehicle_ID LEFT JOIN People ON People.People_ID = Ownership.People_ID";
}
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
?>