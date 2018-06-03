function lanzarToast (type, message){
    toastr[type](message).options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "300",
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "swing",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
}

$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip();

    $('.h1-jumbo').waypoint(function() {
        $('.h1-jumbo').addClass('fadeInDown');
    }, { offset: '35%' });

    // hide our element on page load
    $('#p-jumbo').css('opacity', 0);

    $('#p-jumbo').waypoint(function() {
        $('#p-jumbo').addClass('fadeInUp');
    }, { offset: '65%' });
});