$(document).ready(function() {

    //===========================================================================
    // ACTIVAR TOOLTIP DE BOOTSTRAP 4
    //===========================================================================

    $('[data-toggle="tooltip"]').tooltip();

    //===========================================================================
    // FORMULARIO PARA VALIDAR UNA NOTICIA
    //===========================================================================

    $("#formNoticia").validate({
        rules: {
            inputTitle: {
                required: true
            },
            inputProvincia: {
                required: true
            },
            inputSubtitle: {
                required: true
            },
            inputDescription:{
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
            inputTitle: {
                required: '<em class="text-danger">Escribe el título de la noticia</em>'
            },
            inputProvincia: {
                required: '<em class="text-danger">Selecciona una provincia</em>'
            },
            inputSubtitle:{
                required: '<em class="text-danger">Escribe el subitulo de la noticia</em>'
            },
            inputDescription:{
                required: '<em class="text-danger">Escribe la descripción de la noticia</em>'
            }
        },
        submitHandler: function(form) {
            $.ajax({
                method: "POST",
                url: "/pto-admin/noticias/new",
                data: $("#formNoticia").serialize(),
                beforeSend: function() {
                    $("#noticiaButton").attr("disabled", true);
                },
                success: function(data) {
                    var x = jQuery.parseJSON(data);
                    // console.log(x);
                    lanzarToast(x.response, x.message);
                    $("#noticiaButton").removeAttr('disabled');
                    if (x.response == 'success')
                        setTimeout(function () {
                            window.location.replace(window.location.protocol+'//'+window.location.host+'/pto-admin/noticias');
                        },2000)
                }
            });
            return false;
        }
    });

    //===========================================================================
    // FORMULARIO PARA SUBIR UNA IMAGEN DE UNA NOTICIA
    //===========================================================================

    $("#formUpload").submit(function(e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "/pto-admin/noticias/upload_file",
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


