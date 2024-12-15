$(function() {
    $.ajax({
        url: 'officerLoad.php',
        success: function (data) {
            $('#officerList').html(data);

        },
        error: function() {
            showAlert("There was an error with the Ajax Call")
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
        $('.modal-backdrop').remove();
        var button = $(event.relatedTarget) 

        var id = button.data('id')
        var name = button.data('name')
        var username = button.data('username')
        var password = button.data('password')
        var admin = button.data('admin')

        var modal = $(this)
        modal.find(".text-danger").hide();
        modal.find('input[name="idEdit"]').val(id);
        modal.find('input[name="nameEdit"]').val(name);
        modal.find('input[name="usernameEdit"]').val(username);
        modal.find('input[name="passwordEdit"]').val(password);
        if (admin) {
            modal.find("input[name='adminEdit']").prop("checked", true);
        } else {
            modal.find("input[name='adminEdit']").prop("checked", false);
        }
    });

    $(document).on("submit", "#officerEditForm", function(event){
        event.preventDefault();  
        const form = $(this);
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

        $.ajax({
            url: "officerEdit.php",
            type: "POST",
            data: formData,
            success: function (res){
                if (res.success) {
                    $('#officerList').load('officer.php');
                } else {
                    showAlert(res.message)
                }
                $('#officerEditModal').modal('hide');
            },
            error: function(){
                showAlert("There was an error with the Ajax Call. Please try again later.")
                $('#officerEditModal').modal('hide');
            }
        });
            
    });

    $('#officerEditModal').on('hidden.bs.modal', function () {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open").css("padding-right", "");
    });

    $(document).on('show.bs.modal', "#officerAddModal", function(event){
        $('.modal-backdrop').remove();

        var modal = $(this)
        modal.find(".text-danger").hide();
        modal.find('.modal-body input').val("");
    });

    $("#officerAddForm").on("submit", function (event) {
        event.preventDefault();  
        const form = $(this);
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

        $.ajax({
            url: "officerAdd.php",
            type: "POST",
            data: formData,
            success: function (res){
                if (res.success) {
                    $('#officerList').load('officer.php');
                } else {
                    showAlert(res.message);
                }
                $('#officerAddModal').modal('hide');
            },
            error: function(){
                showAlert("There was an error with the Ajax Call. Please try again later.");
                $('#officerAddModal').modal('hide');
            }
        });
    });

    $('#officerAddForm').on('hidden.bs.modal', function () {
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open").css("padding-right", "");
    });

    $(document).on('click', "#officerDeleteBtn", function(event){
        var id = $(this).data('id')
        $.ajax({
            url: "officerDelete.php",
            type: "POST",
            data: {id},
            success: function (res){
                if (res.success) {
                    $('#officerList').load('officer.php');
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
