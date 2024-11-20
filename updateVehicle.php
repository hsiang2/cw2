<?php
    if (isset($_POST['plateEdit']) && $_POST['plateEdit']!="" 
    && isset($_POST['makeEdit']) && $_POST['makeEdit']!="" 
    && isset($_POST['modelEdit']) && $_POST['modelEdit']!=""
    && isset($_POST['colourEdit']) && $_POST['colourEdit']!=""
    ) // check contents of $_POST supervariables
    {     
        // construct the INSERT query
    $sqlEdit = "UPDATE Vehicle SET Vehicle_plate='" . $_POST['plateEdit'] . "', Vehicle_make='" . $_POST['makeEdit'] . "', Vehicle_model='" . $_POST['modelEdit'] . "', Vehicle_colour='" . $_POST['colourEdit'] . "' WHERE Vehicle_ID='$vehicleId'";

    // send query to the database
    // $result = mysqli_query($conn, $sql); 
    if ($conn->query($sqlEdit) === TRUE) {
                // echo "Vehicle added successfully";
                include("loadVehicle.php");
    } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
    } 
    }
?>
<form method="POST">
    <div class="modal" tabindex="-1" id="editModal<?php echo $vehicleId; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit the Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="plateEdit" class="form-label">Plate Number</label>
                    <input type="text" class="form-control" name="plateEdit" id="plateEdit" value='<?php echo $vehiclePlate; ?>'>
                </div>
                <div class="mb-3">
                    <label for="makeEdit" class="form-label">Make</label>
                    <input type="text" class="form-control" name="makeEdit" id="makeEdit" value='<?php echo $vehicleMake; ?>'>
                </div>
                <div class="mb-3">
                    <label for="modelEdit" class="form-label">Model</label>
                    <input type="text" class="form-control" name="modelEdit" id="modelEdit" value='<?php echo $vehicleModel; ?>'>
                </div>
                <div class="mb-3">
                    <label for="colourEdit" class="form-label">Colour</label>
                    <input type="text" class="form-control" name="colourEdit" id="colourEdit" value='<?php echo $vehicleColour; ?>'>
                </div>

                <div class="mb-3">
                    <label for="ownerEdit" class="form-label">Owner</label>
                    <select class="form-select" name="ownerEdit">
                        <option <?php echo $peopleID ? "" : "selected"; ?>>Select Owner</option>
                        <?php
                        
                            $sqlPeople = "SELECT People.People_ID, People.People_name, People.People_licence FROM People";
                        
                            $resultPeople = mysqli_query($conn, $sqlPeople);
                            $countPeople = mysqli_num_rows($resultPeople);
                        if($countPeople > 0) {
                            
                            while($rowPeople = mysqli_fetch_array($resultPeople, MYSQLI_ASSOC)) {
                                $peopleOptionID = $rowPeople["People_ID"];
                                $peopleOptionName = $rowPeople["People_name"];
                                $selected = ($peopleID==$peopleOptionID) ?  "selected" : "";
                                echo "<option value=$peopleOptionID $selected>$peopleOptionID $peopleOptionName</option>";
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