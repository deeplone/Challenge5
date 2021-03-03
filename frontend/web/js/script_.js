
var inactiveEvent = false;

$(document).ready(function () {

    $.getJSON("_data/data_movie.json", function (data) {
        //1................. Declare
        var banner_data = '';

        //2................. Browser array
        $.each(data, function (key, valueA) {
            banner_data += '<div class="itm">';
            banner_data += '<div class="overlay">';
            banner_data += '<div class="ctn">';
            banner_data += '<div class="real-item">';
            banner_data += '<h3 class="ttl">' + valueA.Name + '</h3>';
            banner_data += '<p><a href="' + valueA.Url + '" class="but but-watch hvr-icon-pop"><i class="ico mdi mdi-play hvr-icon"></i>Xem phim</a><a href="' + valueA.Url + '" class="but but-watch  hvr-icon-pop"><i class="ico mdi mdi-plus hvr-icon"></i>Phim của tôi</a></p>';
            banner_data += '<p class="hvr-icon-pop"><i class="ico mdi mdi-star hvr-icon"></i><i class="ico mdi mdi-star hvr-icon"></i><i class="ico mdi mdi-star hvr-icon"></i><i class="ico mdi mdi-star hvr-icon"></i><i class="ico mdi mdi-star-outline hvr-icon"></i></p>';
            banner_data += '<p class="txt-1"><span class="txt-line">' + valueA.Restrict + '</span><span class="txt-line">' + valueA.Time + '</span><span class="txt-line"><a href="#">' + valueA.Category + '</a> <a href="#"> Hài hước </a></span><span class="txt-line">' + valueA.Year + '</span></p>';
            banner_data += '<p class="txt-2">' + valueA.Description + '</p>';
            banner_data += '</div>';

            banner_data += '<div class="ftn-control">';
            banner_data += '<span class="ico"><i class="mdi mdi-volume-high"></i></span>';
            banner_data += '<span class="ico"><i class="mdi mdi-thumb-up-outline"></i></span>';
            banner_data += '<span class="ico"><i class="mdi mdi-plus"></i></span>';
            banner_data += '</div>';
            banner_data += '<!--<span class="mdi mdi-close"></span>-->';

            banner_data += '</div>';
            banner_data += '</div>';
            banner_data += '<div class="overlay-banner"></div>';
            banner_data += '<img src="' + valueA.Picture + '" alt="" class="img-banner">';
            banner_data += '</div>';
        });

        //3................. Add into structure item
        $('#lstBanner').append(banner_data);

        //4................. Call owlcarousel
        runCarousel('#lstBanner', 1);

        runCarousel('.slide-2x3', 2);//2:3 banner
        runCarousel('.slide-16x9', 3);//16:9 banner
        
    });

    //4................. Toggle Collapse
    toggleCollapse();

    //5................. Slide hover
    
    slideHover(".mdl-america",".slide-16x9",".slide-16x9 .owl-stage",".slide-16x9 .owl-item", false);//false is 16:9 banner
    slideHover(".mdl-romance",".slide-2x3",".slide-2x3 .owl-stage",".slide-2x3 .owl-item", true); //true is 2:3 banner
    
    //6................. Toggle control
    toggleControl();

    //7................. Change background color
    //window.onscroll = function(){ changeBgEffect();  };

    //8................. Close extent player
    closeExtent();    

    //9................. Suggestion search
    suggestionSearch();
});


$( window ).resize(function() {
    slideHover(".mdl-america",".slide-16x9",".slide-16x9 .owl-stage",".slide-16x9 .owl-item", false);//false is 16:9 banner
    slideHover(".mdl-romance",".slide-2x3",".slide-2x3 .owl-stage",".slide-2x3 .owl-item", true); //true is 2:3 banner
});

