/*
$(function() {
    $('#slideshowA').slick( {
        "autoplay": true, 
		"autoplaySpeed": 3000, 
		"centerMode": true, 
		"infinite": true, 
		"responsive": [ {
            breakpoint: 1024, settings: {
                slidesToShow: 3, slidesToScroll: 3, infinite: true, dots: true
            }},{
            breakpoint: 600, settings: {
                slidesToShow: 2, slidesToScroll: 2
            }},{
            breakpoint: 480, settings: {
                slidesToShow: 1, slidesToScroll: 1
            }}],
        "slidesToScroll": 4,
        "slidesToShow": 4,
        "speed": 300,
        "variableWidth": true,
        "zIndex": 2,
    });
});

$(function() {
    $('#slideshowB').slick( {
        "autoplay": true, 
		"autoplaySpeed": 3000, 
		"centerMode": true, 
		"infinite": true, 
		"responsive": [{
            breakpoint: 1024, settings: {
                slidesToShow: 3, slidesToScroll: 3, infinite: true, dots: true
            }},{
            breakpoint: 600, settings: {
                slidesToShow: 2, slidesToScroll: 2
            }},{
            breakpoint: 480, settings: {
                slidesToShow: 1, slidesToScroll: 1
            }}],
        "slidesToScroll": 4,
        "slidesToShow": 4,
        "speed": 300,
        "variableWidth": true,
        "zIndex": 2,
    });
});

$(function() {
    $('#slideshowC').slick( {
        "autoplay": true, 
		"autoplaySpeed": 3000, 
		"centerMode": true, 
		"infinite": true, 
		"responsive": [{
            breakpoint: 1024, settings: {
                slidesToShow: 3, slidesToScroll: 3, infinite: true, dots: true
            }},{
            breakpoint: 600, settings: {
                slidesToShow: 2, slidesToScroll: 2
            }},{
            breakpoint: 480, settings: {
                slidesToShow: 1, slidesToScroll: 1
            }}],
        "slidesToScroll": 4,
        "slidesToShow": 4,
        "speed": 300,
        "variableWidth": true,
        "zIndex": 2,
    });
});

$(function() {
    $('#slideshowD').slick( {
        "autoplay": true, 
		"autoplaySpeed": 3000, 
		"centerMode": true, 
		"infinite": true, 
		"responsive": [{
            breakpoint: 1024, settings: {
                slidesToShow: 3, slidesToScroll: 3, infinite: true, dots: true
            }},{
            breakpoint: 600, settings: {
                slidesToShow: 2, slidesToScroll: 2
            }},{
            breakpoint: 480, settings: {
                slidesToShow: 1, slidesToScroll: 1
            }}],
        "slidesToScroll": 4,
        "slidesToShow": 4,
        "speed": 300,
        "variableWidth": true,
        "zIndex": 2,
    });
});
*/

$(".my-rating").starRating( {
    starSize: 15, 
	callback: function(currentRating, $el) {
        // make a server call here
    }
});


/* header banner */
$('#owl-banner').owlCarousel({
    //loop:true,
    loop:true,

    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
	items: 1,
	
    margin:10,
    //nav:false,
	//dots: false,
    responsive:{
        0:{
            items:1,
			nav:false,
			dots: false
        },
        600:{
            items:1,
			nav:false,
			dots: false
        },
        1000:{
            items:1,
			nav:false,
			dots: false
        }
    }
})

/* header sub banner */
$('#owl-banner-sub').owlCarousel({
    /*loop:true,*/
    touchDrag               : false,
        mouseDrag               : false,
	items: 1,
    margin:10,
    //nav:false,
	//dots: false,
    /*responsive:{
        0:{
            items:1,
			nav:false,
			dots: false
        },
        600:{
            items:1,
			nav:false,
			dots: false
        },
        1000:{
            items:1,
			nav:false,
			dots: false
        }
    }*/
})
/* owl-seller */
$('#owl-seller').owlCarousel({
    loop:true,
	items: 4,
    margin:10,
	navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    nav:true,
	dots: false,
    responsive:{
        0:{
            items:1,
			nav:true,
			dots: false
        },
        600:{
            items:3,
			nav:true,
			dots: false
        },
        1000:{
            items:3,
			nav:true,
			dots: false
        },
		1200:{
			items:4,
			nav:true,
			dots: false
		}
    }
})

/* owl-newbook */
$('#owl-newbook').owlCarousel({
    loop:true,
	items: 4,
    margin:20,
	navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    nav:true,
	dots: false,
    responsive:{
        0:{
            items:1,
			nav:true,
			dots: false
        },
        600:{
            items:3,
			nav:true,
			dots: false
        },
        1000:{
            items:3,
			nav:true,
			dots: false
        },
		1200:{
			items:4,
			nav:true,
			dots: false
		}
    }
})


/*owl-coming*/
$('#owl-coming').owlCarousel({
    loop:true,
	items: 1,
    margin:10,
	navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    nav:true,
	dots: false,
    responsive:{
        0:{
            items:1,
			nav:true,
			dots: false
        },
        600:{
            items:1,
			nav:true,
			dots: false
        },
        1000:{
            items:1,
			nav:true,
			dots: false
        }
    }
})


/* owl-offcial */
$('#owl-offcial').owlCarousel({
    loop:true,
	items: 5,
    margin:10,
	navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    nav:true,
	dots: false,
    responsive:{
        0:{
            items:1,
			nav:true,
			dots: false
        },
        600:{
            items:3,
			nav:true,
			dots: false
        },
        1000:{
            items:4,
			nav:true,
			dots: false
        },
		1200:{
			items:5,
			nav:true,
			dots: false
		}
    }
})

/* owl-catagory */
$('#owl-catagory').owlCarousel({
    loop:true,
	items: 5,
    margin:10,
	navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    nav:true,
	dots: false,
    responsive:{
        0:{
            items:1,
			nav:true,
			dots: false
        },
        600:{
            items:3,
			nav:true,
			dots: false
        },
        1000:{
            items:4,
			nav:true,
			dots: false
        },
		1200:{
			items:5,
			nav:true,
			dots: false
		}
    }
})