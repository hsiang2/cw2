$(function() {
    $.ajax({
        url: 'peopleLoad.php',
        success: function (data) {
            $('#peopleList').html(data);

        },
        error: function() {
            $('#alertText').text("There was an error with the Ajax Call");
            $("#alert").fadeIn();
        }
    });

    $("#peopleSearchForm").submit(function(event) {
        event.preventDefault();  
    
        var formData = $(this).serializeArray();
    
        $.ajax({
            url: 'peopleLoad.php',  
            type: 'POST',
            data: formData,  
            success: function(response) {
                $('#peopleList').html(response);  
            },
            error: function(error) {
                console.log("Error: " + error);  
            }
        });
    });

    $(document).on('show.bs.modal', "#peopleEditModal", function(event){
        var button = $(event.relatedTarget) 
        var id = button.data('id')
        var name = button.data('name')
        var address = button.data('address')
        var dob = button.data('dob')
        var licence = button.data('licence')

        var modal = $(this)
        modal.find(".text-danger").hide();
        modal.find('.modal-body input[name="idEdit"]').val(id);
        modal.find('.modal-body input[name="nameEdit"]').val(name);
        modal.find('.modal-body input[name="addressEdit"]').val(address);
        modal.find('.modal-body input[name="dobEdit"]').val(dob);
        modal.find('.modal-body input[name="licenceEdit"]').val(licence);
    });

    $(document).on('click', '#submit-people-edit', function () {
        event.preventDefault();
        const form = $("#peopleEditForm");
        const idEdit = parseInt(form.find("input[name='idEdit']").val(), 10);
        const nameEdit = form.find("input[name='nameEdit']").val().trim();
        const addressEdit = form.find("input[name='addressEdit']").val().trim();
        const dobEdit = form.find("input[name='dobEdit']").val();
        const licenceEdit = form.find("input[name='licenceEdit']").val().trim();
    
   
        let hasError = false;
       
        if (!nameEdit) {
            form.find("#nameError").show();
            hasError = true;
        }
    
        if (!addressEdit) {
            form.find("#addressError").show();
            hasError = true;
        } 
    
        if (!dobEdit) {
            form.find("#dobError").show();
            hasError = true;
        }
    
        if (!licenceEdit) {
            form.find("#licenceError").show();
            hasError = true;
        } 
    
        if (hasError) {
            return; 
        }

        const formData = {
            idEdit,
            nameEdit,
            addressEdit,
            dobEdit,
            licenceEdit,
        };

        // var formData = $(this).serializeArray();
        $.ajax({
            url: "peopleEdit.php",
            type: "POST",
            data: formData,
            success: function (res){
                const response = JSON.parse(res);
                if (response.success) {
                    $('#peopleList').load('people.php');
                } 
                $('#alertText').text(response.message);
                $("#alert").fadeIn();
                form[0].submit();
            },
            error: function(){
                $('#alertText').text("There was an error with the Ajax Call. Please try again later.");
                $("#alert").fadeIn();
            }
        });
    });

    $(document).on('show.bs.modal', "#peopleAddModal", function(event){

        var modal = $(this)
        modal.find(".text-danger").hide();
        modal.find('.modal-body input').val("");
    });

    $(document).on('click', '#submit-people-add', function () {
        event.preventDefault();
        const form = $("#peopleAddForm");
        const id = parseInt(form.find("input[name='id']").val(), 10);
        const name = form.find("input[name='name']").val().trim();
        const address = form.find("input[name='address']").val().trim();
        const dob = form.find("input[name='dob']").val();
        const licence = form.find("input[name='licence']").val().trim();
    
   
        let hasError = false;
       
        if (!name) {
            form.find("#nameError").show();
            hasError = true;
        }
    
        if (!address) {
            form.find("#addressError").show();
            hasError = true;
        } 
    
        if (!dob) {
            form.find("#dobError").show();
            hasError = true;
        }
    
        if (!licence) {
            form.find("#licenceError").show();
            hasError = true;
        } 
    
        if (hasError) {
            return; 
        }

        const formData = {
            id,
            name,
            address,
            dob,
            licence,
        };

        // var formData = $(this).serializeArray();
        $.ajax({
            url: "peopleAdd.php",
            type: "POST",
            data: formData,
            success: function (res){
                const response = JSON.parse(res);
                if (response.success) {
                    $('#peopleList').load('people.php');
                } 
                // $('#alertText').text(response.message);
                // $("#alert").fadeIn();
                form[0].submit();
            },
            error: function(){
                $('#alertText').text("There was an error with the Ajax Call. Please try again later.");
                $("#alert").fadeIn();
                form[0].submit();
            }
        });
    });

    $(document).on('click', "#peopleDeleteBtn", function(event){
        var id = $(this).data('id')
        $.ajax({
            url: "peopleDelete.php",
            type: "POST",
            data: {id},
            success: function (data){
                if(data == 'error'){
                    $('#alertText').text("There was an issue deleting!");
                    $("#alert").fadeIn();
                }else{
                    $('#peopleList').load('people.php');
                }
            },
            error: function(){
                $('#alertText').text("There was an error with the Ajax Call. Please try again later.");
                $("#alert").fadeIn();
            }
        });
    });
   
})
