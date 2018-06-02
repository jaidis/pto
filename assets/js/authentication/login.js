function GetURLParameter(sParam){
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
            return sParameterName[1];
    }
}

$(document).ready(function () {


    $("#loginForm").validate({
        validateHiddenInputs: true,
        rules: {
            inputEmail:{
                required: true
            },
            inputPassword:{
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
            inputEmail:{
                required: '<em class="text-danger">Por favor, introduce la dirección de correo</em>'
            },
            inputPassword:{
                required: '<em class="text-danger">Por favor, introduce la contraseña</em>'
            }
        },
        submitHandler: function(form) {
            $.ajax({
                method: "POST",
                url: "/login",
                data: $("#loginForm").serialize(),
                success: function(data) {
                    // console.log(data);
                    var x = jQuery.parseJSON(data);
                    // console.log(x);
                    lanzarToast(x.response, x.message);
                    if (x.response == 'success')
                        if (GetURLParameter('url')!= undefined)
                        {
                            setTimeout(function () {
                                window.location.replace(window.location.protocol+'//'+window.location.host+'/'+GetURLParameter('url'));
                            }, 1000);
                        }
                        else{
                            setTimeout(function () {
                                window.location.replace(window.location.protocol+'//'+window.location.host);
                            }, 1000);
                        }
                },
                error: function(data){
                    // console.log(data);
                    lanzarToast('error','¡Se ha producido un error!');
                }
            });
            return false;
        }
    });

});