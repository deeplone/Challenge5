var screenWidth = $(window).width();
var screenHeight = $(window).height();
var anchorCarousel;
var heightItem = $(".mdl-list .image").height();

$(function () {
    closeFestival();
	subAlignGame();
    window.addEventListener("resize", function () {
        subAlignGame();
    }, false);
    $("#tabs").tabs();
    $("#tabs-genre").tabs();
    //----------------------Banner
    $(".owl-film-slide").each(function (index) {
        carouselAll($("#" + this.id));
    });

    $("#owl-one-banner").owlCarousel({
        slideSpeed: 300,
        paginationSpeed: 400,
        responsive: {
            0: {
                items: 1
            },
            769: {
                items: 1,
                dots: true,
                stagePadding: 60,
                loop: true,
                margin: 10,
                nav: true,
                navText: ["<img src='/images/pre_48px.png' class='reset-img'/>", "<img src='/images/next_48px.png' class='reset-img'/>"]
            }
        }
    });

    $("#owl-one").owlCarousel({
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        items: 1,
        responsive: {
            0: {
                dots: true,
                nav: false
            },
            769: {
                dots: true,
                nav: true,
                navText: ["<img src='/images/pre_48px.png' class='reset-img'/>", "<img src='/images/next_48px.png' class='reset-img'/>"]
            }
        }
    });

    $(".tab-carousel").owlCarousel({
        loop: false,
        autoWidth: true,
        nav: false,
        margin: 20,
    });
    scrollTopMenu();

    //---------------------- Toggle item menu
    toggleMoreMenu();

    //----------------------Set height for button
    forNextAndPrev();

    //----------------------Show hide content
    dropDownContent();

    //----------------------Check class
    checkAndSetHeight();

    //----------------------Search my clip
    //searchMyclip();

    //----------------------Set height player and resolve scroll
    //scrollAndCrop();
    //---------------------- Padding top when fix menu top; add padding bottom for header
    smartHeader();
    //----------------------Show popup
    triggerPopup();

    //---------------------- View full view more
    viewShortFullDes();

    //---------------------- Slider for chapters
    $('.chapterSlider').owlCarousel({
        nav: true,
        dots: false,
        loop: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 0,
        stagePadding: 8,
        responsive: {
            0: {
                items: 5
            },
            769: {
                items: 9
            }
        }
    });
    //Show menu
    showMenu();

    //----------------------Resize screen window
    $(window).resize(function () {
        screenWidth = $(window).width();
        screenHeight = $(window).height();

        forNextAndPrev();

        if (screenWidth >= 980) {
            $("div[off-canvas$='reveal']").attr("off-canvas", "slidebar-1 top reveal");
        } else {
            $("div[off-canvas$='reveal']").attr("off-canvas", "slidebar-1 left reveal");
        }
    });

    //Disable zoom in ios 10
    document.addEventListener('gesturestart', function (e) {
        e.preventDefault();
    });

    //36.Modal
    modal();
    //37.Set width
    setWidthContent();

    $(window).resize(function () {
        setWidthContent();
    });

});


//6.----------------------Selectpicker for schedule
function searchMyclip2() {
    $(".btn-search").click(function () {
        var heightBody = $(window).height();
        $(".popup-search").toggle(0, function () {
            $(".container").css({"height": 0, "overflow": "hidden"});
        });
        $(".box-search-suggess").css("height", heightBody - 40);
        $(".mdl-body").css("display", "none");
    });

    $("#closeBox").click(function () {
        $(".popup-search").hide(20);
        $(".container").css({"height": "inherit", "overflow": "inherit"});
        $(".mdl-body").css("display", "block");
    });

    $(".ipt-search").focus(function () {
        $(".box-search-suggess").toggle(50);
    });

    $("#clearSuggess").click(function () {
        $(".box-search-suggess").hide();
    });

}

