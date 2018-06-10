$(document).ready(function () {

    $("#commentForm").validate({
        ignore: [],
        rules: {
            activeId:{
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
            activeId:{
                required: function(){
                    lanzarToast('error', 'Necesitas estar logueado para poder comentar en la noticia');
                }
            }
        },
        submitHandler: function(form) {
            $.ajax({
                method: "POST",
                url: "/noticia/"+$("#activeId").val()+'/noticia',
                data: $("#commentForm").serialize(),
                beforeSend: function(data){
                    lanzarToast('info', '¡ Se está enviando el comentario !');
                    $('#commentButton').attr('disabled', '');
                },
                success: function(data) {
                    // console.log(data);
                    var x = jQuery.parseJSON(data);
                    // console.log(x);
                    lanzarToast(x.response, x.message);
                    $('#commentButton').removeAttr('disabled');
                },
                error: function(data){
                    // console.log(data);
                    lanzarToast('error','¡Se ha producido un error!');
                    $('#commentButton').removeAttr('disabled');
                }
            });
            return false;
        }
    });

});