$(function() {
    $.ajax({
        url: 'incidentLoad.php',
        success: function (data) {
            $('#incidentList').html(data);

        },
        error: function() {
            showAlert("There was an error with the Ajax Call")
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
        modal.find('input[name="idEdit"]').val(id);
        modal.find('input[name="timeEdit"]').val(time);
        modal.find('input[name="statementEdit"]').val(statement);
        modal.find('input[name="vehicleEdit"]').val(vehicle);
        modal.find('input[name="peopleEdit"]').val(people);
        modal.find('select[name="offenceEdit"]').val(offence);
    });

    $(document).on("submit", "#incidentEditForm", function(event){
        event.preventDefault();
        const form = $(this);
        const idEdit = parseInt(form.find("input[name='idEdit']").val(), 10);
        const timeEdit = form.find("input[name='timeEdit']").val();
        const statementEdit = form.find("input[name='statementEdit']").val().trim();
        const vehicleEdit = form.find("select[name='vehicleEdit']").val() && form.find("select[name='vehicleEdit']").val() !== ""
        ? parseInt(form.find("select[name='vehicleEdit']").val(), 10) 
        : null;
        const peopleEdit = form.find("select[name='peopleEdit']").val() && form.find("select[name='peopleEdit']").val() !== ""
        ? parseInt(form.find("select[name='peopleEdit']").val(), 10) 
        : null;
        const offenceEdit = form.find("select[name='offenceEdit']").val() && form.find("select[name='offenceEdit']").val() !== ""
        ? parseInt(form.find("select[name='offenceEdit']").val(), 10) 
        : null;
        let hasError = false;
    
        if (!timeEdit) {
            form.find("#timeError").show();
            hasError = true;
        } 
    
        if (!statementEdit) {
            form.find("#statementError").show();
            hasError = true;
        }
    
        if (!vehicleEdit) {
            form.find("#vehicleError").show();
            hasError = true;
        } 

        if (!peopleEdit) {
            form.find("#peopleError").show();
            hasError = true;
        } 

        if (!offenceEdit) {
            form.find("#offenceError").show();
            hasError = true;
        } 
    
        if (hasError) {
            return; 
        }

        const formData = {
            idEdit,
            timeEdit,
            statementEdit,
            vehicleEdit,
            peopleEdit,
            offenceEdit
        };

        $.ajax({
            url: "incidentEdit.php",
            type: "POST",
            data: formData,
            success: function (res){
                if (res.success) {
                    $('#incidentList').load('incident.php');
                } else {
                    showAlert(res.message)
                }
                $('#incidentEditModal').modal('hide');
            },
            error: function(){
                showAlert("There was an error with the Ajax Call. Please try again later.")
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
    
    $("#incidentAddForm").on("submit", function (event) {
        event.preventDefault();

        const form = $(this);
        const statement = form.find("input[name='statement']").val().trim();
        const time = form.find("input[name='time']").val();
        const vehicle = form.find("select[name='vehicle']").val() && form.find("select[name='vehicle']").val() !== ""
        ? parseInt(form.find("select[name='vehicle']").val(), 10) 
        : null;
        const people = form.find("select[name='people']").val() && form.find("select[name='people']").val() !== ""
        ? parseInt(form.find("select[name='people']").val(), 10) 
        : null;
        const offence = form.find("select[name='offence']").val() && form.find("select[name='offence']").val() !== ""
        ? parseInt(form.find("select[name='offence']").val(), 10) 
        : null;

        let hasError = false;
        
        if (!statement) {
            form.find("#statementError").show();
            hasError = true;
        }
    
        if (!time) {
            form.find("#timeError").show();
            hasError = true;
        } 
    
        if (!vehicle) {
            form.find("#vehicleError").show();
            hasError = true;
        }
    
        if (!people) {
            form.find("#peopleError").show();
            hasError = true;
        } 

        if (!offence) {
            form.find("#offenceError").show();
            hasError = true;
        } 
    
        if (hasError) {
            return; 
        }

        const formData = {
            time,
            statement,
            vehicle,
            people,
            offence
        };

        $.ajax({
            url: "incidentAdd.php",
            type: "POST",
            data: formData,
            success: function (res){
                if (res.success) {
                    $('#incidentList').load('incident.php');
                } else {
                    showAlert(res.message);
                }
                $('#incidentAddModal').modal('hide');
            },
            error: function(){
                showAlert("There was an error with the Ajax Call. Please try again later.");
                $('#incidentAddModal').modal('hide');
            }
        });
    });

    $('#incidentAddModal').on('hidden.bs.modal', function () {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open").css("padding-right", "");
    });

    $(document).on('show.bs.modal', "#fineModal", function(event){
        $('.modal-backdrop').remove();
        var button = $(event.relatedTarget) 

        var incident = button.data('incident')
        var id = button.data('id')
        var amount = button.data('amount')
        var points = button.data('points')

        var modal = $(this)
        modal.find(".text-danger").hide();
        modal.find('input[name="id"]').val(id);
        modal.find('input[name="incident"]').val(incident);
        modal.find('input[name="amount"]').val(amount);
        modal.find('input[name="points"]').val(points);
    });

    $(document).on("submit", "#fineForm", function (event) {
        event.preventDefault();

        const form = $(this);
        const fineId = form.find("input[name='id']").val() ? parseInt(form.find("input[name='id']").val(), 10) 
        : null;
        const incident = parseInt(form.find("input[name='incident']").val(), 10);
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
            fineId,
            incident,
            amount,
            points
        };

        $.ajax({
            url: "fineUpdate.php",
            type: "POST",
            data: formData,
            success: function (res){
                if (res.success) {
                    $('#incidentList').load('incident.php');
                } else {
                    showAlert(res.message)
                }
                $('#fineModal').modal('hide');
            },
            error: function(){
                showAlert("There was an error with the Ajax Call. Please try again later.")
                $('#fineModal').modal('hide');
            }
        });
    });

    $('#fineModal').on('hidden.bs.modal', function () {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open").css("padding-right", "");
    });


    $(document).on('click', "#incidentDeleteBtn", function(event){
        var id = parseInt($(this).data('id'), 10) 
        var fine = $(this).data('fine') ? parseInt($(this).data('fine'), 10) 
        : null;

        $.ajax({
            url: "incidentDelete.php",
            type: "POST",
            data: {id, fine},
            success: function (res){
                if(res.success){
                    $('#incidentList').load('incident.php');
                }else{
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
