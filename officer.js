$(function() {
    $.ajax({
        url: 'officerLoad.php',
        success: function (data) {
            $('#officerList').html(data);

        },
        error: function() {
            $('#alertText').text("There was an error with the Ajax Call");
            $("#alert").fadeIn();
        }
    });

    $("#officerSearchForm").submit(function(event) {
        event.preventDefault();  
    
        var formData = $(this).serializeArray();
    
        $.ajax({
            url: 'officerLoad.php',  
            type: 'POST',
            data: formData,  
            success: function(response) {
                $('#officerList').html(response);  
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);  
            }
        });
    });


    $(document).on('show.bs.modal', "#officerEditModal", function(event){
        // $('.modal-backdrop').remove();
        var button = $(event.relatedTarget) 

        var id = button.data('id')
        var name = button.data('name')
        var username = button.data('username')
        var password = button.data('password')
        var admin = button.data('admin')

        var modal = $(this)
        modal.find(".text-danger").hide();
        modal.find('.modal-body input[name="idEdit"]').val(id);
        modal.find('.modal-body input[name="nameEdit"]').val(name);
        modal.find('.modal-body input[name="usernameEdit"]').val(username);
        modal.find('.modal-body input[name="passwordEdit"]').val(password);
        if (admin) {
            modal.find(".modal-body input[name='adminEdit']").prop("checked", true);
        } else {
            modal.find(".modal-body input[name='adminEdit']").prop("checked", false);
        }
    });
    
    $(document).on('click', '#submit-officer-edit', function () {
        event.preventDefault();  
        const form = $("#officerEditForm");
        const idEdit = form.find("input[name='idEdit']").val().trim();
        const nameEdit = form.find("input[name='nameEdit']").val().trim();
        const usernameEdit = form.find("input[name='usernameEdit']").val().trim();
        const passwordEdit = form.find("input[name='passwordEdit']").val().trim();
        const adminEdit = form.find("input[name='adminEdit']").prop("checked") ? 1 : 0;
    
        let hasError = false;
        
        if (!idEdit) {
            form.find("#idError").show();
            hasError = true;
        }
    
        if (!nameEdit) {
            form.find("#nameError").show();
            hasError = true;
        } 
    
        if (!usernameEdit) {
            form.find("#usernameError").show();
            hasError = true;
        }
    
        if (!passwordEdit) {
            form.find("#passwordError").show();
            hasError = true;
        } 
    
        if (hasError) {
            return; 
        }

        const formData = {
            idEdit,
            nameEdit,
            usernameEdit,
            passwordEdit,
            adminEdit
        };

        // var formData = $(this).serializeArray();
        $.ajax({
            url: "officerEdit.php",
            type: "POST",
            data: formData,
            success: function (res){
                const response = JSON.parse(res);
                if (response.success) {
                    $('#officerList').load('officer.php');
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

    $(document).on('show.bs.modal', "#officerAddModal", function(event){
        // $('.modal-backdrop').remove();

        var modal = $(this)
        modal.find(".text-danger").hide();
        modal.find('.modal-body input').val("");
        // console.log("Opening modal. Backdrop count:", $(".modal-backdrop").length);
    });

    $(document).on('click', '#submit-officer-add', function () {
        event.preventDefault();  
        const form = $("#officerAddForm");
        const id = form.find("input[name='id']").val().trim();
        const name = form.find("input[name='name']").val().trim();
        const username = form.find("input[name='username']").val().trim();
        const password = form.find("input[name='password']").val().trim();
        const admin = form.find("input[name='admin']").prop("checked") ? 1 : 0;
   
        let hasError = false;
       
        if (!id) {
            form.find("#idError").show();
            hasError = true;
        }
    
        if (!name) {
            form.find("#nameError").show();
            hasError = true;
        } 
    
        if (!username) {
            form.find("#usernameError").show();
            hasError = true;
        }
    
        if (!password) {
            form.find("#passwordError").show();
            hasError = true;
        } 
    
        if (hasError) {
            return; 
        }

        const formData = {
            id,
            name,
            username,
            password,
            admin
        };

        // var formData = $(this).serializeArray();
        $.ajax({
            url: "officerAdd.php",
            type: "POST",
            data: formData,
            success: function (res){
                const response = JSON.parse(res);
                if (response.success) {
                    $('#officerList').load('officer.php');
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

    $(document).on('click', "#officerDeleteBtn", function(event){
        var id = $(this).data('id')
        $.ajax({
            url: "officerDelete.php",
            type: "POST",
            data: {id},
            success: function (data){
                if(data == 'error'){
                    $('#alertText').text("There was an issue deleting!");
                    $("#alert").fadeIn();
                }else{
                    $('#officerList').load('officer.php');
                }
            },
            error: function(){
                $('#alertText').text("There was an error with the Ajax Call. Please try again later.");
                $("#alert").fadeIn();
            }

        });
        
    });
})
