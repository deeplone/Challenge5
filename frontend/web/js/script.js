$(document).ready(function () {

  var scroll = new SmoothScroll('a[href*="#"]:not([data-easing])');

  ScrollReveal().reveal('.mdl-banner', { delay: 400 });
  ScrollReveal().reveal('.mdl-benefit', { delay: 400 });
  ScrollReveal().reveal('.mdl-procedure', { delay: 400 });
  ScrollReveal().reveal('.mdl-customer', { delay: 400 });
  ScrollReveal().reveal('.mdl-feedback', { delay: 400 });
  ScrollReveal().reveal('.mdl-address', { delay: 400 });

  $('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    fade: true,
    autoplay: true,
    autoplaySpeed: 10000,
    asNavFor: '.slider-nav'
  });
  $('.slider-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: false,
    centerMode: false,
    focusOnSelect: true
  });
  $('.multiple-items').slick({
    //infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    autoplay: true,
    autoplaySpeed: 10000,
    centerPadding: 50,
    arrows: true,
    prevArrow: '<button type="button" class="slick-prev mdi mdi-chevron-left">Previous</button>',
    nextArrow: '<button type="button" class="slick-next mdi mdi-chevron-right">Next</button>',
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
  // Call function
  //runValidate();     

  // all parameters are optional
  validateForm();
  // toggle listen
  toggleListen();
  toggleListen2();

  // Select button
  selectItem();

  //Set padding top meanwhile have sticky menu
  setPaddingTop();

  // all parameters are optional
  //validateForm();
  $('[data-toggle="tooltip"]').tooltip();
});

//---------- 01. Run carousel 01 ----------
function runCarousel() {
  $('.mdl-banner').owlCarousel({
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    items: 1,
    margin: 0,
    stagePadding: 0,
    smartSpeed: 450,
    autoplay: true,
  });
}

//---------- 01. Run carousel 02 ----------
function runCarousel02() {
  $('.mdl-package').owlCarousel({
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    items: 5,
    margin: 10,
    stagePadding: 10,
    smartSpeed: 450,
    autoplay: false,
    nav: true,
    navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
    dots: false
  });
}

function runValidate() {
  if (!isNaN('#iptEmail')) bootstrapValidate('#iptEmail', 'email: Vui lòng nhập địa chỉ email hợp lệ!');
  if (!isNaN('#iptIdentify')) bootstrapValidate('#iptEmail', 'email: Vui lòng nhập địa chỉ email hợp lệ!');
  if (!isNaN('#iptPhone')) bootstrapValidate('#iptEmail', 'email: Vui lòng nhập địa chỉ email hợp lệ!');
}


// Validate form
function validateForm() {
  'use strict';
  window.addEventListener('load', function () {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
}


function toggleListen() {
  $(".btn-listen").click(function () {
    if ($(this).hasClass("listening")) {//Check current item has clicked
      //1. Toggle selected
      $(this).toggleClass("listening");
    } else {
      //1. Remove all class
      //$(".parent-menu li").removeClass("listening");
      $(".btn-listen").removeClass("listening");
      $(this).toggleClass("listening");
    }

  });

  $(".mdl-brand .btn-play").click(function () {
    if ($(this).hasClass("listening")) {//Check current item has clicked
      //1. Toggle selected
      $(this).children(".mdi").removeClass("mdi-pause");
      $(this).children(".mdi").addClass("mdi-play");
      $(this).toggleClass("listening");
    } else {
      //1. Remove all class
      //$(".parent-menu li").removeClass("listening");
      $(".mdl-brand .btn-play").removeClass("listening");
      $(".mdl-brand .btn-play").children(".mdi").removeClass("mdi-pause");
      $(".mdl-brand .btn-play").children(".mdi").addClass("mdi-play");
      $(this).children(".mdi").removeClass("mdi-play");
      $(this).children(".mdi").addClass("mdi-pause");
      $(this).toggleClass("listening");
    }

  });
}

function selectItem() {
  $('.mdl-recording .btn-blue-aqua').click(function () {
    $(this).toggleClass('btn-blue-aqua-selected');
  });
}

function setPaddingTop() {
  var selector = $('.fixed-top');
  if (selector.length > 0) {
    $('body').css('padding-top', selector.outerHeight());
  }
}