//7.----------------------Thiáº¿t láº­p height cho khung live cam
function setHeightLiveCam() {
    var screenHeight = $(window).height();
    var height01 = $(".mdl-live-cam .item-typing").outerHeight();
    var height02 = $(".mdl-live-cam .top-control").outerHeight();
    var height03 = $(".mdl-live-cam .title").outerHeight();
    var heightObject = $(".mdl-live-cam .scroll-content").outerHeight();
    var chatHeight = screenHeight - (height01 + height02 + height03 + 10);

    $(".mdl-live-cam").css({"height": screenHeight});

    //Kiá»ƒm tra Ä‘iá»u kiá»‡n trÆ°á»›c khi thiáº¿t láº­p chiá»u cao cho khung chat
    if (heightObject > chatHeight) {
        $(".mdl-live-cam .chat-control .scroll-content").css({"height": chatHeight});
    }
}

//8.----------------------Thiáº¿t láº­p height cho banner theo tá»‰ lá»‡ 16/9
function setHeightBanner() {
    var screenWidth = $(window).width();
    var heightBanner = ((screenWidth * 9) / 16) + 2;
    $("#carousel-banner").css("height", heightBanner);
    $("#carousel-banner .owl-item").css("width", screenWidth);

    //$("#carousel-banner .owl-item ").css("width","100%");
    //$("#carousel-banner .owl-item img").css("width",screenWidth);
    $("#carousel-banner").css("overflow", "hidden");
}

//9.----------------------Thiáº¿t láº­p height cho images theo tá»‰ lá»‡ 16/9
function setHeightImage16x9(item) {
    item.css("height", "auto");
    var imageWidth = item.width();
    var imageHeight = ((imageWidth * 9) / 16);
    item.css("height", imageHeight);
}

//10.----------------------Thiáº¿t láº­p height cho images theo tá»‰ lá»‡ 2/3
function setHeightImage2x3(item) {
    item.css("height", "auto");
    var imageWidth = item.width();
    var imageHeight = ((imageWidth * 3) / 2);
    item.css("height", imageHeight);
}

//11.----------------------Thiáº¿t láº­p height cho images theo tá»‰ lá»‡ 4/4
function setHeightImage4x4(item) {
    item.css("height", "auto");
    var imageWidth = item.width();
    item.css("height", imageWidth);
}

//12.----------------------Thiáº¿t láº­p height cho images theo tá»‰ lá»‡ 4/3
function setHeightImage4x3(item) {
    item.css("height", "auto");
    var imageWidth = item.width();
    var imageHeight = ((imageWidth * 3) / 4);
    item.css("height", imageHeight);
}

//13.----------------------Thiáº¿t láº­p height cho images theo tá»‰ lá»‡ 4/4
function paddingModule() {
    var sw = $(window).width();
    var marginLeft = (sw - $(".list-dramas .content").width()) / 2;
}

//14.---------------------	Thiáº¿t láº­p fix menu khi scroll menu
function fixToTop(class1, class2, topPosition) {
    $(window).scroll(function (e) {

        $(class1).css("height", "auto");
        $(class2).removeClass("scroll-content-fixed");

        var heightScreen = $(window).height();
        var heightEmbed = $(class2).height();
        var heightBody = $('body').height();

        if ((heightScreen > (heightEmbed * 2)) && (heightBody > heightScreen)) {
            if ($(window).scrollTop() > topPosition) {
                $(class1).css("height", heightEmbed);
                $(class2).addClass("scroll-content-fixed");
            } else {
                $(class2).removeClass("scroll-content-fixed");
            }
        }
    });
}

