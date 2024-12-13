<?php
    session_start();
    if (!isset($_SESSION["user"]) || !isset($_SESSION["id"])) {
        header("Location: login.php");
        exit();
    }

    include("connection.php");
    $disabled = ($_SESSION['admin']) ? "" : "disabled";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Police Traffic Website | Incident</title>
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
                            <a class="nav-link  <?php echo $disabled ?>" href="/cw2/officer.php">OFFICER</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/cw2/account.php">Logged in as <b><?php echo $_SESSION['user']?></b></a></li>
                        <form method="POST" action="logout.php">
                        <input class="btn btn-outline-secondary" type="submit" name="logout" value="LOGOUT" />
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            <div class="container" >
                <h1>Search for Incidents</h1>
                <!-- Alert -->
                <div id="alert" class="alert alert-primary alert-dismissible fade show" style="display: none;" role="alert">
                    <p id="alertText"></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <!-- Search -->
                <form id="incidentSearchForm" method="POST">
                    <div class="row g-2 align-items-center">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="targetPlate" id="targetPlate" placeholder="Search for Plate Number">
                                <label for="targetPlate">Plate Number</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input  type="text" class="form-control" name="targetLicence" id="targetLicence" placeholder="Search for Licence Number">
                                <label for="targetLicence">Licence Number</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <span>
                                <button type="submit" class="btn btn-outline-dark">Search</button>
                                <a class="btn btn-dark" data-bs-target="#incidentAddModal" data-bs-toggle="modal">ADD</a>
                            </span>
                            <!-- <button type="submit" class="btn btn-outline-dark" value="Search">Search</button> -->
                        </div>
                    </div>
                </form>
                <!-- Incident Table -->
                <div id="incidentList"></div>
            </div>
            <?php
                include("incidentAddForm.php")
            ?>
        </main>
        <footer class="footer">
            <div class="container">
                Hsiang &copy; 2024-<?php $today = date("Y"); echo $today?>.
            </div>
        </footer>
        <!-- Bootstrap 5 JS via CDN -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"> </script>
        <script src="incident.js"></script>  
    </body>
</html>