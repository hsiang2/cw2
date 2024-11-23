$(function() {
    $.ajax({
        url: 'vehicleLoad.php',
        success: function (data) {
            $('#vehicleList').html(data);

        },
        error: function() {
            $('#alertText').text("There was an error with the Ajax Call");
            $("#alert").fadeIn();
        }
    });
    
    // $(document).on('click', '.editBtn', function () {
    //     const modalId = $(this).data('bs-target');
    //     $(modalId).modal('show');
    // });


    $(document).on('show.bs.modal', "#vehicleEditModal", function(event){
        var button = $(event.relatedTarget) 
        var id = button.data('id')
        var plate = button.data('plate')
        var make = button.data('make')
        var model = button.data('model')
        var colour = button.data('colour')
        var owner = button.data('owner')

        var modal = $(this)
        modal.find(".text-danger").hide();
        modal.find('.modal-body input[name="idEdit"]').val(id);
        modal.find('.modal-body input[name="plateEdit"]').val(plate);
        modal.find('.modal-body input[name="makeEdit"]').val(make);
        modal.find('.modal-body input[name="modelEdit"]').val(model);
        modal.find('.modal-body input[name="colourEdit"]').val(colour);
        modal.find('.modal-body select[name="ownerEdit"]').val(owner);
    });

    // $('#vehicleEditModal').on('hidden.bs.modal', function () {
    //     // const form = $(this).find('form');
    //     // form[0].reset();  // Reset form inputs when modal is closed

    //     // // Manually remove any lingering backdrop
    //     // $('.modal-backdrop').remove();

    //     // // Optionally, ensure modal is properly reset after closing
    //     // $('body').removeClass('modal-open').css('padding-right', '');
    //     // $('.modal').removeClass('in');
    //     $(".modal-backdrop").remove();

    //     // Reset the body's scrollbar state
    //     $("body").removeClass("modal-open").css("padding-right", "");
    
    //     // Optionally reset the modal's content or state
    //     $(this).find("form")[0].reset(); // Reset form fields
    // });

    $(document).on("submit", "#vehicleEditForm", function(event){
    // $(document).on('submit', 'form[id^="vehicleEditForm"]', function(event){
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
    

        // const idEdit = parseInt($("#idEdit").val(), 10)
        // const plateEdit = $("#plateEdit").val().trim();
        // const makeEdit = $("#makeEdit").val().trim();
        // const modelEdit = $("#modelEdit").val().trim();
        // const colourEdit = $("#colourEdit").val().trim();
        // const ownerEdit = $("#ownerEdit").val() ? parseInt($("#ownerEdit").val(), 10) : null;

        // if (!plateEdit) {
        //     $("#plateError").show();
        //     return;
        // } else {
        //     $("#plateError").hide();
        // }

        // if (!makeEdit) {
        //     $("#makeError").show();
        //     return;
        // } else {
        //     $("#makeError").hide();
        // }

        // if (!modelEdit) {
        //     $("#modelError").show();
        //     return;
        // } else {
        //     $("#modelError").hide();
        // }

        // if (!colourEdit) {
        //     $("#colourError").show();
        //     return;
        // } else {
        //     $("#colourError").hide();
        // }

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
            url: "vehicleEdit.php",
            type: "POST",
            data: formData,
            success: function (res){
                // console.log("Raw response:", res); // Log the raw response to inspect it
                // try {
                //     const response = JSON.parse(res); // Try parsing the response
                //     console.log("Parsed response:", response); // Log the parsed response
                // } catch (e) {
                //     console.error("Failed to parse JSON:", e); // Catch and log any errors
                // }
                const response = JSON.parse(res);
                if (response.success) {
                    $.ajax({
                        url: 'vehicle.php',  
                        type: 'GET',
                        success: function(res) {
                            $('#vehicleList').html(res);  
                        },
                        error: function(error) {
                            console.error('Error reloading data:', error);
                        }
                    });
                    $('#alertText').text(response.message);
                    $("#alert").fadeIn();

                    

                    // $('.modal').modal('hide');
                    // form.closest('.modal').modal('hide');
                    // $('body').removeClass('modal-open');
                    // $('.modal-backdrop').remove();

                } else {
                    $('#alertText').text(response.message);
                    $("#alert").fadeIn();
                }
                $('#vehicleEditModal').modal('hide');

                form[0].reset();
            },
            error: function(){
                $('#alertText').text("There was an error with the Ajax Call. Please try again later.");
                $("#alert").fadeIn();
                $('#vehicleEditModal').modal('hide');
            }
        });
        
    });

    
    
})