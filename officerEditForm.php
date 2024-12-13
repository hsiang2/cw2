<form id="officerEditForm">
    <div class="modal fade" tabindex="-1" id="officerEditModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit the Officer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="idEdit" class="form-label">Officer ID</label>
                    <input type="text" class="form-control" name="idEdit" id="idEdit" value='<?php echo $officerId; ?>' disabled>
                    <span class="text-danger" id="idError" style="display:none;">Please Enter Officer ID.</span>
                </div>
                <div class="mb-3">
                    <label for="nameEdit" class="form-label">Name</label>
                    <input type="text" class="form-control" name="nameEdit" id="nameEdit" value='<?php echo $officerName; ?>'>
                    <span class="text-danger" id="nameError" style="display:none;">Please Enter Name.</span>
                </div>
                <div class="mb-3">
                    <label for="usernameEdit" class="form-label">Username</label>
                    <input type="text" class="form-control" name="usernameEdit" id="usernameEdit" value='<?php echo $officerUsername; ?>'>
                    <span class="text-danger" id="usernameError" style="display:none;">Please Enter Username.</span>
                </div>
                <div class="mb-3">
                    <label for="passwordEdit" class="form-label">Password</label>
                    <input type="password" class="form-control" name="passwordEdit" id="passwordEdit" value='<?php echo $officerPassword; ?>'>
                    <span class="text-danger" id="passwordError" style="display:none;">Please Enter Password.</span>
                </div>
                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="adminEdit" id="adminEdit" value="true" <?php echo $officerAdmin ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="adminEdit">Admin User</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submit-officer-edit" class="btn btn-outline-dark">SAVE</button>
            </div>
            </div>
        </div>
    </div>   
</form>