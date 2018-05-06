$(document).ready(function () {

    $('.h1-jumbo').waypoint(function() {
        $('.h1-jumbo').addClass('fadeInDown');
    }, { offset: '35%' });

    // hide our element on page load
    $('#p-jumbo').css('opacity', 0);

    $('#p-jumbo').waypoint(function() {
        $('#p-jumbo').addClass('fadeInUp');
    }, { offset: '65%' });
});