//15.--------------------------Menu config--------------
function menuConfig() {
    //Cáº¥u hĂ¬nh menu, Ä‘áº§u tiĂªn cho phĂ©p cháº¡y menu á»Ÿ trĂªn web
    if (screenWidth >= 980) {
        $("div[off-canvas$='reveal']").attr("off-canvas", "slidebar-1 top reveal");
    } else {
        $("div[off-canvas$='reveal']").attr("off-canvas", "slidebar-1 left reveal");
    }

    // Create a new instance of Slidebars
    var controller = new slidebars();

    // Events
    $(controller.events).on('opening', function (event, id) {
        $(".close-menu").css("display", "block");
        $("html").css("overflow", "hidden");
        $("body").css("overflow", "hidden");
        $(".container").css("min-height", $(window).height());
    });

    $(controller.events).on('closed', function (event, id) {
        $(".close-menu").css("display", "none");
        $("html").css("overflow", "auto");
        $("body").css("overflow", "auto");
        $(".container").css("min-height", "auto");
    });

    // Initialize Slidebars
    controller.init();

    // Left Slidebar controls
    $('.js-toggle-left-slidebar').on('click', function (event) {
        event.stopPropagation();
        controller.toggle('slidebar-1');
    });

    // Close any
    $(controller.events).on('opened', function () {
        $('[canvas="container"]').addClass('js-close-any-slidebar');
    });

    $(controller.events).on('closed', function () {
        $('[canvas="container"]').removeClass('js-close-any-slidebar');
        $(".left-menu .content").css("display", "block");
    });

    $('body').on('click', '.js-close-any-slidebar', function (event) {
        event.stopPropagation();
        controller.close();
    });

    $('body').on('click', '.close-menu-small', function (event) {
        event.stopPropagation();
        controller.close();
    });

    $(".close-menu").on("mousedown mouseup click touchend", function (event) {
        event.stopPropagation();
        controller.close();
    });
}

//16.--------------------------Thiáº¿t láº­p hieght cho tab
function setHeightTab() {
    var heightTab = $(window).height() - 180;
    $(".left-menu .tab").css("height", heightTab);
    $(".left-menu .tab-container").css("height", heightTab);
    //alert("Height: " + heightTab);
}

//17.----------------------Popup
function openPopup() {

    //popup piracy
    $("#piracy").click(function (e) {
        $(".overlay-popup").fadeIn();
    });

    $("#piracy-ok").click(function (e) {
        $(".overlay-popup").css("display", "none");
    });

    $("#piracy-cancel").click(function (e) {
        $(".overlay-popup").css("display", "none");
    });

    //popup share
    $("#share").click(function (e) {
        $(".overlay-popup-2").fadeIn();
    });

    $(".close-popup-share").click(function (e) {
        $(".overlay-popup-2").css("display", "none");
    });

    //popup share
    $("#episode").click(function (e) {
        $(".overlay-popup-3").fadeIn();
    });

    //popup default
    $("#popup").click(function (e) {
        $(".overlay-popup-4").fadeIn();
    });

    $(".popup-close").click(function (e) {
        $(".overlay-popup-4").css("display", "none");
    });

    $(document).bind("mouseup touchend", function (e) {
        var container = $(".overlay-popup .wrap");
        var containerShare = $(".overlay-popup-2 .wrap");
        var containerEpisode = $(".overlay-popup-3 .wrap");
        var containerDefault = $(".overlay-popup-4 .wrap");
        if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0) { // ... nor a descendant of the container
            $(".overlay-popup").fadeOut();
        }

        if (!containerShare.is(e.target) // if the target of the click isn't the container...
                && containerShare.has(e.target).length === 0) { // ... nor a descendant of the container
            $(".overlay-popup-2").fadeOut();
        }

        if (!containerEpisode.is(e.target) // if the target of the click isn't the container...
                && containerEpisode.has(e.target).length === 0) { // ... nor a descendant of the container
            $(".overlay-popup-3").fadeOut();
        }

        if (!containerDefault.is(e.target) // if the target of the click isn't the container...
                && containerDefault.has(e.target).length === 0) { // ... nor a descendant of the container
            $(".overlay-popup-4").fadeOut();
        }
    });
}

//18.-----------------------Crop description
function cropDescription() {
    $(".crop-fire").click(function (e) {
        $(".crop-description").toggleClass("crop-open");
    });
}

//19.-----------------------setWidthTitle
function setWidthTitle() {
    var widthTitle = $(".container").width() - $(".owl-dots").width();
    $("#carousel-banner .title-banner").css("width", widthTitle);
    //alert("Hello!" + widthTitle);
}

//20.-----------------------setWithSinger
function setWithSinger() {
    var widthSinger = $(".mdl-list-videos .place-holder-video").width() - $(".mdl-list-videos .place-holder-video .viewer").outerWidth() - 40;
    $(".mdl-list-videos .place-holder-video .text-singer").css("max-width", widthSinger);
}

