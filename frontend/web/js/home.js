var audio = new Audio();
$(document).ready(function () {
    // $('.modal').on('hidden.bs.modal', function(){
    //     console.log("vào đây");
    //     $(this).find('form').trigger('reset');
    //     $('.help-block').text('');
    //     // $(this).find('form')[0].reset();
    // });
    if ($("div").hasClass('captcha')) {
        $('.modal').on('shown.bs.modal', function (e) {
            console.log("open modal");
            if ($(this).find('form img').data('yiiCaptcha')) {
                $(this).find('form img').yiiCaptcha('refresh');
            }
        });
    }

    var scroll = new SmoothScroll('a[href*="#"]:not([data-easing])');

    ScrollReveal().reveal('.mdl-banner', {delay: 400});
    ScrollReveal().reveal('.mdl-benefit', {delay: 400});
    ScrollReveal().reveal('.mdl-procedure', {delay: 400});
    ScrollReveal().reveal('.mdl-customer', {delay: 400});
    ScrollReveal().reveal('.mdl-feedback', {delay: 400});
    ScrollReveal().reveal('.mdl-address', {delay: 400});

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
    });

    playAudioInHome();

    pjaxController();
});

function forgotPasswordPopup() {
    $('#loginModal').modal('hide');
    $('#forgotPasswordModal').modal('show');
}

function registerPopup() {
    $('#loginModal').modal('hide');
    $('#signUpModal').modal('show');
}

function normalSignUp() {
    $('#signUpModal').modal('hide');
    $('#signUpNormalModal').modal('show');
}

function internalSignUp() {
    $('#signUpModal').modal('hide');
    $('#signUpInternalModal').modal('show');
}

function playAudioInHome() {
    audio.onended = function () {
        $('.btnPlayRbtHot').removeClass('mdi-pause').addClass('mdi-play');
    };
    audio.onerror = function () {
        $('.btnPlayRbtHot').removeClass('mdi-pause').addClass('mdi-play');
    };
    $(document).on('click', '.btnPlayRbtHot.mdi-play', function () {
        $('.btnPlayRbtHot').removeClass('mdi-pause').addClass('mdi-play');
        $(this).removeClass('mdi-play').addClass('mdi-pause');
        audio.src = $(this).data('value');
        audio.play();
    });
    $(document).on('click', '.btnPlayRbtHot.mdi-pause', function () {
        $('.btnPlayRbtHot').removeClass('mdi-pause').addClass('mdi-play');
        audio.pause();
    });
}