<form id="peopleAddForm">
    <div class="modal fade" tabindex="-1" id="peopleAddModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a Person</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                    <span class="text-danger" id="nameError" style="display:none;">Please Enter Name.</span>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address">
                    <span class="text-danger" id="addressError" style="display:none;">Please Enter Address.</span>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" name="dob" id="dob">
                    <span class="text-danger" id="dobError" style="display:none;">Please Enter Date of Birth.</span>
                </div>
                <div class="mb-3">
                    <label for="licence" class="form-label">Licence Number</label>
                    <input type="text" class="form-control" name="licence" id="licence">
                    <span class="text-danger" id="licenceError" style="display:none;">Please Enter Licence Number.</span>
                </div>
            <div class="modal-footer">
                <button type="submit" id="submit-people-add" class="btn btn-outline-dark">SAVE</button>
            </div>
            </div>
        </div>
    </div>   
</form>