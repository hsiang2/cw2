<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

 include("../common/connection.php");

$targetId = $_POST["targetId"] ?? '';

if ($targetId !== '') {
    $sql = "SELECT Officer.Officer_ID, Officer.Officer_name, Officer.Officer_username, Officer.Officer_password, Officer.Officer_admin
    FROM Officer WHERE Officer.Officer_ID='$targetId' ORDER BY Officer.Officer_ID";
} else {
    $sql = "SELECT Officer.Officer_ID, Officer.Officer_name, Officer.Officer_username, Officer.Officer_password, Officer.Officer_admin
    FROM Officer ORDER BY Officer.Officer_ID";
}

$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
    if($count > 0) {
        echo "
            <div class='table-responsive custom-table'>
                <table class='table'>
                    <thead>
                        <tr>
                            <th scope='col' style='white-space: nowrap;'>Officer ID</th>
                            <th scope='col' style='white-space: nowrap;'>Name</th>
                            <th scope='col' style='white-space: nowrap;'>Username</th>
                            <th scope='col' style='white-space: nowrap;'>Password</th>
                            <th scope='col' style='white-space: nowrap;'>Admin</th>
                            <th scope='col' style='white-space: nowrap;'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $officerId = $row["Officer_ID"];
            $officerName = $row["Officer_name"];
            $officerUsername = $row["Officer_username"];
            $officerPassword = $row["Officer_password"];
            $officerAdmin = $row["Officer_admin"];
            $officerAdminPrint = $officerAdmin ? "admin" : "-";
                    
            echo "
                <tr valign='middle'>
                    <th scope='row'>$officerId</th>
                    <td>$officerName</td>
                    <td>$officerUsername</td>
                    <td>$officerPassword</td>
                    <td>$officerAdminPrint</td>
                    <td>
                        <a id='officerDeleteBtn' class='btn btn-outline-danger' data-id='$officerId' style='display: block; margin-bottom: .4rem'>DELETE</a>
                        <a class='btn btn-outline-dark' data-bs-target='#officerEditModal'  style='display: block;' data-bs-toggle='modal' data-id='$officerId' data-name='$officerName' data-username='$officerUsername' data-password='$officerPassword' data-admin='$officerAdmin'>EDIT</a>
                ";

            // Edit
            include("officerEditForm.php");
        }
        echo "
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
        ";
    } else{
        echo "<div class='message-not-found'>Officer Not Found.</div>"; 
    }
?>