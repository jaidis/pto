$(document).ready(function() {

    //===========================================================================
    // ACTIVAR TOOLTIP DE BOOTSTRAP 4
    //===========================================================================

    $('[data-toggle="tooltip"]').tooltip();

    //===========================================================================
    // FORMULARIO PARA VALIDAR UNA PROVINCIA
    //===========================================================================

    $("#formProvincia").validate({
        rules: {
            inputNombre: {
                required: true
            },
            inputMapCode: {
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
                required: '<em class="text-danger">Escribe el nombre de la provincia</em>'
            },
            inputMapCode: {
                required: '<em class="text-danger">Escribe el código de la provincia</em>'
            },
            inputDescription:{
                required: '<em class="text-danger">Escribe una descripción para la provincia</em>'
            }
        },
        submitHandler: function(form) {
            $.ajax({
                method: "POST",
                url: "/pto-admin/provincias/edit",
                data: $("#formProvincia").serialize(),
                beforeSend: function() {
                    $("#provinciaButton").attr("disabled", true);
                },
                success: function(data) {
                    var x = jQuery.parseJSON(data);
                    // console.log(x);
                    lanzarToast(x.response, x.message);
                    $("#provinciaButton").removeAttr('disabled');
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
            url: "/pto-admin/provincias/upload_file",
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


