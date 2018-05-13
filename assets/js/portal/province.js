$(document).ready(function () {
    $('.bg-jumbotron-province').css('background', 'url(/assets/img/province/' + province.image_url + ')');
    // $('.bg-jumbotron-province').css('background-attachment', 'fixed');
    $('.bg-jumbotron-province').css('background-position', 'center');
    $('.bg-jumbotron-province').css('background-size', 'cover');
    $('.bg-jumbotron-province').css('border-radius', '0');

    $("#carouselMonumentos").find(".carousel-item").first().addClass('active');

    $("#carouselMonumentos").on("slide.bs.carousel", function(e) {
        var event = $(e.relatedTarget);
        console.log('monumentos');
        console.log(event);
        var idx = event.index();
        var itemsPerSlide = 3;
        var totalItems = $("#carouselMonumentos").find(".carousel-item").length;

        if (idx >= totalItems - (itemsPerSlide - 1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i = 0; i < it; i++) {
                // append slides to end
                if ($("#carouselMonumentos").find(e).direction == "left") {
                    $("#carouselMonumentos").find(".carousel-item")
                        .eq(i)
                        .appendTo(".carousel-inner");
                } else {
                    $("#carouselMonumentos").find(".carousel-item")
                        .eq(0)
                        .appendTo($(this).find(".carousel-inner"));
                }
            }
        }
    });

    $("#carouselGastronomia").find(".carousel-item").first().addClass('active');

    $("#carouselGastronomia").on("slide.bs.carousel", function(e) {
        var event = $(e.relatedTarget);
        var idx = event.index();
        var itemsPerSlide = 3;
        var totalItems = $("#carouselGastronomia").find(".carousel-item").length;

        if (idx >= totalItems - (itemsPerSlide - 1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i = 0; i < it; i++) {
                // append slides to end
                if ($("#carouselGastronomia").find(e).direction == "left") {
                    $("#carouselGastronomia").find(".carousel-item")
                        .eq(i)
                        .appendTo(".carousel-inner");
                } else {
                    $("#carouselGastronomia").find(".carousel-item")
                        .eq(0)
                        .appendTo($(this).find(".carousel-inner"));
                }
            }
        }
    });

    // REMOVE AND ADD CLICK EVENT
    $('.doAddItem').on('click', function () {
        $(".gridder").data('gridderExpander').gridderAddItem('TEST');
    });

    // Call Gridder
    $(".gridder").gridderExpander({
        scroll: true,
        scrollOffset: 60,
        scrollTo: "panel", // "panel" or "listitem"
        animationSpeed: 400,
        animationEasing: "easeInOutExpo",
        showNav: true,
        nextText: "<i class=\"fa fa-arrow-right\"></i>",
        prevText: "<i class=\"fa fa-arrow-left\"></i>",
        closeText: "<i class=\"fa fa-times\"></i>",
        onStart: function () {
            console.log("Gridder Inititialized");
        },
        onExpanded: function (object) {
            console.log("Gridder Expanded");
        },
        onChanged: function (object) {
            console.log("Gridder Changed");
        },
        onClosed: function () {
            console.log("Gridder Closed");
        }
    });

});