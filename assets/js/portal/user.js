//===========================================================================
// REALIZAR ACCIONES CUANDO EL DOCUMENTO SE CARGUE
//===========================================================================

$(document).ready(function() {

    //===========================================================================
    // ACTIVAR TOOLTIP DE BOOTSTRAP 4
    //===========================================================================

    $('[data-toggle="tooltip"]').tooltip();

    //===========================================================================
    // FORMULARIO PARA VALIDAR UNA PROVINCIA
    //===========================================================================

    $("#formUser").validate({
        rules: {
            inputFirstName: {
                required: true
            },
            inputLastName: {
                required: true
            },
            inputNewPassword:{
                minlength: 5,
                maxlength: 13
            },
            inputNewPasswordShadow:{
                minlength: 5,
                maxlength: 13
            }
        },
        highlight: function(element) {
            $(element).parent().removeClass('has-success').addClass('has-error');
        },

        unhighlight: function(element) {
            $(element).parent().removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if (element.length) {
                error.insertAfter(element);
            } else {
                error.insertAfter(element);
            }
        },
        messages: {
            inputFirstName: {
                required: '<em class="text-danger">Escribe el nombre completo</em>'
            },
            inputLastName: {
                required: '<em class="text-danger">Escribe los apellidos</em>'
            },
            inputNewPasswordShadow:{
                equalTo: '<em class="text-danger">Las contraseñas no coinciden</em>'
            }
        },
        submitHandler: function(form) {
            $.ajax({
                method: "POST",
                url: "/usuario",
                data: $("#formUser").serialize(),
                beforeSend: function() {
                    $("#userButton").attr("disabled", true);
                },
                success: function(data) {
                    var x = jQuery.parseJSON(data);
                    // console.log(x);
                    lanzarToast(x.response, x.message);
                    $("#userButton").removeAttr('disabled');
                }
            });
            return false;
        }
    });

    //===========================================================================
    // FORMULARIO PARA SUBIR UNA IMAGEN DE UNA PROVINCIA
    //===========================================================================

    $("#formUpload").submit(function(e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "/usuario/upload_file",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $('#uploadButton').attr('disabled', true);
                lanzarToast('warning','¡Se está cargando la imagen!');
            },
            success: function(data) {
                // console.log(data);
                var x = jQuery.parseJSON(data);
                // console.log(x);
                lanzarToast(x.response, x.message);
                $('#uploadButton').removeAttr('disabled');
                if (x.response == 'success'){
                    $('#valueImage').attr('value', x.data.file_name);
                    $('#imgPreview').attr('src', '/uploads/'+x.data.file_name);
                }
            }
        });
        return false;
    });

});


