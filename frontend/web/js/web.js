/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {


    audio = new Audio();
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

    var tech = GetURLParameter('rs');
    console.log(tech);
    if (tech == "success") {
        $("#paid-finish").modal('show');
    }

    var fncode = $("#finish-value-code").val();
    if (fncode == 0) {
        $('#test1cachnghiemtuc').modal('show');
    }

    $('.checkone').click(function () {
        $('.checkone').not(this).prop('checked', false);
    });
    $('.checkone1').click(function () {
        $('.checkone1').not(this).prop('checked', false);
    });
    $('.checkone2').click(function () {
        $('.checkone2').not(this).prop('checked', false);
    });
    $('.checkone3').click(function () {
        $('.checkone3').not(this).prop('checked', false);
    });
    $.ajaxSetup({
        beforeSend: function () {
            $('.mdl-contact-top').append('<div id="ajax_loading" class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');
        }
    });
    $(document).ajaxStop(function () {
        $('#ajax_loading').html('');
        $('#ajax_loading').hide();
        $('#ajax_loading').remove();
    });
    $('#enteprise-agree').click(function () {
        if ($(this).prop('checked')) {
            $(':button[type="submit"]').prop('disabled', false);
        } else {
            $(':button[type="submit"]').prop('disabled', true);
        }
    });

    $('#payment-getotp').click(function () {
        var ref = $(this).attr('hreff');
        $.ajax({
            url: $(this).attr('otp-url'),
            data: {_csrf: $('meta[name="csrf-token"]').attr("content")},
            type: 'post',
            success: function (code) {
                console.log(code);
                if (code == 1) {
                    location.href = ref;
                } else {
                    alert('Có lỗi xảy ra, Quý khách thử lại sau ít phút!');
                }
            }
        });
    });

    $('#refresh-otp-payment').click(function () {
        $('#error-message').hide();
        $.ajax({
            url: $(this).attr('hreff'),
            data: {_csrf: $('meta[name="csrf-token"]').attr("content")},
            type: 'post',
            success: function (code) {

                if (code == 1) {
                    alert('Mã xác thực mới đã được gửi về số điện thoại của bạn!');
                } else {
                    alert('Có lỗi xảy ra, Quý khách thử lại sau ít phút!');
                }
                return;
            }
        });
        return;
    });

    $('body').on('click', '.nav-item', function () {
        $('.nav-item').removeClass('active');
        $('span.sr-only').remove();
        $(this).addClass('active');
        $(this).append('<span class="sr-only">(current)</span>');
    });

    $('body').on('change', ':input[type="file"]', function () {
        // console.log($(this).parent().find('.custom-file-label'));
        $(this).parent().parent().find('.view-file-upload').hide();
        $(this).parent().find('.custom-file-label').html($(this).val());
    });

    $('.mdl-intro').outerHeight($(document).height());

    $('#voice-content').on('keyup', function () {
        $('#counter-character').html('(' + this.value.length + '/1200)');
    });
});

function GetURLParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return sParameterName[1];
        }
    }
}

function toStep(step) {
    if (step == 1) {
        $('#_form1').show();
        $('#_form2').hide();
        $('#_form3').hide();
    } else if (step == 2) {
        $('#_form1').hide();
        $('#_form2').show();
        $('#_form3').hide();
    } else if (step == 3) {
        $('#_form1').hide();
        $('#_form2').hide();
        $('#_form3').show();
    }
}

function alert(message) {
    $.alert({
        title: '',
        content: message
    });
    return false;
}


$('#sound_background_checkbox').on('click', function () {
    console.log("ahuahu");
    if ($('#sound_background_checkbox').is(':checked')) {
        $('#sound_background_checkbox').val('1');
    } else {
        $('#sound_background_checkbox').val('0');
    }
});

function nextStep() {
    if ($("#voice-content").val().length < 650) {
        $("#less-character").show();
    } else if ($("#voice-content").val().length > 1200) {
        $("#more-character").show();
    } else {
        $("#tab-1").removeClass("active");
        $("#tab-2").addClass("active");
        $("#ctn-1").hide();
        $("#ctn-2").show();
        $("#tab-2").click(function () {
            tabClick(2);
        });
    }

}

function nextStep2() {
    $("#tab-2").removeClass("active");
    $("#tab-3").addClass("active");
    $("#ctn-2").hide();
    $("#ctn-3").show();
    $("#tab-3").click(function () {
        tabClick(3);
    });
}

function nextStep2v2() {
    console.log("vào đây 33");
    console.log($("#sound_background_checkbox").val());
    $("#tab-2").removeClass("active");
    $("#tab-3").addClass("active");
    $("#ctn-2").hide();
    $("#ctn-3").show();
    $("#tab-3").click(function () {
        tabClick(3);
    });
}

function nextStep3() {
    console.log("vào đây 2");
    $("#tab-3").removeClass("active");
    $("#tab-4").addClass("active");
    $("#ctn-3").hide();
    $("#ctn-4").show();
    $("#tab-4").click(function () {
        tabClick(4);
    });
    $("#RegisterForm3[recording_file]")
    // $("$ctn-4").attr('onclick', 'tabClick(4)');

    $("#listenModal").modal('hide');
}

function nextStep4() {
    $('#try-modal').modal('show');
}

function test5() {
    $('#try-modal').modal('hide');
    $("#tab-4").removeClass("active");
    $("#tab-5").addClass("active");
    $("#ctn-4").removeAttr("style").hide();
    $("#ctn-5").removeAttr("style").show();
}

function userLogin() {
    $("#loginform-msisdn").val("");
    $("#loginform-password").val("");
    $("#loginform-captcha").val("");
    $("#login-error").hide();
    $(this).closest('form').find("input[type=text], textarea").val("");
    $.ajax({
        type: 'POST',
        url: 'login',
        success: function (data) {
            $("body").append(data)
            $('#loginModal').modal();
        }
    });
}


