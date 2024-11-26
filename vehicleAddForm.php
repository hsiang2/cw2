<form id="vehicleAddForm">
    <div class="modal fade" tabindex="-1" id="vehicleAddModal">
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
                    <span class="text-danger" id="plateError" style="display:none;">Please Enter Plate Number.</span>
                </div>
                <div class="mb-3">
                    <label for="make" class="form-label">Make</label>
                    <input type="text" class="form-control" name="make" id="make">
                    <span class="text-danger" id="makeError" style="display:none;">Please Enter Make.</span>
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control" name="model" id="model">
                    <span class="text-danger" id="modelError" style="display:none;">Please Enter Model.</span>
                </div>
                <div class="mb-3">
                    <label for="colour" class="form-label">Colour</label>
                    <input type="text" class="form-control" name="colour" id="colour">
                    <span class="text-danger" id="colourError" style="display:none;">Please Enter Colour.</span>
                </div>

                <div class="mb-3">
                    <label for="owner" class="form-label">Owner</label>
                    <select class="form-select" name="owner" id="owner">
                        <option selected value="">Select Owner</option>
                        <?php
                        
                            $sqlPeople = "SELECT People.People_ID, People.People_name, People.People_licence FROM People";
                        
                            $resultPeople = mysqli_query($conn, $sqlPeople);
                            $countPeople = mysqli_num_rows($resultPeople);
                        if($countPeople > 0) {
                            
                            while($rowPeople = mysqli_fetch_array($resultPeople, MYSQLI_ASSOC)) {
                                $peopleOptionID = $rowPeople["People_ID"];
                                $peopleOptionName = $rowPeople["People_name"];
                                $peopleOptionLicence = $rowPeople["People_licence"];
                                echo "<option value=$peopleOptionID>$peopleOptionLicence $peopleOptionName</option>";
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