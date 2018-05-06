$(document).ready(function () {
    $('.bg-jumbotron-province').css('background', 'url(/assets/img/province/' + province.image_url + ')');
    // $('.bg-jumbotron-province').css('background-attachment', 'fixed');
    $('.bg-jumbotron-province').css('background-position', 'center');
    $('.bg-jumbotron-province').css('background-size', 'cover');
    $('.bg-jumbotron-province').css('border-radius', '0');

    $("#carouselMonumentos").on("slide.bs.carousel", function(e) {
        var event = $(e.relatedTarget);
        var idx = event.index();
        var itemsPerSlide = 3;
        var totalItems = $(this).find(".carousel-item").length;

        if (idx >= totalItems - (itemsPerSlide - 1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i = 0; i < it; i++) {
                // append slides to end
                if (e.direction == "left") {
                    $(this).find(".carousel-item")
                        .eq(i)
                        .appendTo(".carousel-inner");
                } else {
                    $(this).find(".carousel-item")
                        .eq(0)
                        .appendTo($(this).find(".carousel-inner"));
                }
            }
        }
    });

    $("#carouselGastronomia").on("slide.bs.carousel", function(e) {
        var event = $(e.relatedTarget);
        var idx = event.index();
        var itemsPerSlide = 3;
        var totalItems = $(this).find(".carousel-item").length;

        if (idx >= totalItems - (itemsPerSlide - 1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i = 0; i < it; i++) {
                // append slides to end
                if (e.direction == "left") {
                    $(this).find(".carousel-item")
                        .eq(i)
                        .appendTo(".carousel-inner");
                } else {
                    $(this).find(".carousel-item")
                        .eq(0)
                        .appendTo($(this).find(".carousel-inner"));
                }
            }
        }
    });


});