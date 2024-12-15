$(function() {
    $.ajax({
        url: 'vehicleLoad.php',
        success: function (data) {
            $('#vehicleList').html(data);

        },
        error: function() {
            showAlert("There was an error with the Ajax Call")
        }
    });

    $("#vehicleSearchForm").submit(function(event) {
        event.preventDefault();  
    
        var formData = $(this).serializeArray();
    
        $.ajax({
            url: 'vehicleLoad.php',  
            type: 'POST',
            data: formData,  
            success: function(response) {
                $('#vehicleList').html(response);  
            },
            error: function(error) {
                console.log("Error: " + error);  
            }
        });
    });

    $(document).on('show.bs.modal', "#vehicleEditModal", function(event){
        $('.modal-backdrop').remove();
        var button = $(event.relatedTarget) 
        var id = button.data('id')
        var plate = button.data('plate')
        var make = button.data('make')
        var model = button.data('model')
        var colour = button.data('colour')
        var owner = button.data('owner')

        var modal = $(this)
        modal.find(".text-danger").hide();
        modal.find('input[name="idEdit"]').val(id);
        modal.find('input[name="plateEdit"]').val(plate);
        modal.find('input[name="makeEdit"]').val(make);
        modal.find('input[name="modelEdit"]').val(model);
        modal.find('input[name="colourEdit"]').val(colour);
        modal.find('select[name="ownerEdit"]').val(owner);
    });

    $(document).on('submit', "#vehicleEditForm", function(event){
        event.preventDefault();
        const form = $(this);
        const idEdit = parseInt(form.find("input[name='idEdit']").val(), 10);
        const plateEdit = form.find("input[name='plateEdit']").val().trim();
        const makeEdit = form.find("input[name='makeEdit']").val().trim();
        const modelEdit = form.find("input[name='modelEdit']").val().trim();
        const colourEdit = form.find("input[name='colourEdit']").val().trim();
        const ownerEdit = form.find("select[name='ownerEdit']").val() 
            ? parseInt(form.find("select[name='ownerEdit']").val(), 10) 
            : null;
   
        let hasError = false;
       
        if (!plateEdit) {
            form.find("#plateError").show();
            hasError = true;
        }
    
        if (!makeEdit) {
            form.find("#makeError").show();
            hasError = true;
        } 
    
        if (!modelEdit) {
            form.find("#modelError").show();
            hasError = true;
        }
    
        if (!colourEdit) {
            form.find("#colourError").show();
            hasError = true;
        } 
    
        if (hasError) {
            return; 
        }

        const formData = {
            idEdit,
            plateEdit,
            makeEdit,
            modelEdit,
            colourEdit,
            ownerEdit
        };

        $.ajax({
            url: "vehicleEdit.php",
            type: "POST",
            data: formData,
            success: function (res){
                if (res.success) {
                    $('#vehicleList').load('vehicle.php');
                } else {
                    showAlert(res.message)
                }
                $('#vehicleEditModal').modal('hide');
            },
            error: function(){
                showAlert("There was an error with the Ajax Call. Please try again later.")
                $('#vehicleEditModal').modal('hide');
            }
        });
        
    });

    $('#vehicleEditModal').on('hidden.bs.modal', function () {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open").css("padding-right", "");
    });


    $(document).on('show.bs.modal', "#vehicleAddModal", function(event){
        $('.modal-backdrop').remove();

        var modal = $(this)
        modal.find(".text-danger").hide();
        modal.find('.modal-body input').val("");
        modal.find('.modal-body select').val("");
    });
    
    $("#vehicleAddForm").on("submit", function (event) {
        event.preventDefault();
        const form = $(this);
        const plate = form.find("input[name='plate']").val().trim();
        const make = form.find("input[name='make']").val().trim();
        const model = form.find("input[name='model']").val().trim();
        const colour = form.find("input[name='colour']").val().trim();
        const owner = form.find("select[name='owner']").val() && form.find("select[name='owner']").val() !== ""
            ? parseInt(form.find("select[name='owner']").val(), 10) 
            : null;

        let hasError = false;
        
        if (!plate) {
            form.find("#plateError").show();
            hasError = true;
        }
    
        if (!make) {
            form.find("#makeError").show();
            hasError = true;
        } 
    
        if (!model) {
            form.find("#modelError").show();
            hasError = true;
        }
    
        if (!colour) {
            form.find("#colourError").show();
            hasError = true;
        } 
    
        if (hasError) {
            return; 
        }

        const formData = {
            plate,
            make,
            model,
            colour,
            owner
        };

        $.ajax({
            url: "vehicleAdd.php",
            type: "POST",
            data: formData,
            success: function (res){
                if (res.success) {
                    $('#vehicleList').load('vehicle.php');
                } else {
                    showAlert(res.message)
                }
                $('#vehicleAddModal').modal('hide');
            },
            error: function(){
                showAlert("There was an error with the Ajax Call. Please try again later.");
                $('#vehicleAddModal').modal('hide');
            }
        });
    });

    $('#vehicleAddModal').on('hidden.bs.modal', function () {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open").css("padding-right", "");
    });

    $(document).on('click', "#vehicleDeleteBtn", function(event){
        var id = $(this).data('id')
        var plate = $(this).data('plate')

        $.ajax({
            url: "vehicleDelete.php",
            type: "POST",
            data: {id, plate},
            success: function (res){
                if (res.success) {
                    $('#vehicleList').load('vehicle.php');
                } else{ 
                    showAlert(res.message)
                }
            },
            error: function(){
                showAlert("There was an error with the Ajax Call. Please try again later.")
            }
        });
    });

    function showAlert(message) {
        $('#alertText').text(message); 
        $("#alert").fadeIn();       
    }

    $('#alert .btn-close').on('click', function () {
        $("#alert").fadeOut(); 
    });
})
