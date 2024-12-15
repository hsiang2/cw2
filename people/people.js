$(function() {
    $.ajax({
        url: 'peopleLoad.php',
        success: function (data) {
            $('#peopleList').html(data);

        },
        error: function() {
            showAlert("There was an error with the Ajax Call")
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
        $('.modal-backdrop').remove();
        var button = $(event.relatedTarget) 

        var id = button.data('id')
        var name = button.data('name')
        var address = button.data('address')
        var dob = button.data('dob')
        var licence = button.data('licence')

        var modal = $(this)
        modal.find(".text-danger").hide();
        modal.find('input[name="idEdit"]').val(id);
        modal.find('input[name="nameEdit"]').val(name);
        modal.find('input[name="addressEdit"]').val(address);
        modal.find('input[name="dobEdit"]').val(dob);
        modal.find('input[name="licenceEdit"]').val(licence);
    });

     $(document).on("submit", "#peopleEditForm", function(event){
        event.preventDefault();
        const form = $(this);
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

        $.ajax({
            url: "peopleEdit.php",
            type: "POST",
            data: formData,
            success: function (res){
                if (res.success) {
                    $('#peopleList').load('people.php');
                } else {
                    showAlert(res.message)
                }
                $('#peopleEditModal').modal('hide');
            },
            error: function(){
                showAlert("There was an error with the Ajax Call. Please try again later.")
                $('#peopleEditModal').modal('hide');
            }
        });
    });

    $('#peopleEditModal').on('hidden.bs.modal', function () {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open").css("padding-right", "");
    });

    $(document).on('show.bs.modal', "#peopleAddModal", function(){
        $('.modal-backdrop').remove();
        
        var modal = $(this)
        modal.find(".text-danger").hide();
        modal.find('.modal-body input').val("");
    });

    $("#peopleAddForm").on("submit", function (event) {
        event.preventDefault();
        const form = $(this);
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

        $.ajax({
            url: "peopleAdd.php",
            type: "POST",
            data: formData,
            success: function (res){
                if (res.success) {
                    $('#peopleList').load('people.php');
                }  else {
                    showAlert(res.message);
                }
                $('#peopleAddModal').modal('hide');
            },
            error: function(){
                showAlert("There was an error with the Ajax Call. Please try again later.");
                $('#peopleAddModal').modal('hide');
            }
        });
    });

    $('#peopleAddForm').on('hidden.bs.modal', function () {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open").css("padding-right", "");
    });

    $(document).on('click', "#peopleDeleteBtn", function(event){
        var id = $(this).data('id')
        var licence = $(this).data('licence')
        $.ajax({
            url: "peopleDelete.php",
            type: "POST",
            data: {id, licence},
            success: function (res){
                if (res.success) {
                    $('#peopleList').load('people.php');
                } else {
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