//---------- 01. Run carousel ----------
function runCarousel(data_target, flag) {
    if (flag == 1) {
        $(data_target).owlCarousel({
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            items: 1,
            margin: 0,
            stagePadding: 0,
            smartSpeed: 450,
            autoplayTimeout: 5000,
            autoplay: false,
            loop: true
        });
    } else if (flag == 2) {

        $(data_target).owlCarousel({
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            margin: 10,
            stagePadding: 10,
            smartSpeed: 450,
            autoplayTimeout: 10000,
            autoplay: false,
            loop: false,
            navText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
            dots: false,
            responsiveClass: true,
            nav: true,
            slideBy: 'page',
            mouseDrag: false,
            touchDrag: false,
            pullDrag: false,
            freeDrag: false,
            checkVisible: false,
            callbacks: true,
            responsive: {
                0: {
                    items: 2,
                },
                576: {
                    items: 4
                },
                768: {
                    items: 4,
                },
                992: {
                    items: 4,
                },
                1200: {
                    items: 6,
                }
            },
            onInitialized: function (event) {
                $(".owl-prev", data_target).css("height", $(".stage-1",data_target).height());
                $(".owl-next", data_target).css("height", $(".stage-1",data_target).height());
                // $(".owl-prev", data_target).css({"height":0,"overflow":"hidden"});
            },
            onChanged: function (event) {
                // var items = event.item.count; // Number of items
                // var itemx = event.item.index; // Position of the current item
                // var itemy = items - (1 + 6); // Show 6 item

                // if (itemx > 1) {
                //     $(".owl-prev", data_target).css("height", $(".stage-1",data_target).height());
                // } else {
                //     $(".owl-prev", data_target).css({"height":0,"overflow":"hidden"});
                // }
    
                // if (itemx > itemy) {
                //     $(".owl-next", data_target).css({"height":0,"overflow":"hidden"});
                // } else {
                //     $(".owl-next", data_target).css("height", $(".stage-1",data_target).height());
                // }

                // $(".owl-prev", data_target).css("height", $(".stage-1",data_target).height());
                // $(".owl-next", data_target).css("height", $(".stage-1",data_target).height());
                //console.log("Number of items = " + items + " Position of the current item : " + itemx);
            },
            onResized:function (event) {
                $(".owl-prev", data_target).css("height", $(".stage-1",data_target).height());
                $(".owl-next", data_target).css("height", $(".stage-1",data_target).height());
                $(".owl-prev", data_target).css({"height":0,"overflow":"hidden"});
                console.log($(".stage-1",data_target).height());
            },
            onTranslate: function (event){
                console.log("1 onTranslate is fired!");
                inactiveEvent = true;
            },
            onTranslated: function (event){
                console.log("2 onTranslated is fired!");
                inactiveEvent = false;
            }
        });        
    } else if (flag == 3) {
        $(data_target).owlCarousel({
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            margin: 10,
            stagePadding: 10,
            smartSpeed: 450,
            autoplayTimeout: 10000,
            autoplay: false,
            loop: false,
            navText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
            dots: false,
            responsiveClass: true,
            nav: true,
            slideBy: 'page',
            mouseDrag: false,
            touchDrag: false,
            pullDrag: false,
            freeDrag: false,
            checkVisible: false,
            responsive: {
                0: {
                    items: 2,
                },
                576: {
                    items: 4
                },
                768: {
                    items: 4,
                },
                992: {
                    items: 4,
                },
                1200: {
                    items: 5,
                }
            },
            onInitialized: function (event) {
                $(".owl-prev", data_target).css("height", $(".stage-1",data_target).height());
                $(".owl-next", data_target).css("height", $(".stage-1",data_target).height());
                // $(".owl-prev", data_target).css({"height":0,"overflow":"hidden"});
            },
            onChanged: function (event) {

                // var items = event.item.count; // Number of items
                // var itemx = event.item.index; // Position of the current item
                // var itemy = items - (1 + 5); // Show 5 item

                // if (itemx >= 1) {
                //     $(".owl-prev", data_target).css("height", $(".stage-1",data_target).height());
                // } else {
                //     $(".owl-prev", data_target).css({"height":0,"overflow":"hidden"});
                // }
    
                // if (itemx > itemy) {
                //     $(".owl-next", data_target).css({"height":0,"overflow":"hidden"});
                // } else {
                //     $(".owl-next", data_target).css("height", $(".stage-1",data_target).height());
                // }

                //console.log("Number of items = " + items + " Position of the current item : " + itemx);
            }
        });

        // Set height for next and previous
        // var heightItem = $(data_target).find(".stage-1").height();
        // $(data_target).find("button.owl-prev").css("height", heightItem);
        // $(data_target).find("button.owl-next").css("height", heightItem);
    }    
}

