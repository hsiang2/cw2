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
    

    // $(document).on('show.bs.modal', "#vehicleEditModal", function(event){
    //     $('.modal-backdrop').remove();
    //     var button = $(event.relatedTarget) 
    //     var id = button.data('id')
    //     var plate = button.data('plate')
    //     var make = button.data('make')
    //     var model = button.data('model')
    //     var colour = button.data('colour')
    //     var owner = button.data('owner')

    //     var modal = $(this)
    //     modal.find(".text-danger").hide();
    //     modal.find('.modal-body input[name="idEdit"]').val(id);
    //     modal.find('.modal-body input[name="plateEdit"]').val(plate);
    //     modal.find('.modal-body input[name="makeEdit"]').val(make);
    //     modal.find('.modal-body input[name="modelEdit"]').val(model);
    //     modal.find('.modal-body input[name="colourEdit"]').val(colour);
    //     modal.find('.modal-body select[name="ownerEdit"]').val(owner);

    //     // console.log("Opening modal. Backdrop count:", $(".modal-backdrop").length);
    // });

    // // $('#vehicleEditModal').on('hidden.bs.modal', function () {

    // //     $(".modal-backdrop").remove(); // Remove lingering backdrops
    // //     $("body").removeClass("modal-open").css("padding-right", ""); // Reset body state
    // // });

    // $(document).on("submit", "#vehicleEditForm", function(event){
    // // $(document).on('submit', 'form[id^="vehicleEditForm"]', function(event){
    //     event.preventDefault();
    //     const form = $(this);
    //     const idEdit = parseInt(form.find("input[name='idEdit']").val(), 10);
    //     const plateEdit = form.find("input[name='plateEdit']").val().trim();
    //     const makeEdit = form.find("input[name='makeEdit']").val().trim();
    //     const modelEdit = form.find("input[name='modelEdit']").val().trim();
    //     const colourEdit = form.find("input[name='colourEdit']").val().trim();
    //     const ownerEdit = form.find("select[name='ownerEdit']").val() 
    //         ? parseInt(form.find("select[name='ownerEdit']").val(), 10) 
    //         : null;
    
   
    //     let hasError = false;
       
    //     if (!plateEdit) {
    //         form.find("#plateError").show();
    //         hasError = true;
    //     }
    
    //     if (!makeEdit) {
    //         form.find("#makeError").show();
    //         hasError = true;
    //     } 
    
    //     if (!modelEdit) {
    //         form.find("#modelError").show();
    //         hasError = true;
    //     }
    
    //     if (!colourEdit) {
    //         form.find("#colourError").show();
    //         hasError = true;
    //     } 
    
    //     if (hasError) {
    //         return; 
    //     }

    //     const formData = {
    //         idEdit,
    //         plateEdit,
    //         makeEdit,
    //         modelEdit,
    //         colourEdit,
    //         ownerEdit
    //     };

    //     // var formData = $(this).serializeArray();
    //     $.ajax({
    //         url: "vehicleEdit.php",
    //         type: "POST",
    //         data: formData,
    //         success: function (res){
    //             // console.log("Raw response:", res); // Log the raw response to inspect it
    //             // try {
    //             //     const response = JSON.parse(res); // Try parsing the response
    //             //     console.log("Parsed response:", response); // Log the parsed response
    //             // } catch (e) {
    //             //     console.error("Failed to parse JSON:", e); // Catch and log any errors
    //             // }
    //             const response = JSON.parse(res);
    //             if (response.success) {
    //                 // $.ajax({
    //                 //     url: 'vehicle.php',  
    //                 //     type: 'GET',
    //                 //     success: function(res) {
    //                 //         $('#vehicleList').html(res);  
    //                 //     },
    //                 //     error: function(error) {
    //                 //         console.error('Error reloading data:', error);
    //                 //     }
    //                 // });
    //                 $('#vehicleList').load('vehicle.php');
    //                 // $('.modal').modal('hide');
    //                 // form.closest('.modal').modal('hide');
    //                 // $('body').removeClass('modal-open');
    //                 // $('.modal-backdrop').remove();
    //             } 
    //             $('#alertText').text(response.message);
    //             $("#alert").fadeIn();
    //             $('#vehicleEditModal').modal('hide');
    //             // $('.modal-backdrop').remove();

    //             // form[0].reset();
    //             // $(".modal-backdrop").remove(); // Remove lingering backdrops
    //             // $("body").removeClass("modal-open").css("padding-right", ""); // Reset body state
    //         },
    //         error: function(){
    //             $('#alertText').text("There was an error with the Ajax Call. Please try again later.");
    //             $("#alert").fadeIn();
    //             $('#vehicleEditModal').modal('hide');
    //         }
    //     });
        
    // });

    // $('#vehicleEditModal').on('hidden.bs.modal', function () {
    //     $(".modal-backdrop").remove();
    //     $("body").removeClass("modal-open").css("padding-right", "");
    //     // console.log("Closing modal. Backdrop count:", $(".modal-backdrop").length);
    // });


    // $(document).on('show.bs.modal', "#vehicleAddModal", function(event){
    //     $('.modal-backdrop').remove();

    //     var modal = $(this)
    //     modal.find(".text-danger").hide();
    //     modal.find('.modal-body input').val("");
    //     modal.find('.modal-body select').val("");
    //     // console.log("Opening modal. Backdrop count:", $(".modal-backdrop").length);
    // });
    
    // // $(document).off("submit", "#vehicleAddForm").on("submit", "#vehicleAddForm", function(event){
    // $("#vehicleAddForm").off("submit").on("submit", function (event) {
    //     event.preventDefault();
    //     const form = $(this);
    //     const plate = form.find("input[name='plate']").val().trim();
    //     const make = form.find("input[name='make']").val().trim();
    //     const model = form.find("input[name='model']").val().trim();
    //     const colour = form.find("input[name='colour']").val().trim();
    //     const owner = form.find("select[name='owner']").val() && form.find("select[name='owner']").val() !== ""
    //         ? parseInt(form.find("select[name='owner']").val(), 10) 
    //         : null;

    //     let hasError = false;
        
    //     if (!plate) {
    //         form.find("#plateError").show();
    //         hasError = true;
    //     }
    
    //     if (!make) {
    //         form.find("#makeError").show();
    //         hasError = true;
    //     } 
    
    //     if (!model) {
    //         form.find("#modelError").show();
    //         hasError = true;
    //     }
    
    //     if (!colour) {
    //         form.find("#colourError").show();
    //         hasError = true;
    //     } 
    
    //     if (hasError) {
    //         return; 
    //     }

    //     const formData = {
    //         plate,
    //         make,
    //         model,
    //         colour,
    //         owner
    //     };

    //     $.ajax({
    //         url: "vehicleAdd.php",
    //         type: "POST",
    //         data: formData,
    //         success: function (res){
    //             //  console.log("Raw response:", res); // Log the raw response to inspect it
    //             // try {
    //             //     const response = JSON.parse(res); // Try parsing the response
    //             //     console.log("Parsed response:", response); // Log the parsed response
    //             // } catch (e) {
    //             //     console.error("Failed to parse JSON:", e); // Catch and log any errors
    //             // }
    //             try {
            
    //                 const response = JSON.parse(res);
    //                 if (response.success) {
    //                     // $.ajax({
    //                     //     url: 'vehicle.php',  
    //                     //     type: 'GET',
    //                     //     success: function(res) {
    //                     //         $('#vehicleList').html(res);  
    //                     //     },
    //                     //     error: function(error) {
    //                     //         console.error('Error reloading data:', error);
    //                     //     }
    //                     // });
    //                     $('#vehicleList').load('vehicle.php');
    //                 } 
    //                 $('#alertText').text(response.message);
    //                 $("#alert").fadeIn();
    //                 $('#vehicleAddModal').modal('hide');
    //             } catch (e) {
    //                 console.error("Failed to parse JSON:", e, res); // Catch and log any errors
    //             }
    //         },
    //         error: function(){
    //             $('#alertText').text("There was an error with the Ajax Call. Please try again later.");
    //             $("#alert").fadeIn();
    //             $('#vehicleAddModal').modal('hide');
    //         }
    //     });
    // });

    // $('#vehicleAddModal').on('hidden.bs.modal', function () {
    //     // $(this).find("form")[0].reset();

    //     $(".modal-backdrop").remove();
    //     $("body").removeClass("modal-open").css("padding-right", "");
    // });

    // $(document).on('click', "#vehicleDeleteBtn", function(event){
    //     var id = $(this).data('id')
    //     $.ajax({
    //         url: "vehicleDelete.php",
    //         type: "POST",
    //         data: {id},
    //         success: function (data){
    //             if(data == 'error'){
    //                 $('#alertText').text("There was an issue delete the note from the database!");
    //                 $("#alert").fadeIn();
    //             }else{
    //                 //remove containing div
    //                 // deleteButton.parent().remove();
    //                 $('#vehicleList').load('vehicle.php');
    //             }
    //         },
    //         error: function(){
    //             $('#alertText').text("There was an error with the Ajax Call. Please try again later.");
    //             $("#alert").fadeIn();
    //         }

    //     });
        
    // });
})
