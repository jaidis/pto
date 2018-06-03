$(document).ready(function () {

    $("#formContact").validate({
        rules: {
            contactName:{
                required: true
            },
            contactMail:{
                required: true
            },
            contactPhone:{
                required: true,
                digits: true
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
            contactName:{
                required: '<em class="text-danger">Por favor, introduce nombre y apellidos</em>'
            },
            contactMail:{
                required: '<em class="text-danger">Por favor, introduce la dirección de correo</em>'
            },
            contactPhone:{
                required: '<em class="text-danger">Por favor, introduce tu númuero de telefono</em>'
            }
        },
        submitHandler: function(form) {
            $.ajax({
                method: "POST",
                url: "/contacto",
                data: $("#formContact").serialize(),
                beforeSend: function(data){
                    lanzarToast('warning', '¡ Se está procesando la solicitud !');
                    $('#registerButton').attr('disabled', '');
                },
                success: function(data) {
                    // console.log(data);
                    var x = jQuery.parseJSON(data);
                    // console.log(x);
                    lanzarToast(x.response, x.message);
                    $('#contactMessage').removeAttr('disabled');
                },
                error: function(data){
                    // console.log(data);
                    lanzarToast('error','¡Se ha producido un error!');
                    $('#contactMessage').removeAttr('disabled');
                }
            });
            return false;
        }
    });

});