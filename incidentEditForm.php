<form id="incidentEditForm">
    <div class="modal fade" tabindex="-1" id="incidentEditModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit the Incident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
 
                <input type="hidden" name="idEdit" id="idEdit" value='<?php echo $incidentId; ?>'>
                <div class="mb-3">
                    <label for="timeEdit" class="form-label">Time</label>
                    <input type="datetime-local" class="form-control" name="timeEdit" id="timeEdit" value='<?php echo $incidentTime; ?>'>
                    <span class="text-danger" id="timeError" style="display:none;">Please Enter Time.</span>
                </div>
                <div class="mb-3">
                    <label for="statementEdit" class="form-label">Statement</label>
                    <input type="text" class="form-control" name="statementEdit" id="statementEdit" value='<?php echo $incidentStatement; ?>'>
                    <span class="text-danger" id="statementError" style="display:none;">Please Enter Statement.</span>
                </div>

                <div class="mb-3">
                    <label for="offenceEdit" class="form-label">Offence</label>
                    <select class="form-select" name="offenceEdit" id="offenceEdit">
                        <option <?php echo $offenceId ? "" : "selected"; ?> value=null>Select Offence</option>
                        <?php
                            $sqlOffence = "SELECT Offence.Offence_ID, Offence.Offence_description FROM Offence";
                        
                            $resultOffence = mysqli_query($conn, $sqlOffence);
                            $countOffence = mysqli_num_rows($resultOffence);
                        if($countOffence > 0) {
                            
                            while($rowOffence = mysqli_fetch_array($resultOffence, MYSQLI_ASSOC)) {
                                $offenceOptionId = $rowOffence["Offence_ID"];
                                $offenceOptionDescription = $rowOffence["Offence_description"];
                                $selected = ($offenceId==$offenceOptionId) ?  "selected" : "";
                                echo "<option value=$offenceOptionId $selected>$offenceOptionId $offenceOptionDescription</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="vehicleEdit" class="form-label">Vehicle</label>
                    <select class="form-select" name="vehicleEdit" id="vehicleEdit">
                        <option <?php echo $vehicleId ? "" : "selected"; ?> value=null>Select Vehicle</option>
                        <?php
                        
                            $sqlVehicle = "SELECT Vehicle.Vehicle_ID, Vehicle.Vehicle_plate FROM Vehicle";
                        
                            $resultVehicle = mysqli_query($conn, $sqlVehicle);
                            $countVehicle = mysqli_num_rows($resultVehicle);
                        if($countVehicle > 0) {
                            
                            while($rowVehicle = mysqli_fetch_array($resultVehicle, MYSQLI_ASSOC)) {
                                $vehicleOptionId = $rowVehicle["Vehicle_ID"];
                                $vehicleOptionPlate = $rowVehicle["Vehicle_plate"];
                                $selected = ($vehicleId==$vehicleOptionId) ?  "selected" : "";
                                echo "<option value=$vehicleOptionId $selected>$vehicleOptionPlate</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="peopleEdit" class="form-label">People</label>
                    <select class="form-select" name="peopleEdit" id="peopleEdit">
                        <option <?php echo $peopleId ? "" : "selected"; ?> value=null>Select People</option>
                        <?php
                        
                            $sqlPeople = "SELECT People.People_ID, People.People_name, People.People_licence FROM People";
                        
                            $resultPeople = mysqli_query($conn, $sqlPeople);
                            $countPeople = mysqli_num_rows($resultPeople);
                        if($countPeople > 0) {
                            
                            while($rowPeople = mysqli_fetch_array($resultPeople, MYSQLI_ASSOC)) {
                                $peopleOptionId = $rowPeople["People_ID"];
                                $peopleOptionName = $rowPeople["People_name"];
                                $peopleOptionLicence = $rowPeople["People_licence"];
                                $selected = ($peopleId==$peopleOptionId) ?  "selected" : "";
                                echo "<option value=$peopleOptionId $selected>$peopleOptionLicence $peopleOptionName</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-dark">SAVE</button>
            </div>
            </div>
        </div>
    </div>   
</form>