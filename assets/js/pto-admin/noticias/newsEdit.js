//===========================================================================
// FUNCIÓN PARA ESTABLECER EL DATATABLE
//===========================================================================

function generateTable(){
    $('#tablaComentarios').DataTable({
        "language": {
            "sProcessing":    "Procesando...",
            "sLengthMenu":    "Mostrar _MENU_ registros",
            "sZeroRecords":   "No se encontraron resultados",
            "sEmptyTable":    "Ningún dato disponible en esta tabla",
            "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":   "",
            "sSearch":        "Buscar:",
            "sUrl":           "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":    "Último",
                "sNext":    "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
}

//===========================================================================
// REALIZAR ACCIONES CUANDO EL DOCUMENTO SE CARGUE
//===========================================================================

$(document).ready(function() {

    //===========================================================================
    // ACTIVAR TOOLTIP DE BOOTSTRAP 4
    //===========================================================================

    $('[data-toggle="tooltip"]').tooltip();

    //===========================================================================
    // RECUPERAR LOS ELEMENTOS ORIGINALES
    //===========================================================================

    $('#inputProvincia').val(configuracion[0].id_province);
    $('#inputProvincia').trigger('change');

    //===========================================================================
    // FORMULARIO PARA VALIDAR UNA GASTRONOMIA
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
                url: "/pto-admin/noticias/edit",
                data: $("#formNoticia").serialize(),
                beforeSend: function() {
                    $("#noticiaButton").attr("disabled", true);
                },
                success: function(data) {
                    var x = jQuery.parseJSON(data);
                    // console.log(x);
                    lanzarToast(x.response, x.message);
                    $("#noticiaButton").removeAttr('disabled');
                }
            });
            return false;
        }
    });

    //===========================================================================
    // FORMULARIO PARA SUBIR UNA IMAGEN DE UNA GASTRONOMIA
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

    //===========================================================================
    // ESTABLECE LOS VALORES AL MODAL PARA BORRAR UN COMENTARIO
    //===========================================================================

    $('#deleteComentario').on('show.bs.modal', function(e) {
        // console.log(e.relatedTarget.dataset);
        $('#infoComentario').html(e.relatedTarget.dataset.title);
        $('#idComment').val(e.relatedTarget.dataset.id);
    });

    //===========================================================================
    // FORMULARIO PARA BORRAR UN COMENTARIO
    //===========================================================================

    $("#formDeleteComentario").submit(function(e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "/pto-admin/noticias/delete_comment",
            data: $("#formDeleteComentario").serialize(),
            success: function(data) {
                var x = jQuery.parseJSON(data);
                // console.log(x);
                $("#comentario_section").load("/pto-admin/noticias/edit/"+configuracion[0].id+" #comentario_section > *", function() {
                    $('#closeModal').click();
                    lanzarToast(x.response, x.message);
                    generateTable();
                });
            },
            error: function(data) {
                lanzarToast('error', 'Se ha producido un error');
                console.log(data);
            }
        });
        return false;
    });

    //===========================================================================
    // LLAMADA A LA FUNCIÓN PARA GENERAR EL DATATABLE
    //===========================================================================
    generateTable();


});