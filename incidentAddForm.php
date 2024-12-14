<form id="incidentAddForm">
    <div class="modal fade" tabindex="-1" id="incidentAddModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add the Incident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="time" class="form-label">Time</label>
                    <input type="datetime-local" class="form-control" name="time" id="time">
                    <span class="text-danger" id="timeError" style="display:none;">Please Enter Time.</span>
                </div>
                <div class="mb-3">
                    <label for="statement" class="form-label">Statement</label>
                    <input type="text" class="form-control" name="statement" id="statement">
                    <span class="text-danger" id="statementError" style="display:none;">Please Enter Statement.</span>
                </div>

                <div class="mb-3">
                    <label for="offence" class="form-label">Offence</label>
                    <select class="form-select" name="offence" id="offence">
                        <option selected value="">Select Offence</option>
                        <?php
                            $sqlOffence = "SELECT Offence.Offence_ID, Offence.Offence_description FROM Offence";
                        
                            $resultOffence = mysqli_query($conn, $sqlOffence);
                            $countOffence = mysqli_num_rows($resultOffence);
                        if($countOffence > 0) {
                            
                            while($rowOffence = mysqli_fetch_array($resultOffence, MYSQLI_ASSOC)) {
                                $offenceOptionId = $rowOffence["Offence_ID"];
                                $offenceOptionDescription = $rowOffence["Offence_description"];
                                echo "<option value=$offenceOptionId>$offenceOptionId $offenceOptionDescription</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="vehicle" class="form-label">Vehicle</label>
                    <select class="form-select" name="vehicle" id="vehicle">
                        <option selected value="">Select Vehicle</option>
                        <?php
                        
                            $sqlVehicle = "SELECT Vehicle.Vehicle_ID, Vehicle.Vehicle_plate FROM Vehicle";
                        
                            $resultVehicle = mysqli_query($conn, $sqlVehicle);
                            $countVehicle = mysqli_num_rows($resultVehicle);
                        if($countVehicle > 0) {
                            
                            while($rowVehicle = mysqli_fetch_array($resultVehicle, MYSQLI_ASSOC)) {
                                $vehicleOptionId = $rowVehicle["Vehicle_ID"];
                                $vehicleOptionPlate = $rowVehicle["Vehicle_plate"];
                                echo "<option value=$vehicleOptionId>$vehicleOptionPlate</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="people" class="form-label">People</label>
                    <select class="form-select" name="people" id="people">
                        <option selected value="">Select People</option>
                        <?php
                        
                            $sqlPeople = "SELECT People.People_ID, People.People_name, People.People_licence FROM People";
                        
                            $resultPeople = mysqli_query($conn, $sqlPeople);
                            $countPeople = mysqli_num_rows($resultPeople);
                        if($countPeople > 0) {
                            
                            while($rowPeople = mysqli_fetch_array($resultPeople, MYSQLI_ASSOC)) {
                                $peopleOptionId = $rowPeople["People_ID"];
                                $peopleOptionName = $rowPeople["People_name"];
                                $peopleOptionLicence = $rowPeople["People_licence"];
                                echo "<option value=$peopleOptionId>$peopleOptionLicence $peopleOptionName</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark">SAVE</button>
            </div>
            </div>
        </div>
    </div>   
</form>