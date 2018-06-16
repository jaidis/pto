//===========================================================================
// FUNCIÓN PARA ESTABLECER EL DATATABLE
//===========================================================================

function generateTable(){
    $('#tablaGastronomias').DataTable({
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
// CARGA LA CONFIGURACIÓN CUANDO EL DOCUMENTO ESTÉ LISTO
//===========================================================================

$(document).ready(function() {

    //===========================================================================
    // ESTABLECE LOS VALORES AL MODAL PARA BORRAR UNA GASTRONOMIA
    //===========================================================================

    $('#deleteGastronomia').on('show.bs.modal', function(e) {
        // console.log(e.relatedTarget.dataset);
        $('#infoGastronomia').html(e.relatedTarget.dataset.name);
        $('#idGastronomy').val(e.relatedTarget.dataset.id);
    });

    //===========================================================================
    // FORMULARIO PARA BORRAR UNA GASTRONOMIA
    //===========================================================================

    $("#formDeleteGastronomia").submit(function(e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "/pto-admin/gastronomias",
            data: $("#formDeleteGastronomia").serialize(),
            success: function(data) {
                var x = jQuery.parseJSON(data);
                // console.log(x);
                $("#gastronomia_section").load("/pto-admin/gastronomias #gastronomia_section > *", function() {
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
