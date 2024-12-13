<form id="peopleEditForm">
    <div class="modal fade" tabindex="-1" id="peopleEditModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit the Person</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
 
                <input type="hidden" name="idEdit" id="idEdit" value='<?php echo $id; ?>'>
                <div class="mb-3">
                    <label for="nameEdit" class="form-label">Name</label>
                    <input type="text" class="form-control" name="nameEdit" id="nameEdit" value='<?php echo $name; ?>'>
                    <span class="text-danger" id="nameError" style="display:none;">Please Enter Name.</span>
                </div>
                <div class="mb-3">
                    <label for="addressEdit" class="form-label">Address</label>
                    <input type="text" class="form-control" name="addressEdit" id="addressEdit" value='<?php echo $address; ?>'>
                    <span class="text-danger" id="addressError" style="display:none;">Please Enter Address.</span>
                </div>
                <div class="mb-3">
                    <label for="dobEdit" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" name="dobEdit" id="dobEdit" value='<?php echo $dob; ?>'>
                    <span class="text-danger" id="dobError" style="display:none;">Please Enter Date of Birth.</span>
                </div>
                <div class="mb-3">
                    <label for="licenceEdit" class="form-label">Licence Number</label>
                    <input type="text" class="form-control" name="licenceEdit" id="licenceEdit" value='<?php echo $licence; ?>'>
                    <span class="text-danger" id="licenceError" style="display:none;">Please Enter Licence Number.</span>
                </div>
            <div class="modal-footer">
                <button type="submit" id="submit-people-edit" class="btn btn-outline-dark">SAVE</button>
            </div>
            </div>
        </div>
    </div>   
</form>