//21.-----------------------Close open support
function openSupport() {
    //$(".mdl-support .title").click(function(e) {
    //$(".mdl-support-content").css("display","none");
    //$(this).siblings(".mdl-support-content").toggle();
    //$(".fa-angle-down").removeClass("fa-angle-up");
    //$(this).siblings(".fa-angle-down").toggleClass(".fa-angle-up");
    // });
}

//22.-----------------------Accordion
function myAccordion() {
    $("#accordion").accordion({
        collapsible: true,
        heightStyle: "content",
        animate: {
            duration: 200
        }
    });
}

//23.-----------------------scrollDisplay
function scrollDisplay() {

    var lastScrollTop = 20;
    // element should be replaced with the actual target element on which you have applied scroll, use window in case of no target element.
    window.addEventListener("scroll", function () { // or window.addEventListener("scroll"....
        var st = window.pageYOffset || document.documentElement.scrollTop; // Credits: "https://github.com/qeremy/so/blob/master/so.dom.js#L426"
        if (st > lastScrollTop) {
            // downscroll code
            $(".scroll-display").fadeOut();
        } else {
            // upscroll code
            $(".scroll-display").fadeIn();
        }
        lastScrollTop = st;
    }, false);

}

//24.-----------------------changeColor
function changeColor() {
    $(window).scroll(function () {
        $('.navbar-fixed-top').removeClass("change-color");
        if ($(window).scrollTop() > 0) {
            $('.navbar-fixed-top').addClass("change-color");
        } else {
            $('.navbar-fixed-top').removeClass("change-color");
        }
    });
}

//25.-----------------------Crop body for scroll left menu
function cropBody() {
    var screenW = $(window).width();
    var screenH = $(window).height();
    if (screenW >= 980) {
        $(".js-toggle-left-slidebar").bind("click", function () {
            $("body").css("height", screenH);
            $("body").css("overflow", "hidden");
        });

        $(".close-menu-small").bind("click", function () {
            $("body").css("height", "auto");
        });
    }
}

//26.-----------------------Set height player
function scrollAndCrop() {
    //var heightContent = $(".mdl-player .player-left").height();
    var widthContent = $(".mdl-player .player-right").width() + 17;//17px is think of scroll

    //$(".mdl-player .player-right").css("height", heightContent);
    //$(".mdl-player .overscroll").css("height", heightContent);
    //$(".mdl-player .overscroll").css("width", widthContent);
}

//27.-----------------------Show submenu-accuont
function dropDownContent() {
    var flag = false;
    var flagTwo = false;
    var triggerAccount = $(".link-account");
    var triggerMenu = $("#hamburger");

    //Dropdown account
    triggerAccount.click(function () {
        if (flag === false) {
            //Do something
            $(".link-account").addClass("select-sub-account");
            flag = true;
        } else {
            //Do something
            $(".link-account").removeClass("select-sub-account");
            flag = false;
        }
        $(".link-account .sub-account").toggle(200);
    });

    //Dropdown menu
    if (screenWidth < 769) {
        $(".menu-top").css("height", screenHeight);
    }

    triggerMenu.click(function () {
        if (flagTwo === false) {
            //Do something
            //$(".mdl-header").removeClass("navbar-fixed-top");
            //$("body").css("padding-top","0");
            $(".icon-menu-bar").addClass("js-close");
            //$(".mdl-body").css("display","none");
            flagTwo = true;
        } else {
            //Do something
            //$(".mdl-header").addClass("navbar-fixed-top");
            //$("body").css("padding-top","50px");
            $(".icon-menu-bar").removeClass("js-close");
            //$(".mdl-body").css("display","block");
            flagTwo = false;
        }
        $(".mdl-header .menu-top").toggle();
    });
}

//28.-----------------------Check class
function checkAndSetHeight() {
    if ($("body").hasClass("bg-login")) {
        $("body").css("min-height", screenHeight);
    }
}


