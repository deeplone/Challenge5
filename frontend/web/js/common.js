var isSendingOtp = false;

function resendOtp($url, $msisdn) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $('.lblSentStatus').html('Đang thực hiện gửi mã xác thực OTP');
    $('.popup-loading').show();
    $('.help-block').hide();
    $('#confirmregisterform-otp').val('');
    $('#otpconfirmform-otp').val('');
    $('.btnResendOtp').addClass('isDisabled');
    if (isSendingOtp) {
        console.log('resendOtp already sending request OTP!');
        return false;
    }
    isSendingOtp = true;
    $.post($url, {
        _csrf: csrfToken,
        'msisdn': $msisdn
    }).done(function (data) {
        $('.lblSentStatus').html(data['message']);
        $('.btnResendOtp').removeClass('isDisabled');
        $('.popup-loading').hide();
        isSendingOtp = false;
    }).fail(function (xhr, status, error) {
        $('.lblSentStatus').html('Có lỗi khi gửi mã xác thực');
        $('.btnResendOtp').removeClass('isDisabled');
        $('.popup-loading').hide();
        isSendingOtp = false;
    });
}

function pjaxController() {
    $(document).on('pjax:send', function () {
        $('.btnPopupSubmit').attr("disabled", true);
        $('.was-validated').hide();
        $('.popup-loading').show();
    })
    $(document).on('pjax:complete', function () {
        $('.btnPopupSubmit').removeAttr("disabled");
        $('.popup-loading').hide();
    })
}

function readMore($url) {
    window.open($url, 'popup-example', 'height='+window.innerheight+',width='+window.innerwidth+'resizable=no')
}


$(document).ready(function(){

    var temp = null;
    let audioElements = document.getElementsByTagName('audio');
    for (let i = 0; i < audioElements.length; i++) {
        audioElements[i].onplaying = (element) => {
            if(temp && temp !== audioElements[i]) {
                temp.pause();
            }
            temp = audioElements[i];
        }
    }

    $('span.dropdown-toggle').keypress(function(e) {
        if (e.keyCode == 13) {
            $('span.dropdown-toggle').click();
        }
    });
    $('.dropdown-item').keypress(function(e) {
        if (e.keyCode == 13) {
            $('.dropdown-item').click();
        }
    });

    $('input[type=file]').change(function(e) {
        var id = e.target.id.split("-")[1];
        console.log(e.target.id);
        if(e.target.files[0]) {
            var fileName = e.target.files[0].name;
            if(fileName.length > 21) {
                fileName = fileName.trim();
                fileName = fileName.substring(0, 6) + "..." + fileName.substring(e.target.files[0].name.length - 9, e.target.files[0].name.length);
            }
            if(id === "recording_file") {
                $("#btn-recording_file").text(fileName);
            }
            if(id === "copyright_license") {
                $("#btn-copyright_license").text(fileName);
            }
            if(id === "msisdn_file") {
                $("#btn-msisdn_file").text(fileName);
            }
        } else {
            if(id === "recording_file") {
                $("#btn-recording_file").text("Attach file");
            }
            if(id === "copyright_license") {
                $("#btn-copyright_license").text("Attach file");
            }
            if(id === 'msisdn_file') {
                $('#btn-msisdn_file').text('Attach file');
            }
        }
    });

    $("#close-payment-sc").click(function () {
        $(location).attr('href', '/home')
    })

});
