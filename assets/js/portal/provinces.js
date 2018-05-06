$(document).ready(function () {
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
            // console.log(event, code);
            window.location.replace(window.location.origin+"/provincia/"+code+"");
        }
    });
});