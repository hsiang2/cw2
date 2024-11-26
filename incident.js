$(function() {
    $.ajax({
        url: 'incidentLoad.php',
        success: function (data) {
            $('#incidentList').html(data);

        },
        error: function() {
            $('#alertText').text("There was an error with the Ajax Call");
            $("#alert").fadeIn();
        }
    });

    $("#incidentSearchForm").submit(function(event) {
        event.preventDefault();  
    
        var formData = $(this).serializeArray();
    
        $.ajax({
            url: 'incidentLoad.php',  
            type: 'POST',
            data: formData,  
            success: function(response) {
                $('#incidentList').html(response);  
            },
            error: function(error) {
                console.log("Error: " + error);  
            }
        });
    });
    

    $(document).on('show.bs.modal', "#incidentEditModal", function(event){
        $('.modal-backdrop').remove();
        var button = $(event.relatedTarget) 

        var id = button.data('id')
        var time = button.data('time')
        var statement = button.data('statement')
        var vehicle = button.data('vehicle')
        var people = button.data('people')
        var offence = button.data('offence')

        var modal = $(this)
        modal.find(".text-danger").hide();
        modal.find('.modal-body input[name="idEdit"]').val(id);
        modal.find('.modal-body input[name="timeEdit"]').val(time);
        modal.find('.modal-body input[name="statementEdit"]').val(statement);
        modal.find('.modal-body input[name="vehicleEdit"]').val(vehicle);
        modal.find('.modal-body input[name="peopleEdit"]').val(people);
        modal.find('.modal-body select[name="offenceEdit"]').val(offence);
    });

    $(document).on("submit", "#incidentEditForm", function(event){
        event.preventDefault();
        const form = $(this);
        const idEdit = parseInt(form.find("input[name='idEdit']").val(), 10);
        const timeEdit = form.find("input[name='plateEdit']").val().trim();
        const statementEdit = form.find("input[name='makeEdit']").val().trim();
        const vehicleEdit = form.find("input[name='modelEdit']").val().trim();
        const peopleEdit = form.find("input[name='colourEdit']").val().trim();
        const offenceEdit = form.find("select[name='ownerEdit']").val() 
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

        // var formData = $(this).serializeArray();
        $.ajax({
            url: "incidentEdit.php",
            type: "POST",
            data: formData,
            success: function (res){
                const response = JSON.parse(res);
                if (response.success) {
                    $('#incidentList').load('incident.php');
                } 
                $('#alertText').text(response.message);
                $("#alert").fadeIn();
                $('#incidentEditModal').modal('hide');
            },
            error: function(){
                $('#alertText').text("There was an error with the Ajax Call. Please try again later.");
                $("#alert").fadeIn();
                $('#incidentEditModal').modal('hide');
            }
        });
        
    });

    $('#incidentEditModal').on('hidden.bs.modal', function () {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open").css("padding-right", "");
    });

    $(document).on('show.bs.modal', "#incidentAddModal", function(event){
        $('.modal-backdrop').remove();

        var modal = $(this)
        modal.find(".text-danger").hide();
        modal.find('.modal-body input').val("");
        modal.find('.modal-body select').val("");
    });
    
    $("#incidentAddForm").off("submit").on("submit", function (event) {
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
            url: "incidentAdd.php",
            type: "POST",
            data: formData,
            success: function (res){
                try {
                    const response = JSON.parse(res);
                    if (response.success) {
                        $('#incidentList').load('incident.php');
                    } 
                    $('#alertText').text(response.message);
                    $("#alert").fadeIn();
                    $('#incidentAddModal').modal('hide');
                } catch (e) {
                    console.error("Failed to parse JSON:", e, res); // Catch and log any errors
                }
            },
            error: function(){
                $('#alertText').text("There was an error with the Ajax Call. Please try again later.");
                $("#alert").fadeIn();
                $('#incidentAddModal').modal('hide');
            }
        });
    });

    $('#incidentAddModal').on('hidden.bs.modal', function () {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open").css("padding-right", "");
    });

    $("#fineAddForm").off("submit").on("submit", function (event) {
        event.preventDefault();

        var button = $(event.relatedTarget) 
        var id = button.data('id')
        console.log(id)

        const form = $(this);
        const amount = form.find("input[name='amount']").val().trim();
        const points = form.find("input[name='points']").val().trim();

        let hasError = false;
        
        if (!amount) {
            form.find("#amountError").show();
            hasError = true;
        }
    
        if (!points) {
            form.find("#pointsError").show();
            hasError = true;
        } 
    
        if (hasError) {
            return; 
        }

        const formData = {
            id,
            amount,
            points
        };

        $.ajax({
            url: "fineAdd.php",
            type: "POST",
            data: formData,
            success: function (res){
                try {
                    const response = JSON.parse(res);
                    if (response.success) {
                        $('#incidentList').load('incident.php');
                    } 
                    $('#alertText').text(response.message);
                    $("#alert").fadeIn();
                    $('#fineAddModal').modal('hide');
                } catch (e) {
                    console.error("Failed to parse JSON:", e, res); // Catch and log any errors
                }
            },
            error: function(){
                $('#alertText').text("There was an error with the Ajax Call. Please try again later.");
                $("#alert").fadeIn();
                $('#fineAddModal').modal('hide');
            }
        });
    });


    $(document).on('click', "#incidentDeleteBtn", function(event){
        var id = $(this).data('id')
        $.ajax({
            url: "incidentDelete.php",
            type: "POST",
            data: {id},
            success: function (data){
                if(data == 'error'){
                    $('#alertText').text("There was an issue delete the note from the database!");
                    $("#alert").fadeIn();
                }else{
                    $('#incidentList').load('incident.php');
                }
            },
            error: function(){
                $('#alertText').text("There was an error with the Ajax Call. Please try again later.");
                $("#alert").fadeIn();
            }
        });
        
    });
})
