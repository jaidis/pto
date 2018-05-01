$(document).ready(function () {
    // hide our element on page load
    $('.h1-jumbo').css('opacity', 0);

    $('.h1-jumbo').waypoint(function() {
        $('.h1-jumbo').addClass('fadeInDown');
    }, { offset: '50%' });

    // hide our element on page load
    $('#p-jumbo').css('opacity', 0);

    $('#p-jumbo').waypoint(function() {
        $('#p-jumbo').addClass('fadeInUp');
    }, { offset: '65%' });
})