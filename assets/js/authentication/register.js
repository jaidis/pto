$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip();

    //===========================================================================
    // REGLA DE VALIDACIÓN PARA EL COMPLEMENTO JQUERY VALIDATOR
    //===========================================================================

    jQuery.validator.addMethod("nowhitespace", function( value, element ) {
        var result = this.optional(element) || /\s/g.test(value);
        return !result;
    },'<em class="text-danger">El nombre de usuario no podrá contener espacios en blanco</em>');


    $("#loginRegister").validate({
        rules: {
            inputNombre:{
                required: true
            },
            inputApellidos:{
                required: true
            },
            inputEmailRegistro:{
                required: true
            },
            inputUser:{
                nowhitespace: true
            },
            inputPasswordRegistro:{
                required: true,
                minlength: 5,
                maxlength: 13
            },
            inputPasswordDuplicateRegistro:{
                required: true,
                minlength: 5,
                maxlength: 13
            },
            accepted:{
                required: true
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
            inputNombre:{
                required: '<em class="text-danger">Por favor, introduce el nombre</em>'
            },
            inputApellidos:{
                required: '<em class="text-danger">Por favor, introduce los apellidos</em>'
            },
            inputEmailRegistro:{
                required: '<em class="text-danger">Por favor, introduce la dirección de correo</em>'
            },
            inputPasswordRegistro:{
                required: '<em class="text-danger">Por favor, introduce la contraseña</em>'
            },
            inputPasswordDuplicateRegistro:{
                required: '<em class="text-danger">Por favor, introduce de nuevo la contraseña</em>',
                equalTo: '<em class="text-danger">Las contraseñas no coinciden</em>'
            },
            accepted:{
                required: '<em class="text-danger">Por favor, marque esta casilla</em>'
            }
        },
        submitHandler: function(form) {
            $.ajax({
                method: "POST",
                url: "/registro",
                data: $("#loginRegister").serialize(),
                beforeSend: function(data){
                    lanzarToast('warning', '¡ Se está procesando la solicitud !');
                    $('#registerButton').attr('disabled', '');
                },
                success: function(data) {
                    // console.log(data);
                    var x = jQuery.parseJSON(data);
                    // console.log(x);
                    lanzarToast(x.response, x.message);
                    if (x.response == 'success')
                        setTimeout(function () {
                            window.location.replace(window.location.protocol+'//'+window.location.host+'/');
                        }, 2000);
                    $('#registerButton').removeAttr('disabled');
                },
                error: function(data){
                    // console.log(data);
                    lanzarToast('error','¡Se ha producido un error!');
                }
            });
            console.log('validado');
            return false;
        }
    });

});