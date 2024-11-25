<form id="vehicleEditForm">
    <div class="modal fade" tabindex="-1" id="vehicleEditModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit the Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
 
                <input type="hidden" name="idEdit" id="idEdit" value='<?php echo $vehicleId; ?>'>
                <div class="mb-3">
                    <label for="plateEdit" class="form-label">Plate Number</label>
                    <input type="text" class="form-control" name="plateEdit" id="plateEdit" value='<?php echo $vehiclePlate; ?>'>
                    <span class="text-danger" id="plateError" style="display:none;">Please Enter Plate Number.</span>
                </div>
                <div class="mb-3">
                    <label for="makeEdit" class="form-label">Make</label>
                    <input type="text" class="form-control" name="makeEdit" id="makeEdit" value='<?php echo $vehicleMake; ?>'>
                    <span class="text-danger" id="makeError" style="display:none;">Please Enter Make.</span>
                </div>
                <div class="mb-3">
                    <label for="modelEdit" class="form-label">Model</label>
                    <input type="text" class="form-control" name="modelEdit" id="modelEdit" value='<?php echo $vehicleModel; ?>'>
                    <span class="text-danger" id="modelError" style="display:none;">Please Enter Model.</span>
                </div>
                <div class="mb-3">
                    <label for="colourEdit" class="form-label">Colour</label>
                    <input type="text" class="form-control" name="colourEdit" id="colourEdit" value='<?php echo $vehicleColour; ?>'>
                    <span class="text-danger" id="colourError" style="display:none;">Please Enter Colour.</span>
                </div>

                <div class="mb-3">
                    <label for="ownerEdit" class="form-label">Owner</label>
                    <select class="form-select" name="ownerEdit" id="ownerEdit">
                        <option <?php echo $peopleID ? "" : "selected"; ?> value=null>Select Owner</option>
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