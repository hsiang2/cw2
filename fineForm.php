<form id="fineAddForm">
    <div class="modal fade" tabindex="-1" id="fineAddModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Fine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" name="amount" id="amount">
                    <span class="text-danger" id="amountError" style="display:none;">Please Enter Amount.</span>
                </div>
                <div class="mb-3">
                    <label for="points" class="form-label">Points</label>
                    <input type="number" class="form-control" name="points" id="points">
                    <span class="text-danger" id="pointsError" style="display:none;">Please Enter Points.</span>
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