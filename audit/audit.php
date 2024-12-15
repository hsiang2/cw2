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
        <title>Police Traffic Website | Audit Trail</title>
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
                <h1 class="custom-title">Search for Audits</h1>
                <!-- Search -->
                <form id="auditSearchForm" method="POST">
                    <div class="row g-2 align-items-center">
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select" id="officer" name="officer">
                                    <option selected value="">All Officers</option>
                                    <?php
                                        $sqlOfficer = "SELECT Officer_ID FROM Officer";
                                        $resultOfficer = mysqli_query($conn, $sqlOfficer);
                                        $countOfficer = mysqli_num_rows($resultOfficer);
                                    if($countOfficer > 0) {
                                        while($rowOfficer = mysqli_fetch_array($resultOfficer, MYSQLI_ASSOC)) {
                                            $officerOptionId = $rowOfficer["Officer_ID"];
                                            echo "<option value=$officerOptionId>$officerOptionId</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="officer">Officer ID</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-select" id="table" name="table">
                                    <option selected value="">All Tables</option>
                                    <?php
                                        $tables = ["People", "Vehicle", "Incident", "Officer"];
                                        echo implode("", array_map(fn($v) => "<option value='$v'>$v</option>", $tables));
                                    ?>
                                </select>
                                <label for="table">Table</label>
                            </div>
                        </div>
                        <span class="col-md">
                            <button type="submit" class="btn btn-dark btn-bar">SEARCH</button>
                        </span>
                    </div>
                </form>
               
                <!-- Audit Table -->
                <div id="auditList">
<?php
    $targetOfficer = $_POST["officer"] ?? '';
    $targetTable = $_POST["table"] ?? '';
    $sql = "SELECT Officer_ID, Audit_action, Audit_record, Audit_table, Audit_time FROM Audit WHERE (Officer_ID='$targetOfficer' OR '$targetOfficer' = '') AND (Audit_table='$targetTable' OR '$targetTable'='') ORDER BY Audit_ID DESC";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if($count > 0) {
        echo "
            <div class='table-responsive custom-table'>
                <table class='table'>
                    <thead>
                        <tr>
                            <th scope='col' style='white-space: nowrap;'>Officer ID</th>
                            <th scope='col' style='white-space: nowrap;'>Table</th>
                            <th scope='col' style='white-space: nowrap;'>Action</th>
                            <th scope='col' style='white-space: nowrap;'>Record</th>
                            <th scope='col' style='white-space: nowrap;'>Time</th>
                        </tr>
                    </thead>
                    <tbody>";

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $officer = $row["Officer_ID"] ?? '-';
            $action = $row["Audit_action"];
            $record = $row['Audit_record'];
            $table = $row['Audit_table'];
            $time = $row['Audit_time'];
          
            echo "
                <tr valign='middle'>
                    <th scope='row'>$officer</td>
                    <td>$table</td>
                    <td>$action</td>
                    <td>$record</td>
                    <td>$time</td>
                ";
        }
        echo "
                </tr>
            </tbody>
            </table>
        </div>";
    } else{
        echo "<div class='message-not-found'>Audit Not Found.</div>"; 
    }
?>
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