//29.-----------------------Set position for button
function forNextAndPrev() {
    var nextButton = $(".mdl-list .owl-next");
    var prevButton = $(".mdl-list .owl-prev");
    var heightItem = $(".mdl-list .image").height();
    var topItem = heightItem + 16;

    nextButton.css("height", heightItem);

    nextButton.css("line-height", heightItem + "px");
    prevButton.css("line-height", heightItem + "px");

    nextButton.css("top", "-" + (topItem - 4) + "px");
    prevButton.css("top", "-" + (topItem - 4) + "px");

    //alert("Height is " + heightItemA);

    //owlMulti.on('changed.owl.carousel', function(event) {
    //	  var index = event.item.index;
    //alert("Index is " + index);
    //	  if (index == 1) {
    //$(".owl-prev").css("display","none");
    //	  } else {
    //$(".owl-prev").css("display","block");
    //	  }
    //});
}

//30.-----------------------Close popup
function triggerPopup() {
    var trigger = $(".modal-link");
    var popupFrame = $(".mdl-popup");
    var popupClose = $(".mdl-popup .close-popup");

    trigger.click(function (e) {
        popupFrame.fadeIn(300);
        $(".mdl-body").css("visibility", "hidden");/*hidden content when opens popup*/
        $(".mdl-footer").css("visibility", "hidden");/*hidden content when opens popup*/
    });

    $(document).bind("mouseup touchend touchstart", function (e) {
        var container = $(".mdl-popup .popup");
        if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0) { // ... nor a descendant of the container
            popupFrame.fadeOut(300);
            $(".mdl-body").css("visibility", "visible");/*visible content when closes popup*/
            $(".mdl-footer").css("visibility", "visible");/*visible content when closes popup*/
        }
    });

    popupClose.click(function (e) {
        popupFrame.fadeOut(300);
        $(".mdl-body").css("visibility", "visible");/*visible content when closes popup*/
        $(".mdl-footer").css("visibility", "visible");/*visible content when closes popup*/
    });

}


//31.---------------------- View full view more
function viewShortFullDes() {
    var flag = false;
    $(".btn-view").click(function () {
        if (flag === false) {
            //Do something
            $(".short-des").addClass("full-des");
            flag = true;
        } else {
            //Do something
            $(".short-des").removeClass("full-des");
            flag = false;
        }
    });
    var btnViewFull = $(".btn-view-more");

    btnViewFull.click(function () {
        $(".mdl-player .player-right .text-des").css("max-height", "100%");
        btnViewFull.hide();
    });
}

//32.---------------------- View full view more
function carouselAll(anchorCarousel) {
    var heightItem = $(".mdl-list .image").height();

    anchorCarousel.owlCarousel({
        loop: false,
        margin: 5,
        lazyLoad: true,
        callbacks: true,
        pagination: false,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                nav: false,
                items: 2,
                margin: 5,
                stagePadding: 10
            },
            769: {
                nav: false,
                stagePadding: 10,
                margin: 5,
                items: 5
            },
            980: {
                stagePadding: 40,
                nav: true,
                items: 5,
                slideBy: 6,
                smartSpeed: 100
            }
        }
    });

    var prevButton = $(".owl-prev", anchorCarousel);
    var nextButton = $(".owl-next", anchorCarousel);
    var widthContent = $(".owl-stage", anchorCarousel).innerWidth();

    anchorCarousel.on('changed.owl.carousel,drag.owl.carousel', function (event) {
        var items = event.item.count; // Number of items
        var itemx = event.item.index; // Position of the current item
        var itemy = items - (1 + 5);// 5 lĂ  chá»‰ sá»‘ pháº§n tá»­ Ä‘áº§u tiĂªn cá»§a chuá»—i hiá»ƒn thá»‹ khi slide show 5 item


        if (itemx > 0) {
            prevButton.css("height", heightItem);
        } else {
            prevButton.css("height", 0);
        }

        if (itemx > itemy) {
            nextButton.css("height", 0);
        } else {
            nextButton.css("height", heightItem);
        }
    });



    if (widthContent < 930 || widthContent < 1390) {
        nextButton.css("display", "none");
    }
    //alert(widthContent);
}



