<?php
    session_start();
    if (!isset($_SESSION["user"]) || !isset($_SESSION["id"])) {
        header("Location: /cw2/login.php");
        exit();
    }
    include("../common/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Police Traffic Website | Vehicle</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&family=Oranienbaum&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <?php
            include("../common/header.php");
        ?>
        <main>
            <div class="container" >
                <h1 class="custom-title">Search for Vehicles</h1>
                <!-- Search -->
                <form id="vehicleSearchForm" method="POST">
                    <div class="row g-2 align-items-center">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="targetPlate" id="targetPlate" placeholder="Search for Plate Number">
                                <label for="targetPlate">Plate Number</label>
                            </div>
                        </div>
                        <span class="col-md d-flex justify-content-between">
                            <button type="submit" class="btn btn-dark btn-bar">SEARCH</button>
                            <a class="btn btn-outline-dark btn-bar" data-bs-target="#vehicleAddModal" data-bs-toggle="modal">ADD</a>
                        </span>
                    </div>
                </form>
               <!-- Alert -->
               <div id="alert" class="alert alert-warning alert-dismissible fade show mt-3" style="display: none;" role="alert">
                    <p id="alertText"></p>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <!-- Vehicle Table -->
                <div id="vehicleList"></div>
            </div>
            <?php
                include("vehicleAddForm.php")
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
        <script src="vehicle.js"></script>  
    </body>
</html>