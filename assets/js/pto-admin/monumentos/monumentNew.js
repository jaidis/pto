$(document).ready(function() {

    //===========================================================================
    // ACTIVAR TOOLTIP DE BOOTSTRAP 4
    //===========================================================================

    $('[data-toggle="tooltip"]').tooltip();

    //===========================================================================
    // FORMULARIO PARA VALIDAR UN MONUMENTO
    //===========================================================================

    $("#formMonumento").validate({
        rules: {
            inputNombre: {
                required: true
            },
            inputProvincia: {
                required: true
            },
            inputDescription: {
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
            inputNombre: {
                required: '<em class="text-danger">Escribe el nombre del monumento</em>'
            },
            inputProvincia: {
                required: '<em class="text-danger">Selecciona una provincia</em>'
            },
            inputDescription:{
                required: '<em class="text-danger">Escribe una descripción para el monumento</em>'
            }
        },
        submitHandler: function(form) {
            $.ajax({
                method: "POST",
                url: "/pto-admin/monumentos/new",
                data: $("#formMonumento").serialize(),
                beforeSend: function() {
                    $("#monumentoButton").attr("disabled", true);
                },
                success: function(data) {
                    var x = jQuery.parseJSON(data);
                    // console.log(x);
                    lanzarToast(x.response, x.message);
                    $("#monumentoButton").removeAttr('disabled');
                    if (x.response == 'success')
                        setTimeout(function () {
                            window.location.replace(window.location.protocol+'//'+window.location.host+'/pto-admin/monumentos');
                        },2000)
                }
            });
            return false;
        }
    });

    //===========================================================================
    // FORMULARIO PARA SUBIR UNA IMAGEN DE UN MONUMENTO
    //===========================================================================

    $("#formUpload").submit(function(e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "/pto-admin/monumentos/upload_file",
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
                $('#valueImage').attr('value', x.data.file_name);
                $('#imgPreview').attr('src', '/uploads/'+x.data.file_name);
            }
        });
        return false;
    });
});


