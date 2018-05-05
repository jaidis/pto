$(document).ready(function () {
    // hide our element on page load
    // $('.h1-jumbo').css('opacity', 0);

    $('.h1-jumbo').waypoint(function() {
        $('.h1-jumbo').addClass('fadeInDown');
    }, { offset: '35%' });

    // hide our element on page load
    $('#p-jumbo').css('opacity', 0);

    $('#p-jumbo').waypoint(function() {
        $('#p-jumbo').addClass('fadeInUp');
    }, { offset: '65%' });

    $('#mapa').vectorMap({
        map: 'es_merc',
        backgroundColor: '#efffff',
        regionsSelectable: true,
        regionStyle: {
            initial: {
                fill: '#18bc9c'
            },
            selected: {
                fill: '#ffec00'
            }
        },
        onRegionClick: function (event, code) {
            console.log(event, code);
            // window.location.replace("http://your url address/"+code+"");
        }
    });
});