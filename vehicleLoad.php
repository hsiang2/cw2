<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

 include("connection.php");

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
    if($count > 0) {
        echo "
            <div class='table-responsive custom-table'>
                <table class='table'>
                    <thead>
                        <tr>
                            <th scope='col' style='white-space: nowrap;'>Plate Number</th>
                            <th scope='col' style='white-space: nowrap;'>Make</th>
                            <th scope='col' style='white-space: nowrap;'>Model</th>
                            <th scope='col' style='white-space: nowrap;'>Colour</th>
                            <th scope='col' style='white-space: nowrap;'>Owner Name</th>
                            <th scope='col' style='white-space: nowrap;'>Owner Licence</th>
                            <th scope='col' style='white-space: nowrap;'>Incidents</th>
                            <th scope='col' style='white-space: nowrap;'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $vehicleId = $row["Vehicle_ID"];
            $vehiclePlate = $row["Vehicle_plate"];
            $vehicleMake = $row["Vehicle_make"] ?? '-';
            $vehicleModel = $row["Vehicle_model"] ?? '-';
            $vehicleColour = $row["Vehicle_colour"] ?? '-';
            $peopleName = $row["People_name"] ?? '-';
            $peopleLicence = $row["People_licence"] ?? '-';

            $peopleID = $row["People_ID"];

            $sqlIncident = "SELECT Incident.Incident_ID, Incident.Incident_statement, People.People_name FROM Incident LEFT JOIN People ON Incident.People_ID = People.People_ID WHERE Incident.Vehicle_ID='$vehicleId'";
            $resultIncident = mysqli_query($conn, $sqlIncident);
                    
            echo "
                <tr valign='middle'>
                   
                    <th scope='row'>$vehiclePlate</th>
                    <td>$vehicleMake</td>
                    <td>$vehicleModel</td>
                    <td>$vehicleColour</td>
                    <td>$peopleName</td>
                    <td>$peopleLicence</td>
                    <td>
                ";
            if (mysqli_num_rows($resultIncident)) {
                while ($rowIncident = mysqli_fetch_assoc($resultIncident)) {
                    echo "
                            Statement: {$rowIncident['Incident_statement']}</br>
                            People: {$rowIncident['People_name']}</br>
                    ";
                }
            } else {
                echo " - ";
            }   

            echo " 
            </td>
            <td>
            <a id='vehicleDeleteBtn' class='btn btn-outline-danger' data-id='$vehicleId' style='display: block; margin-bottom: 1rem'>DELETE</a>
            <a class='btn btn-outline-dark' data-bs-target='#vehicleEditModal' style='display: block;' data-bs-toggle='modal' data-id='$vehicleId' data-plate='$vehiclePlate' data-make='$vehicleMake' data-model='$vehicleModel' data-colour='$vehicleColour' data-owner='$peopleID'>EDIT</a>
                ";
                
            // Edit
            include("vehicleEditForm.php");

        }
        echo "
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
        ";
    } else{
        echo "Vehicle Not Found."; 
    }
?>