function showContent(e) {
    // Get all elements with selected-item and hide them
    item = $(e);
    if (item.hasClass("selected-item")) {
        tabItem = document.getElementsByClassName("selected-item");
        for (i = 0; i < tabItem.length; i++) {
            tabItem[i].classList.remove("selected-item");
        }
    } else {
        tabItem = document.getElementsByClassName("selected-item");
        for (i = 0; i < tabItem.length; i++) {
            tabItem[i].classList.remove("selected-item");
        }
        item.addClass("selected-item");
        // update data
        $("#tabSuggestion .real-item .ttl").html(item.find(".stage-2 .overlay p.txt-name").html());
    }
}


function toggleCollapse(){
	$('.mdl-detail .viw-more').click(function(event){	
        $(this).toggleClass('viw-more-on');
        $('.mdl-detail .anchor-collapse').toggleClass('anchor-collapse-on');
	});
}

var funcMouseOver, funcMouseOut;

// slide hover
function slideHover(nameModule,owlFrame, owlStage, owlItem, typeBanner, onCarousel) {
    //Check status
    if (onCarousel) {
        var showCount;
        var scaling;
        //var videoCount = $(owlFrame).find(owlItem).length;
        var videoCount = 300000000;
        var widthScrollBar = 17;
        var paddingItem = 10;
        var videoWidth;
        var videoHeight;

        //var sliderCount = videoCount / showCount;
        var controlsWidth = 40;
        //var scollWidth = 0;

        // 2. set elements
        var win = $(window);

        //sizes
        var windowWidth = win.width();

        // 1. check type of banner
        if (typeBanner === true) {
            scaling = 1.2;
            showCount = 6;
            //videoWidth = Math.round(((windowWidth - ((controlsWidth * 2) + widthScrollBar) ) / showCount));
            videoWidth = Math.round((windowWidth - widthScrollBar) / showCount) - paddingItem;
            videoHeight = Math.round(videoWidth / (2 / 3));
        } else {
            scaling = 1.5;
            showCount = 5;
            //videoWidth = Math.round(((windowWidth - ((controlsWidth * 2) + widthScrollBar)) / showCount));
            videoWidth = Math.round((windowWidth - widthScrollBar) / showCount) - paddingItem;
            videoHeight = Math.round(videoWidth / (16 / 9));
        }

        console.log("Windown width = " + windowWidth + "; Video width " + videoWidth + "; Video height = " + videoHeight + "; 5 Item = " + ((windowWidth - 117) / 5) + " | 6 Item = " + ((windowWidth - 117) / 6));

        // var videoWidthDiff = (videoWidth * scaling) - videoWidth;
        var videoHeightDiff = (videoHeight * scaling) - videoHeight;

        // 4. set sizes
        // sliderFrame.width(windowWidth);
        // sliderFrame.height(videoHeight * scaling);

        //sliderFrame.css("top", (videoHeightDiff / 2));

        $(nameModule).height((videoHeight * scaling));//70 Height title of module below
        $(owlFrame).height(videoHeight);

        //$(owlFrame).find("button.owl-next").height(videoHeight);
        //$(owlFrame).find("button.owl-prev").height(videoHeight);

        //sliderContainer.width((videoWidth * videoCount) + videoWidthDiff);
        //sliderContainer.width(30000000);

        // sliderContainer.css("top", (videoHeightDiff / 2));
        // sliderContainer.css("margin-left", (controlsWidth));

        //5. fire event hover effect
        console.log("ON event for mouse over");

        funcMouseOver = function () {
            console.log("mouseover is RUNNING");
            if (!inactiveEvent) {
            var widthScaled = (videoWidth - 0) * scaling;
            var heightScaled = (videoHeight - 0) * scaling;
            var widthScaled16x9 = (heightScaled * 16) / 9;
            var offSetLeft = (widthScaled16x9 / 2) - (widthScaled / 2);

            $(this).css("width", widthScaled);
            $(this).css("height", heightScaled);
            $(this).parent(owlStage).width((videoWidth - 0) * videoCount);
            $(this).addClass("hovered");
            $(this).css("top", -(videoHeightDiff / 2));

            $(this).find(".preview-media video").css({ "width": widthScaled16x9, "height": heightScaled, "margin-left": (offSetLeft * -1) });
            //console.log("Width video = "++"; Height video = "+heightScaled+"; Offset = "+);

            //Auto hide content
            // $(this).find(".stage-2 .overlay").fadeOut(2000); 
            // $(this).find(".stage-2 .ftn-control").fadeOut(2000); 
            }
        };

        $(nameModule).on("mouseover", owlItem, funcMouseOver);

        funcMouseOut = function () {
            console.log("mouseout is RUNNING");
            if (!inactiveEvent) {
            $(this).css("width", (videoWidth - 16) * 1);//16 : width scroll bar
            $(this).css("height", (videoHeight - 16) * 1);//16 : width scroll bar
            $(this).css("top", 0);
            $(owlStage).css("padding-top", 0);
            $(this).removeClass("hovered");

            //Auto hide content
            // $(this).find(".stage-2 .overlay").fadeIn(2000); 
            // $(this).find(".stage-2 .ftn-control").fadeIn(2000);
            }
        }
        //6. fire event mouseout effect
        $(nameModule).on("mouseout", owlItem, funcMouseOut);
    } else {
        console.log("OFF event for mouse over");
        $(nameModule).off("mouseover", owlItem);
        $(nameModule).off("mouseout", owlItem);
    }
}

