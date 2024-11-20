<?php
    session_start();
    if (!isset($_SESSION["user"]) || !isset($_SESSION["id"])) {
        header("Location: login.php");
        exit();
    }

    include("connection.php");
    // include("addVehicle.php");

    include("loadVehicle.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Police Traffic Website | Vehicle</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="/cw2/index.php">Police Traffic</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="/cw2/people.php">PEOPLE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cw2/vehicle.php">VEHICLE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cw2/incident.php">INCIDENT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true" href="/cw2/officer.php">OFFICER</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/cw2/account.php">Logged in as <b><?php echo $_SESSION['user']?></b></a></li>
                        <form method="POST" action="logout.php">
                            <input type="submit" name="logout" value="Logout" />
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            <div class="container" >
                <h1>Search for Vehicles</h1>
                <!-- Alert -->
                <!-- <div id="alert" class="alert alert-light alert-dismissible fade show" role="alert">
                    <p id="alertText"></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> -->
                <!-- Search -->
                <form method="POST">
                    <div class="mb-3">
                        <label for="targetPlate" class="form-label">Plate Number</label>
                        <input type="text" class="form-control" name="targetPlate" id="targetPlate">
                    </div>
                    <button type="submit" class="btn btn-outline-dark" value="Search">Search</button>
                </form>
                <a style="margin-top: 1rem;" class="btn btn-dark" data-bs-target="#addModal" data-bs-toggle="modal">ADD</a>
                <?php
                        // include("connection.php");
                        // $targetPlate = $_POST["plate"] ?? '';

                        // if ($targetPlate !== '') {
                        //     $sql = "SELECT Vehicle.Vehicle_ID, Vehicle.Vehicle_plate, Vehicle.Vehicle_make, Vehicle.Vehicle_model, Vehicle.Vehicle_colour, People.People_Name, People.People_Licence  
                        //     FROM Vehicle LEFT JOIN Ownership ON Vehicle.Vehicle_ID = Ownership.Vehicle_ID LEFT JOIN People ON People.People_ID = Ownership.People_ID 
                        //     WHERE Vehicle.Vehicle_plate='$targetPlate'";
                        // } else {
                        //     $sql = "SELECT Vehicle.Vehicle_ID, Vehicle.Vehicle_plate, Vehicle.Vehicle_make, Vehicle.Vehicle_model, Vehicle.Vehicle_colour, People.People_name, People.People_licence  
                        //     FROM Vehicle LEFT JOIN Ownership ON Vehicle.Vehicle_ID = Ownership.Vehicle_ID LEFT JOIN People ON People.People_ID = Ownership.People_ID";
                        // }
                       
                        if($count > 0) {
                            echo "
                                <div class='table-responsive custom-table'>
                                    <table class='table'>
                                        <thead>
                                            <tr>
                                            <th scope='col' style='white-space: nowrap;'></th>
                                            <th scope='col' style='white-space: nowrap;'>Plate Number</th>
                                            <th scope='col' style='white-space: nowrap;'>Make</th>
                                            <th scope='col' style='white-space: nowrap;'>Model</th>
                                            <th scope='col' style='white-space: nowrap;'>Colour</th>
                                            <th scope='col' style='white-space: nowrap;'>Owner Name</th>
                                            <th scope='col' style='white-space: nowrap;'>Owner Licence</th>
                                            <th scope='col' style='white-space: nowrap;'>Incidents</th>
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
                                    <tr>
                                        <th>
                                            <a class='btn btn-light' data-bs-target='#editModal$vehicleId' data-bs-toggle='modal'>EDIT</a>
                                        </th>
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
                                                ID: {$rowIncident['Incident_ID']}</br>
                                                Statement: {$rowIncident['Incident_statement']}</br>
                                                People: {$rowIncident['People_name']}</br>
                                        ";
                                    }
                                } else {
                                    echo " - ";
                                }   

                                // Edit
                                include("updateVehicle.php");

                            }
                            echo "
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>";
                        } else{
                            echo "Vehicle Not Found."; 
                        }
                ?>
            </div>
            <?php
                include("addVehicle.php")
            ?>
        </main>
        <footer class="footer">
            <div class="container">
                Hsiang &copy; 2024-<?php $today = date("Y"); echo $today?>.
            </div>
        </footer>
        <!-- Bootstrap 5 JS via CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"> </script>
    </body>
</html>