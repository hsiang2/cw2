<?php
    session_start();
    if (!isset($_SESSION["user"]) || !isset($_SESSION["id"])) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Police Traffic Website | People</title>
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

                            <!-- <a class="nav-link" href="/login.php">LOGOUT</a> -->
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            <div class="container" >
                <h1>Search for People</h1>
                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="licence" class="form-label">Licence Number</label>
                        <input type="text" class="form-control" name="licence" id="licence">
                    </div>
                    <button type="submit" class="btn btn-outline-dark" value="Search">Search</button>
                </form>
                <?php
                    // if(isset($_POST["name"]) || isset($_POST["licence"])) {
                        
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
                                            <th scope='col' style='white-space: nowrap;'>ID</th>
                                            <th scope='col' style='white-space: nowrap;'>Name</th>
                                            <th scope='col' style='white-space: nowrap;'>Address</th>
                                            <th scope='col' style='white-space: nowrap;'>Date of Birth</th>
                                            <th scope='col' style='white-space: nowrap;'>Licence Number</th>
                                            <th scope='col' style='white-space: nowrap;'>Penalty Points</th>
                                            <th scope='col' style='white-space: nowrap;'>Fines</th>
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
                                    <tr>
                                        <th scope='row'>$id</th>
                                        <td>$name</td>
                                        <td>$address</td>
                                        <td>$dob</td>
                                        <td>$licence</td>
                                        <td>$totalFinePoints</td>
                                        <td>
                                    ";
                                if (mysqli_num_rows($resultFine)) {
                                    while ($rowFine = mysqli_fetch_assoc($resultFine)) {
                                        echo "
                                                ID: {$rowFine['Fine_ID']}</br>
                                                Points: {$rowFine['Fine_points']}</br>
                                                Amount: {$rowFine['Fine_amount']}</br>
                                        ";
                                    }
                                } else {
                                    echo " - ";
                                }   
                            }
                            echo "
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>";
                        } else{
                            echo "Person Not Found."; 
                        }
                    // }
                ?>
            </div>
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