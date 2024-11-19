<?php
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors',1);

    $loginError = FALSE;

    // if (isset($_POST["logout"])) {
    //     unset($_SESSION["user"]);
    //     unset($_SESSION["id"]);
    // }

    if(isset($_POST["username"]) && isset($_POST["password"])) {
        // require("db.inc.php");
        // $conn = mysqli_connect($servername, $username, $password, $dbname);
        // if(!$conn) {
        //     die("Connection failed");
        // }
        include("connection.php");

        $officerUsername = $_POST["username"];
        $officerPassword = $_POST["password"];

        $query = "SELECT * FROM `Officer` WHERE `Officer_username`='$officerUsername' AND `Officer_password`='$officerPassword'";
        $result = mysqli_query($conn, $query);

        $id = -1;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row["Officer_ID"];
        }
        mysqli_close($conn);

        if ($id != -1 && !isset($_SESSION["user"]) && !isset($_SESSION["id"])) {
            $_SESSION["user"] = $officerUsername;
            $_SESSION["id"] = $id;

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
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <main>
            <div class="container">
                <h1>Login</h1>
                <?php
                //   if(isset($_SESSION["user"]) && isset($_SESSION["id"])) {
                ?>
                <!-- <form method="POST"> -->
                <?php
                //  echo "<p>" . $_SESSION["user"] . " is logged in</p>";
                ?>
                    <!-- <input type="submit" name="logout" value="Logout" />
                </form> -->
                <?php
                    // } else 
                    // if (!isset($_SESSION["user"]) && !isset($_SESSION["id"])) {
                        if ($loginError)
                            echo "<p>Invalid Username or Password</p>";
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
                    <button type="submit" class="btn btn-primary" value="Login">Submit</button>
                </form>
                <!-- <form method="POST">
                    Username: 
                    <input name="username" type="text" id="username" value="" size="30"  maxlength="32" required/><br/>

                    Password:
                    <input name="password" type="password" id="password" value="" size="30"  maxlength="32" required/><br/>
                    <input name="login" type="submit" value="Login"/>
                </form> -->
                <?php
                    // }
                ?>
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