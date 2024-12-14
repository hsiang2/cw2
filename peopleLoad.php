<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include("connection.php");

    $targetName = $_POST["name"] ?? '';
    $targetLicence = $_POST["licence"] ?? '';

    if ($targetName !== '' || $targetLicence !== '') {
        $sql = "SELECT People.People_name, People.People_licence, People.People_ID, People.People_address, People.People_DOB, SUM(Fine.Fine_points) AS total_fine_points 
        FROM People LEFT JOIN Incident ON People.People_ID = Incident.People_ID LEFT JOIN Fine ON Incident.Incident_ID = Fine.Incident_ID
        WHERE People.People_name='$targetName' OR People.People_licence='$targetLicence' GROUP BY People.People_ID";
    } else {
            $sql =  "SELECT People.People_name, People.People_licence, People.People_ID, People.People_address, People.People_DOB, SUM(Fine.Fine_points) AS total_fine_points 
        FROM People LEFT JOIN Incident ON People.People_ID = Incident.People_ID LEFT JOIN Fine ON Incident.Incident_ID = Fine.Incident_ID GROUP BY People.People_ID";
    }
        
    // $sql = "SELECT * FROM People WHERE People_name LIKE '%$targetName%' OR People_licence LIKE '%$targetLicence%'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if($count > 0) {
        echo "
            <div class='table-responsive custom-table'>
                <table class='table'>
                    <thead>
                        <tr>
                            <th scope='col' style='white-space: nowrap;'>Name</th>
                            <th scope='col' style='white-space: nowrap;'>Address</th>
                            <th scope='col' style='white-space: nowrap;'>Date of Birth</th>
                            <th scope='col' style='white-space: nowrap;'>Licence Number</th>
                            <th scope='col' style='white-space: nowrap;'>Penalty Points</th>
                            <th scope='col' style='white-space: nowrap;'>Fines</th>
                            <th scope='col' style='white-space: nowrap;'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $name = $row["People_name"];
            $licence = $row["People_licence"];
            $id = $row['People_ID'];
            $address = $row['People_address'];
            $dob = $row['People_DOB'];
            $totalFinePoints = $row['total_fine_points'] ?? 0;

            $sqlFine = "SELECT Fine.Fine_ID, Fine.Fine_points, Fine.Fine_amount FROM Fine JOIN Incident ON Fine.Incident_ID = Incident.Incident_ID WHERE Incident.People_ID='$id'";
            $resultFine = mysqli_query($conn, $sqlFine);
                    
            echo "
                <tr valign='middle'>
                    <th scope='row'>$name</td>
                    <td>$address</td>
                    <td>$dob</td>
                    <td>$licence</td>
                    <td>$totalFinePoints</td>
                    <td>
                        <div class='d-grid gap-3'>
                ";
            if (mysqli_num_rows($resultFine)) {
                while ($rowFine = mysqli_fetch_assoc($resultFine)) {
                    echo "
                        <div>
                            Points: {$rowFine['Fine_points']}</br>
                            Amount: {$rowFine['Fine_amount']}</br>
                        </div>
                    ";
                }
            } else {
                echo " - ";
            }   

            echo " 
                </div>
            </td>
            <td>
            <a id='peopleDeleteBtn' class='btn btn-outline-danger' data-id='$id' style='display: block; margin-bottom: .4rem'>DELETE</a>
            <a class='btn btn-outline-dark' data-bs-target='#peopleEditModal' style='display: block;' data-bs-toggle='modal' data-id='$id' data-name='$name' data-address='$address' data-dob='$dob' data-licence='$licence'>EDIT</a>
                ";
                
            // Edit
            include("peopleEditForm.php");
        }
        echo "
                    </td>
                </tr>
            </tbody>
            </table>
        </div>";
    } else{
        echo "<div class='message-not-found'>Person Not Found.</div>"; 
    }
?>