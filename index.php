<?php
    session_start();
    if (!isset($_SESSION["user"]) || !isset($_SESSION["id"])) {
        header("Location: /cw2/login.php");
        exit();
    }

    $disabled = ($_SESSION['admin']) ? "" : "disabled";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Police Traffic Website</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&family=Oranienbaum&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <?php
            include("common/header.php");
        ?>
        <main>
            <div class="banner">
                <div class="container">
                    <div class="banner-content">
                        <h1 class="banner-title">Police Traffic Website</h1>
                        <h3 class="banner-subtitle">Welcome!</h3>
                    </div> 
                </div>
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


<!-- <body>
Your main entry point to Coursework 2 should be here
</body> -->