// Toggle control
function toggleControl(){
    // 1. Toggle volume
    $(document).on("click",".mdi-volume-high", function() {
        $(this).toggleClass("mdi-volume-mute");
    });

    // 2. Couple like and cancel like
    $(document).on("click",".mdi-thumb-up-outline", function() {
        $(this).removeClass("mdi-thumb-up-outline");
        $(this).addClass("mdi-thumb-up");
    });

    $(document).on("click",".mdi-thumb-up", function() {
        $(this).removeClass("mdi-thumb-up");
        $(this).addClass("mdi-thumb-up-outline");
    });

    // 3. Couple add and check
    $(document).on("click",".mdi-plus", function() {
        $(this).removeClass("mdi-plus");
        $(this).addClass("mdi-check");
    });

    $(document).on("click",".mdi-check", function() {
        $(this).removeClass("mdi-check");
        $(this).addClass("mdi-plus");
    });
}


// Toggle control
function changeBgEffect(){
    // Get the header
    var header = $(".mdl-header");

    // Get the offset position of the navbar
    //var sticky = header.offsetTop;
    var sticky = 64;

    //alert("Off set top " + sticky);
    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    
    if (window.pageYOffset > sticky) {
        header.addClass("change-bg-header");
    } else {
        header.removeClass("change-bg-header");
    }
}


// Close 
function closeExtent(){
    $(document).on("click",".mdi-close", function() {
        $(this).parents(".mdl-extent-player").fadeOut("slow");
    });
}


// Suggestion search
function suggestionSearch(){

    //1. Open 
    $(".suggestion-input").click(function(){
        $(".suggestion-search").fadeIn("slow");
        $(".suggestion-close").fadeIn("slow");
        $(".all-content").fadeOut("slow");
    });

    //2. Close 
    $(".suggestion-close").click(function(){
        $(".all-content").fadeIn("slow");
        $(".suggestion-search").fadeOut("slow");
        $(this).fadeOut("slow");
    });
}