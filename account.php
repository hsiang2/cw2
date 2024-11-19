<?php
    session_start();
    if (!isset($_SESSION["user"]) || !isset($_SESSION["id"])) {
        header("Location: login.php");
        exit();
    }

    include("connection.php");

    $officerId = $_SESSION["id"];
    $officerUsername = $_SESSION["user"];

    $sql = "SELECT * FROM Officer WHERE Officer_ID='$officerId'";
    $result = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($result);

    if($count == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $officerPassword = $row['Officer_password'];
        $officerName = $row['Officer_name'];
    } else{
        echo "There was an error retrieving account information"; 
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Police Traffic Website</title>
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
            <div class="container">
                <h1>Manage Account</h1>
                <form>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" require value="<?php echo $officerUsername?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $officerPassword?>">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $officerName?>">
                    </div>
                    <div class="mb-3">
                        <label for="id" class="form-label">Officer ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?php echo $officerId?>">
                    </div>

                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                </form>
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