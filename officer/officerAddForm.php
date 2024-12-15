<form id="officerAddForm">
    <div class="modal fade" tabindex="-1" id="officerAddModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add an Officer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="id" class="form-label">Officer ID</label>
                    <input type="text" class="form-control" name="id" id="id">
                    <span class="text-danger" id="idError" style="display:none;">Please Enter Officer ID.</span>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                    <span class="text-danger" id="nameError" style="display:none;">Please Enter Name.</span>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                    <span class="text-danger" id="usernameError" style="display:none;">Please Enter Username.</span>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <span class="text-danger" id="passwordError" style="display:none;">Please Enter Password.</span>
                </div>
                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="admin" id="admin" value="true">
                    <label class="form-check-label" for="admin">Admin User</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark">SAVE</button>
            </div>
            </div>
        </div>
    </div>   
</form>