//33.----------------------
function scrollTopMenu() {
    //if(screenWidth > 979){
//				$(window).scroll(function(e){
//					if ($(window).scrollTop() > 50) {
//						$(".mdl-header").removeClass("effect-header");
//						$(".mdl-header").addClass("effect-header");
//					}
//					else{
//						$(".mdl-header").removeClass("effect-header");
//					}
//		  		});
//			}

    $(window).scroll(function (e) {
        if ($(window).scrollTop() > 50) {
            $(".mdl-header").removeClass("effect-header");
            $(".mdl-header").addClass("effect-header");
        } else {
            $(".mdl-header").removeClass("effect-header");
        }
    });


}

//34.----------------------
function toggleMoreMenu() {
    $(".btn-link-more").click(function (e) {
        $(".mdl-header").toggleClass("header-add-item");
        if (screenWidth > 768) {
            $(".right-header").toggle();
            $(".anchor-event").toggle();
        }
    });

    $("#hamburger").click(function (e) {
        $(".mdl-header").toggleClass("bg-effect-header");
    });
}
//35.----------------------
function smartHeader() {
    if (screenWidth > 768) {
        if ($(".mdl-header").hasClass("navbar-fixed-top")) {
            $(".mdl-body").css("margin-top", "65px");

            if ($(".mdl-banner").hasClass("anchor-banner")) {
                $(".mdl-header").addClass("padd-header");
                $(".mdl-body").css("margin-top", "0");
            }
        }
    } else {
        $(".mdl-body").css("margin-top", "50px");// add in mobile
    }
}

//36. Showmenu
function showMenu() {
    //alert( "hello" );
    var anchorLink = ".has-menu a";
    var classTaget = "open-menu-sub";

    $(anchorLink).bind("click", function () {
        if ($(this).parent().hasClass(classTaget)) {
            $(this).parent().removeClass(classTaget);
        } else {
            $(anchorLink).parent().removeClass(classTaget);
            $(this).parent().addClass(classTaget);
        }
    });
}

/*-----------------------*/
/*37.modal*/
/*-----------------------*/
function modal() {
    "use strict";
    var targetObject00 = $(".modal-vietnt");
    var targetObject01 = $('.modal-content-vietnt');
    var triggerObject01 = $('.action-vietnt');

    /*01 open*/
    triggerObject01.click(function () {
        var nameTargetObject = '#' + $(this).attr('data-target');
        //var nameTargetObject = $(this).attr('data-target');

        /*show modal*/
        $(nameTargetObject).show();

        /*hide modal*/
        if ($(this).attr('data-dismiss') === 'close') {
            targetObject00.hide();
        }
    });

    /*02 close*/
    targetObject00.click(function () {
        $(this).hide();
    });

    /*03.disable event on volume content*/
    targetObject01.click(function (event) {
        event.stopPropagation();
    });

    //Escape exists
    $(document).keyup(function (e) {
        if (e.keyCode === 27) { // escape key maps to keycode `27`
            targetObject00.hide();
        }
    });
}
/*-----------------------*/
/*38.setWidthContent*/
/*-----------------------*/
function setWidthContent() {

    if ($(window).width() < 980) {

        var item = $(".mdl-chapter .item");
        var image = $(".mdl-chapter .image");
        var rightContent = $(".mdl-chapter .right-content");
        var wRightContent = item.width() - (image.width() + 10);

        rightContent.css({"width": wRightContent, "float": "left"});
    }
}
function closeFestival() {


    $('.festival-popup .btn-close').click(function () {
        $('.festival-popup').fadeOut();

        //console.log('Hello!');
        //alert("Hello!");
    });
}
function alignGame() {
    subAlignGame();

    window.addEventListener("resize", function () {
        subAlignGame();
    }, false);
}

function subAlignGame() {
    if ($(window).width() > $(window).height()) {
        $('#containerworldTime').css("height", $(window).height());
        $('#containerworldTime').css("width", "100%");
        $('#containerworldTime').css("margin-top", "0");
        console.log('height = ' + ($(window).height() - $("#containerworldTime").height()) / 2);
    } else {
        $('#containerworldTime').css("height", "auto");
        $('#containerworldTime').css("width", $(window).width());
        $('#containerworldTime').css("margin-top", ($(window).height() - $("#containerworldTime").height()) / 2);
        console.log('height = ' + ($(window).height() - $("#containerworldTime").height()) / 2);
    }
}