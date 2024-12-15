<?php
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors',1);

    $loginError = FALSE;

    if(isset($_POST["username"]) && isset($_POST["password"])) {
        include("./common/connection.php");

        $officerUsername = $_POST["username"];
        $officerPassword = $_POST["password"];

        $query = "SELECT * FROM `Officer` WHERE `Officer_username`='$officerUsername' AND `Officer_password`='$officerPassword'";
        $result = mysqli_query($conn, $query);

        $id = -1;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row["Officer_ID"];
            $admin = $row["Officer_admin"];
        }
        mysqli_close($conn);

        if ($id != -1 && !isset($_SESSION["user"]) && !isset($_SESSION["id"])) {
            $_SESSION["user"] = $officerUsername;
            $_SESSION["id"] = $id;
            $_SESSION["admin"] = $admin;

            header("Location: index.php"); 
            exit();
        } elseif (!isset($_SESSION["user"]) && !isset($_SESSION["id"])) {
            $loginError = TRUE;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Police Traffic Website | Login</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&family=Oranienbaum&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <main>
            <div class="container">
                <div class="login-form">
                    <h1 class="login-title">Login</h1>
                    <?php
                        if ($loginError)
                            echo "<span class='text-danger'>Invalid Username or Password</span>";
                    ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-dark login-btn" value="Login">SUBMIT</button>
                    </form>
                </div>
            </div>
        </main>
        <footer class="footer">
            <div class="container">
                <p>Hsiang &copy; 2024-<?php $today = date("Y"); echo $today?>.</p>
            </div>
        </footer>
        <!-- Bootstrap 5 JS via CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"> </script>
    </body>
</html>