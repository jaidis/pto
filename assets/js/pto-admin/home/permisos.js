//===========================================================================
// FORMULARIO PARA INSERTAR UN NUEVO USUARIO
//===========================================================================

function function_form_user(){
  $("#formUser").validate({
    validateHiddenInputs: true,
    rules: {
      inputEmail:{
        required: true,
        email: true
      },
      inputUsuario:{
        nowhitespace: true
      },
      inputFirstName:{
        required: true
      },
      inputLastName:{
        required: true
      },
      inputPassword:{
        required: true
      },
      inputPasswordDuplicate:{
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
        required: '<em class="text-danger">Por favor, introduce la dirección de correo</em>',
        email: '<em class="text-danger">Por favor, introduce una dirección de correo válida</em>'
      },
      inputFirstName:{
        required: '<em class="text-danger">Por favor, introduce el nombre completo del usuario</em>'
      },
      inputLastName:{
        required: '<em class="text-danger">Por favor, introduce los apellidos del usuario</em>'
      },
      inputPassword:{
        required: '<em class="text-danger">Por favor, introduce la contraseña</em>'
      },
      inputPasswordDuplicate:{
        required: '<em class="text-danger">Por favor, introduce la contraseña</em>',
        equalTo: '<em class="text-danger">Las contraseñas no coinciden</em>'
      }
    },
    submitHandler: function(form) {
      // console.log('validado');
      $.ajax({
        method: "POST",
        url: "/pto-admin/permisos",
        data: $("#formUser").serialize(),
        beforeSend: function(data){
          lanzarToast('warning', '¡ Se está procesando la solicitud !');
          $('#userButton').attr('disabled', '');
        },
        success: function(data) {
          // console.log(data);
          let x = jQuery.parseJSON(data);
          // console.log(x);
          lanzarToast(x.response, x.message);
          if (x.response == 'success')
          {
            $("#formUser")[0].reset();
            $("#permisos").load("/pto-admin/permisos #permisos > *");
          }
          $('#userButton').removeAttr('disabled');
        },
        error: function(data){
          // console.log(data);
          lanzarToast('error','¡Se ha producido un error!');
          $('#userButton').removeAttr('disabled');
        }
      });
      return false;
    }
  });
}

//===========================================================================
// FORMULARIO PARA INSERTAR UN GRUPO NUEVO
//===========================================================================

