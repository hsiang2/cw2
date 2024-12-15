<?php
    session_start();
    if (!isset($_SESSION["user"]) || !isset($_SESSION["id"])) {
        header("Location: /cw2/login.php");
        exit();
    }

    include("../common/connection.php");

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
        <title>Police Traffic Website | Account</title>
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
            <div class="container">
                    <div class="login-form">
                    <h1 class="custom-title">Manage Account</h1>
                    <?php
                        include("updateAccount.php");
                    ?>
                        <form method="POST">
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
                            <button type="submit" class="btn btn-dark login-btn" value="Update">UPDATE</button>
                        </form>
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