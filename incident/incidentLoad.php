<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

 include("../common/connection.php");

$targetPlate = $_POST["targetPlate"] ?? '';
$targetLicence = $_POST["targetLicence"] ?? '';

if ($targetPlate !== '' || $targetLicence !== '') {
    $sql = "SELECT Incident.Incident_ID, Incident.Incident_time, Incident.Incident_statement,  Vehicle.Vehicle_ID, Vehicle.Vehicle_plate, People.People_ID, People.People_name, People.People_licence, Offence.Offence_ID, Offence.Offence_description, Officer.Officer_ID 
    FROM Incident JOIN Vehicle ON Incident.Vehicle_ID = Vehicle.Vehicle_ID JOIN People ON Incident.People_ID = People.People_ID JOIN Offence ON Incident.Offence_ID = Offence.Offence_ID JOIN Officer ON Incident.Officer_ID = Officer.Officer_ID
    WHERE Vehicle.Vehicle_plate='$targetPlate' OR People.People_licence='$targetLicence' ORDER BY Incident.Incident_ID DESC";
} else {
    $sql = "SELECT Incident.Incident_ID, Incident.Incident_time, Incident.Incident_statement,  Vehicle.Vehicle_ID, Vehicle.Vehicle_plate, People.People_ID, People.People_name, People.People_licence, Offence.Offence_ID, Offence.Offence_description, Officer.Officer_ID 
    FROM Incident JOIN Vehicle ON Incident.Vehicle_ID = Vehicle.Vehicle_ID JOIN People ON Incident.People_ID = People.People_ID JOIN Offence ON Incident.Offence_ID = Offence.Offence_ID  JOIN Officer ON Incident.Officer_ID = Officer.Officer_ID ORDER BY Incident.Incident_ID DESC";
}
  

$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
    if($count > 0) {
        echo "
            <div class='table-responsive custom-table'>
                <table class='table'>
                    <thead>
                        <tr>
                            <th scope='col' style='white-space: nowrap;'>Statement</th>
                            <th scope='col' style='white-space: nowrap;'>Time</th>
                            <th scope='col' style='white-space: nowrap;'>Offence</th>
                            <th scope='col' style='white-space: nowrap;'>People</th>
                            <th scope='col' style='white-space: nowrap;'>Vehicle</th>
                            <th scope='col' style='white-space: nowrap;'>Officer</th>
                            <th scope='col' style='white-space: nowrap;'>Fine</th>
                            <th scope='col' style='white-space: nowrap;'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $incidentId = $row["Incident_ID"];
            $incidentTime = $row["Incident_time"];
            $incidentStatement = $row["Incident_statement"];
            $vehicleId = $row["Vehicle_ID"];
            $vehiclePlate = $row["Vehicle_plate"] ?? '-';
            $peopleId = $row["People_ID"];
            $peopleName = $row["People_name"] ?? '-';
            $peopleLicence = $row["People_licence"] ?? '-';
            $offenceId = $row["Offence_ID"];
            $offenceDescription = $row["Offence_description"] ?? '-';
            $officerId = $row["Officer_ID"];

            $sqlFine = "SELECT Fine.Fine_ID, Fine.Fine_amount, Fine.Fine_points FROM Fine WHERE Fine.Incident_ID='$incidentId'";
            $resultFine = mysqli_query($conn, $sqlFine);
            if (mysqli_num_rows($resultFine) > 0) {
                $rowFine = mysqli_fetch_array($resultFine, MYSQLI_ASSOC);
                $fineId = $rowFine["Fine_ID"];
                $fineAmount = $rowFine["Fine_amount"];
                $finePoints = $rowFine["Fine_points"];
            } else {
                $fineId = null;
                $fineAmount = 0; 
                $finePoints = 0; 
            }
            $disabled = ($_SESSION['admin']) ? "" : "disabled"; 
            echo "
                <tr valign='middle'>
                    <th scope='row'>$incidentStatement</th>
                    <td>$incidentTime</td>
                    <td>$offenceDescription</td>
                    <td>$peopleName $peopleLicence</td>
                    <td>$vehiclePlate</td>
                    <td>$officerId</td>
                    <td>";
                if ($fineId != null) {
                    echo "
                    Amount: $fineAmount</br>
                    Points: $finePoints</br>
                    ";
                } else {
                    echo "-";
                };

            echo"
                    </td>
                    <td>
                        <a id='incidentDeleteBtn' class='btn btn-outline-danger' data-id='$incidentId' data-fine='$fineId' style='display: block; margin-bottom: .4rem'>DELETE</a>
                        <a class='btn btn-outline-dark' data-bs-target='#incidentEditModal' data-bs-toggle='modal' style='display: block; margin-bottom: .4rem' data-id='$incidentId' data-time='$incidentTime' data-statement='$incidentStatement' data-vehicle='$vehicleId' data-people='$peopleId' data-offence='$offenceId'>EDIT</a>
                        <button class='btn btn-outline-dark' data-bs-target='#fineModal' data-bs-toggle='modal' style='display: block; width: 100%' data-incident='$incidentId' data-id='$fineId' data-amount='$fineAmount' data-points='$finePoints' $disabled>FINE</button>
                ";

            // Edit
            include("incidentEditForm.php");
            // Fine
            include("fineForm.php");

        }
        echo "
        </td>
                </tr>
            </tbody>
            </table>
        </div>
        ";
    } else{
        echo "<div class='message-not-found'>Incident Not Found.</div>"; 
    }
?>