function function_form_group(){
  $("#formGroup").validate({
    validateHiddenInputs: true,
    rules: {
      inputGroup:{
        required: true,
      },
      inputGroupDescription:{
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
      inputGroup:{
        required: '<em class="text-danger">Por favor, introduce el nombre del grupo</em>'
      },
      inputGroupDescription:{
        required: '<em class="text-danger">Por favor, introduce la descripción del grupo</em>'
      }
    },
    submitHandler: function(form) {
      // console.log('validado');
      $.ajax({
        method: "POST",
        url: "/pto-admin/permisos",
        data: $("#formGroup").serialize(),
        beforeSend: function(data){
          lanzarToast('warning', '¡ Se está procesando la solicitud !');
          $('#groupButton').attr('disabled', '');
        },
        success: function(data) {
          // console.log(data);
          let x = jQuery.parseJSON(data);
          // // console.log(x);
          lanzarToast(x.response, x.message);
          if (x.response == 'success')
          {
            $("#formGroup")[0].reset();
            $("#permisos").load("/pto-admin/permisos #permisos > *");
          }
          $('#groupButton').removeAttr('disabled');
        },
        error: function(data){
          // console.log(data);
          lanzarToast('error','¡Se ha producido un error!');
          $('#groupButton').removeAttr('disabled');
        }
      });
      return false;
    }
  });
}

//===========================================================================
// CARGA LA CONFIGURACIÓN CUANDO EL DOCUMENTO ESTÉ LISTO
//===========================================================================

$(document).ready(function() {

  //===========================================================================
  // INICIAR LOS TOOLTIPS DE BOOTSTRAP 4
  //===========================================================================

  $('[data-toggle="tooltip"]').tooltip();

  //===========================================================================
  // REGLA DE VALIDACIÓN PARA EL COMPLEMENTO JQUERY VALIDATOR
  //===========================================================================

  jQuery.validator.addMethod("nowhitespace", function( value, element ) {
    var result = this.optional(element) || /\s/g.test(value);
    return !result;
  },'<em class="text-danger">El nombre de usuario no podrá contener espacios en blanco</em>');

  //===========================================================================
  // FORMULARIO PARA INSERTAR UN NUEVO USUARIO
  //===========================================================================

  function_form_user();

  //===========================================================================
  // FORMULARIO PARA INSERTAR UN GRUPO NUEVO
  //===========================================================================

  function_form_group();

  //===========================================================================
  // ESTABLECER PARAMETROS AL MODAL DE BORRAR USUARIO
  //===========================================================================

  $('#deleteUser').on('show.bs.modal', function(e) {
    // console.log(e.relatedTarget.dataset);
    $('#infoUsuario').html(e.relatedTarget.dataset.user);
    $('#idUser').val(e.relatedTarget.dataset.id);
  });

  //===========================================================================
  // FORMULARIO PARA BORRAR UN USUARIO
  //===========================================================================

  $("#formDeleteUser").submit(function(event) {
    event.preventDefault();
    $.ajax({
      method: "POST",
      url: "/pto-admin/permisos",
      data: $("#formDeleteUser").serialize(),
      success: function(data) {
        let x = jQuery.parseJSON(data);
        // console.log(x);
        lanzarToast(x.response, x.message);
        $('#closeModal').click();
        $("#permisos").load("/pto-admin/permisos #permisos > *");
      }
    });
    return false;
  });

  //===========================================================================
  // ESTABLECER PARAMETROS AL MODAL DE BORRAR GRUPO
  //===========================================================================

  $('#deleteGroup').on('show.bs.modal', function(e) {
    // console.log(e.relatedTarget.dataset);
    $('#infoGrupo').html(e.relatedTarget.dataset.group);
    $('#idGroup').val(e.relatedTarget.dataset.id);
  });

  //===========================================================================
  // FORMULARIO PARA BORRAR UN GRUPO
  //===========================================================================

  $("#formDeleteGroup").submit(function(event) {
    event.preventDefault();
    $.ajax({
      method: "POST",
      url: "/pto-admin/permisos",
      data: $("#formDeleteGroup").serialize(),
      success: function(data) {
        let x = jQuery.parseJSON(data);
        // console.log(x);
        lanzarToast(x.response, x.message);
        $('#closeModalGroup').click();
        $("#permisos").load("/pto-admin/permisos #permisos > *");
      }
    });
    return false;
  });

  // $(document).on('click', '#recarga', function(event){
  //   $("#permisos").load("/pto-admin/permisos #permisos > *");
  //   return false;
  // });

  //===========================================================================
  // CAMBIAR VALOR PARA REVOCAR ACCESO USUARIOS
  // CAMBIAR PERMISOS DE LOS GRUPOS
  //===========================================================================

  $(document).on('change', 'input[type=checkbox]', function(e){

    event.preventDefault();

    var casilla_marcada = this.checked;
    var padre = $(this).closest( "tr" ).attr( "id" );
    var nombre = this.name;
    var tabla = this.dataset.table;

    // console.log(this.checked);
    // console.log($(this).closest( "tr" ).attr( "id" ));
    // console.log(this.name);
    // console.log(this.dataset.table);

    // Si el checkbox procede de la tabla permisos se enví­a con un post
    if (this.dataset.table == "tabla_usuarios"){
      $.ajax({
        method: "POST",
        url: "/pto-admin/permisos",
        data: {casilla_marcada: casilla_marcada, id_usuario: padre},
        success: function(data) {
          // console.log(data);
          let x = jQuery.parseJSON(data);
          // console.log(x);
          lanzarToast(x.response, x.message);
        },
        error: function(data){
          // console.log(data);
          lanzarToast('error','¡Se ha producido un error!');
        }
      });
    }

    // Si el checkbox procede de la tabla permisos se enví­a con un post
    if (this.dataset.table == "tabla_permisos"){
      $.ajax({
        method: "POST",
        url: "/pto-admin/permisos",
        data: {casilla_marcada: casilla_marcada, grupo: padre, permiso : nombre},
        success: function(data) {
          // console.log(data);
          let x = jQuery.parseJSON(data);
          // console.log(x);
          lanzarToast(x.response, x.message);
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

//===========================================================================
// SE RECARGA LA VALIDACIÓN DE LOS FORMULARIOS CADA VEZ QUE SE COMPLETE UNA
// PETICIÓN AJAX (DEBIDO A QUE LOS EVENTOS SE PIERDEN CON JQUERY LOAD)
//===========================================================================

$(document).ajaxComplete(function () {
  function_form_user();
  function_form_group();
  $('[data-toggle="tooltip"]').tooltip();
});
