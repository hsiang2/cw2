<?php
    // session_start();
    // include('connection.php');
       
    if (isset($_POST['plate']) && $_POST['plate']!="" 
    && isset($_POST['make']) && $_POST['make']!="" 
    && isset($_POST['model']) && $_POST['model']!=""
    && isset($_POST['colour']) && $_POST['colour']!=""
    ) // check contents of $_POST supervariables
    {     
        // construct the INSERT query
        $sqlAdd = "INSERT INTO Vehicle(Vehicle_plate, Vehicle_make, Vehicle_model, Vehicle_colour) VALUES ('" . $_POST['plate'] . "','" . $_POST['make'] ."','" . $_POST['model'] . "','" . $_POST['colour'] . "');";
        // send query to the database
        $resultAdd = mysqli_query($conn, $sqlAdd); 
        $vehicleID = mysqli_insert_id($conn);

        if($vehicleID) {
            // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            // $id = $row['Vehicle_ID'];

            if (isset($_POST['owner']) && isset($_POST['owner']) != null) {

                $sqlOwner = "INSERT INTO Ownership(Vehicle_ID, People_ID) VALUES ('" . $vehicleID . "','" . $_POST['owner'] . "');";
                if ($conn->query($sqlOwner) === TRUE) {
                    // echo "Vehicle added successfully";
                    include("loadVehicle.php");
                } else {
                    // echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else{
            // echo "There was an error adding vehicle"; 
        }  
        // }
        // if ($conn->query($sql) === TRUE) {
        //     echo "Vehicle added successfully";
        // } else {
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }

       
    }
?>

<!-- Add Form -->
<form method="POST">
    <div class="modal" tabindex="-1" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="plate" class="form-label">Plate Number</label>
                    <input type="text" class="form-control" name="plate" id="plate">
                </div>
                <div class="mb-3">
                    <label for="make" class="form-label">Make</label>
                    <input type="text" class="form-control" name="make" id="make">
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control" name="model" id="model">
                </div>
                <div class="mb-3">
                    <label for="colour" class="form-label">Colour</label>
                    <input type="text" class="form-control" name="colour" id="colour">
                </div>

                <div class="mb-3">
                    <label for="owner" class="form-label">Owner</label>
                    <select class="form-select" name="owner">
                        <option selected>Select Owner</option>
                        <?php
                        
                            $sqlPeople = "SELECT People.People_ID, People.People_name, People.People_licence FROM People";
                        
                            $resultPeople = mysqli_query($conn, $sqlPeople);
                            $countPeople = mysqli_num_rows($resultPeople);
                        if($countPeople > 0) {
                            
                            while($rowPeople = mysqli_fetch_array($resultPeople, MYSQLI_ASSOC)) {
                                $peopleOptionID = $rowPeople["People_ID"];
                                $peopleOptionName = $rowPeople["People_name"];
                                echo "<option value=$peopleOptionID>$peopleOptionID $peopleOptionName</option>";
                            }
                        }
                        ?>
                    </select>
                    <!-- <input type="text" class="form-control" name="plate" id="plate"> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <input type="button" class="btn btn-primary">Save changes</button> -->
                <button type="submit" class="btn btn-outline-dark" value="Save">SAVE</button>
            </div>
            </div>
        </div>
    </div>   
</form>