function userResetPassword() {

    $.ajax({
        type: 'POST',
        url: '/site/reset-password',
        success: function (data) {
            $('#changePasswordModal').html(data);
            $('#changePasswordModal').modal();
        }
    });
}

function resetPwd() {
    $('.close').click();
}

function userSignup() {
    // var checkModal = document.getElementById("modal_event_name");
    // console.log("AAAAAAAAAAAAAA",checkModal);
    $.ajax({
        type: 'POST',
        url: 'signup',
        success: function (data) {
            $("body").append(data)
            // $(this).closest('form').find("input[type=text], textarea").val("");
            console.log("vao day");
            $('#enteprise-msisdn').val("");
            $('#enteprise-password').val("");
            $('#enteprise-captcha').val("");
            $('#enteprise-full_name').val("");
            $('#enteprise-id_number').val("");
            $('#enteprise-email').val("");
            $('#repeat_password').val("");
            $('#enteprise-otp').val("");
            $('#signUpModalStep1').modal();
        }
    });
}

function backStep() {
    // alert('abc');
    // console.log($("#voice-content").val().length);
    $("#tab-1").addClass("active");
    $("#tab-2").removeClass("active");
    $("#ctn-1").show();
    $("#ctn-2").hide();

}

function backStep2() {

    $("#tab-4").removeClass("active");
    $("#tab-3").addClass("active");
    $("#ctn-4").hide();
    $("#ctn-3").show();

}

function backStep2v2() {
    console.log("vào đây 33");
    $("#tab-3").removeClass("active");
    $("#tab-2").addClass("active");
    $("#ctn-3").hide();
    $("#ctn-2").show();

}

function backStep3() {
    console.log("vào đây 2");
    $("#tab-4").removeClass("active");
    $("#tab-3").addClass("active");
    $("#ctn-3").hide();
    $("#ctn-4").show();
}

function nghethu() {
    var giongdoc = '';
    var playback_speed = '';
    var music_background = '';
    var request_background = $("#music-background").val();
    var recording_content = $("#voice-content").val();
    $('input[name="VoiceForm[giongdoc]"]:checked').each(function (e) {
        giongdoc = $(this).val();
    });

    $('input[name="VoiceForm[background]"]:checked').each(function (e) {
        music_background = $(this).prop("defaultValue");
    });

    $('input[name="VoiceForm[playback_speed]"]:checked').each(function (e) {
        playback_speed = $(this).val();
    });
    $.ajax({
        url: '/enterprise/get-voice',
        data: {
            request_background: request_background,
            giongdoc: giongdoc,
            content: recording_content,
            playback_speed: playback_speed,
            background: music_background,
            _csrf: $('meta[name="csrf-token"]').attr("content")
        },
        type: 'POST',
        dataType: "json",
        beforeSend: function () {
            $("#loadingModal").modal('show');
        },
        success: function (data) {
            console.log(data);
            $('#audio_play').attr('src', data.mp3dir);
            $("#loadingModal").modal('hide');


            if (data.code == 200) {
                $("input[name='RegisterForm3[recording_file]']").val(data.url);
                // $('input[name="RegisterForm3[recording_file]"]').val(data.url);
                console.log($("input[name='RegisterForm3[recording_file]']").val());
                $('#listenModal').modal('show');
            } else {
                alert(data.message);
            }
            return;
        }
    });
}


function toggleListen() {
    var audioElement = document.createElement('audio');

    $(".btn-listen").click(function () {
        audioElement.setAttribute('src', this.value);
        if ($(this).hasClass("listening")) { //Check current item has clicked
            console.log('vào đây sa');
            //1. Toggle selected
            $(this).toggleClass("listening");
            console.log(audioElement.pause());
            audioElement.pause();
        } else {
            console.log('vào đây trước');
            console.log(this.value);
            console.log(audioElement.play());
            audioElement.play();
            //1. Remove all class
            //$(".parent-menu li").removeClass("listening");
            $(".btn-listen").removeClass("listening");
            $(this).toggleClass("listening");
        }

    });
}

function toggleListen2() {
    var audioElement = document.createElement('audio');

    $(".hot-listen").click(function () {
        audioElement.setAttribute('src', $(this).attr('value'));
        if ($(this).hasClass("listening")) { //Check current item has clicked
            console.log('vào đây sa');
            //1. Toggle selected
            $(this).toggleClass("listening");
            $(this).addClass('mdi-play-circle');
            $(this).removeClass('mdi-stop-circle');
            console.log(audioElement.pause());
            audioElement.pause();
        } else {
            console.log('vào đây trước');
            audioElement.play();
            $(".hot-listen").removeClass("listening");
            $(this).addClass('mdi-stop-circle');
            $(this).removeClass('mdi-play-circle');
            $(this).toggleClass("listening");
        }

    });
}


function tabClick($id) {
    if ($("#voice-content").val().length < 650) {
        $("#less-character").show();
    } else if ($("#voice-content").val().length > 1200) {
        $("#more-character").show();
    } else {
        var arr = [1, 2, 3, 4, 5];
        $('#try-modal').modal('hide');
        var tab = "#tab-" + $id;
        var ctn = "#ctn-" + $id
        $(tab).addClass("active");
        $(ctn).removeAttr("style").show();

        $.each(arr, function (index, value) {
            if (value != $id) {
                var hideTab = "#tab-" + value;
                var hideCtn = "#ctn-" + value;
                $(hideTab).removeClass("active");
                $(hideCtn).removeAttr("style").hide();
            }
        });
    }

}


