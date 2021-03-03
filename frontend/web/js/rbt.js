var audioRbt = new Audio();
var bar = null;
$(document).ready(function () {

    playAudioRbt();

    recordOnline();

    pjaxController();

    if($('textarea').hasClass('txtContent')) {
        $('#showCharater').html('Số lượng ký tự: ' + $(".txtContent").text().trim().length + '/1200');
    }

    $("#onlinerbtform-recording_content").select();
    $("#requestrbtform-recording_content").select();

    var failStep = $('.failStep').val();
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    if(urlParams.get('step')) {
        failStep = urlParams.get('step');
    }

    if(failStep == 3) {
        hideShowStep(3,2);
    } else if (failStep == 4) {
        hideShowStep(4,3);
    }

});

function clearErrorMsg() {
    $('.d-block').text("");
}

function recordOnline() {

    // $('#showCharater').html('Số lượng ký tự: ' + $(".txtContent").val().length + '/1200');
    $(document).on('keyup', '.txtContent', function () {
        $('#showCharater').html('Số lượng ký tự: ' + $(this).val().trim().length + '/1200');
    });

    $(document).on('change', 'input[type=radio][name=chooseExampleContent]', function () {
        $('.txtContent').val(this.value);
        $('.txtContent').focus();
        $('#showCharater').html('Số lượng ký tự: ' + this.value.trim().length + '/1200');
        $('#referenceModal').modal('hide');
    })

    $(document).on('click', '.btnChooseVoice', function () {
        $('.btnChooseVoice').removeClass('btn-blue-aqua-selected');
        $(this).addClass('btn-blue-aqua-selected');
        $('.valChooseVoice').val($(this).data('value'));
        $('.valChooseVoiceSave').val($(this).data('save'));
    });

    $(document).on('click', '.btnChooseSpeed', function () {
        $('.btnChooseSpeed').removeClass('btn-blue-aqua-selected');
        $(this).addClass('btn-blue-aqua-selected');
        $('.valChooseSpeed').val($(this).data('value'));
    });

    $(document).on('click', '.btnChooseMusic', function () {
        // if ($('input.btnChooseMusic').is(':checked')) {
        //     $('.valChooseMusic').val(1);
        // } else {
        //     $('.valChooseMusic').val(0);
        // }
        if($(this).hasClass('btn-blue-aqua-selected')) {
            $(this).removeClass('btn-blue-aqua-selected');
            $('.valChooseMusic').val(0);
            $('.valHideChooseMusic').val(null);
        } else {
            $('.btnChooseMusic').removeClass('btn-blue-aqua-selected');
            $(this).addClass('btn-blue-aqua-selected');
            $('.valChooseMusic').val(1);
            $('.valHideChooseMusic').val($(this).data('value'));
        }
    });

    $(document).on('click', '.btnChooseUseMusic', function () {
        if ($('input.btnChooseUseMusic').is(':checked')) {
            console.log("checked");
            $('.valChooseMusic').val(1);
        } else {
            console.log("un checked");
            $('.valChooseMusic').val(0);
        }
        // $('.btnChooseMusic').removeClass('btn-blue-aqua-selected');
        // $(this).addClass('btn-blue-aqua-selected');
        // $('.valChooseMusic').val(1);
    });

    if ($('#heart-path').length) {
        bar = new ProgressBar.Path('#heart-path', {
            easing: 'linear',
            duration: 100
        });
        bar.set(0);
    }
}

function playAudioRbt() {


    $('#listenModal').on('shown.bs.modal', function () {
        Amplitude.pause();
        audioRbt.pause();
        // will only come inside after the modal is shown
    });
    audioRbt.onended = function () {
        $('.btnPlayRbt').removeClass('listening');
    };

    audioRbt.onerror = function () {
        $('.btnPlayRbt').removeClass('listening');
    };

    $(document).on('click', '.btnPlayRbt:not(.listening)', function () {
        $('.btnPlayRbt').removeClass('listening');
        $(this).addClass('listening');
        audioRbt.src = $(this).data('value');
        audioRbt.play();
    });

    $(document).on('click', '.btnPlayRbt.listening', function () {
        $('.btnPlayRbt').removeClass('listening');
        audioRbt.pause();
    });
}

function goStepOnline(index, current) {
    Amplitude.pause();
    audioRbt.pause();
    $('.btnPlayRbt').removeClass('listening');
    runValidation(current);
    setTimeout(function () {
        hideShowStep(index, current);
    }, 500);
}

function backStepOnline(index, current) {
    Amplitude.pause();
    audioRbt.pause();
    $('.btnPlayRbt').removeClass('listening');
    setTimeout(function () {
        hideShowStepNoValidate(index, current);
    }, 500);
}

function runValidation(current) {
    $('#onlineStep' + current + ' .form-control').each(function (index) {
        if ($(this).attr('name')) {
            $('#formRecordOnline').yiiActiveForm('validateAttribute', $(this).attr('id'));
        }
    });
}

function hideShowStep(index, current) {
    console.log('error form ' + '$("#' + 'onlineStep' + current + ' .form-group.has-error")' + ' length: ' +
        $('#' + 'onlineStep' + current + ' .form-group.has-error').length);
    if ($('#' + 'onlineStep' + current + ' .form-group.has-error').length > 0) {
        return false;
    }
    if (index > 4) {
        $('.onlineStep').hide();
    } else {
        $('.onlineStep').hide();
        $('#' + 'onlineStep' + index).show();
        $('ul#onlineSelect li').removeClass('active');
        $('ul#onlineSelect li:eq(' + (index - 1) + ')').addClass('active');
    }
}

function hideShowStepNoValidate(index, current) {
    if (index > 4) {
        $('.onlineStep').hide();
    } else {
        $('.onlineStep').hide();
        $('#' + 'onlineStep' + index).show();
        $('ul#onlineSelect li').removeClass('active');
        $('ul#onlineSelect li:eq(' + (index - 1) + ')').addClass('active');
    }
}

function generateRbt(url) {
    $('#listenModal').modal({backdrop: 'static', keyboard: false});
    $('#listenModal .player-control').hide();
    $('#listenModal .btnNext').hide();
    $('#listenModal .loading').show();
    bar.set(0);
    $.post(url, {
        giongdoc: $('.valChooseVoice:first').val(),
        content: $('.txtContent:first').val(),
        playback_speed: $('.valChooseSpeed:first').val(),
        background: $('.valHideChooseMusic:first').val(),
        _csrf: $('meta[name="csrf-token"]').attr('content')
    }).done(function (data) {
        // data = JSON.parse(data);
        console.log(data);
        if (parseInt(data.code, 10) === 200) {
            Amplitude.init({
                'songs': [{'url': data.mp3dir, 'cover_art_url': '/images/cd.png'}],
                'callbacks': {
                    'timeupdate': function () {
                        var songPlayedPercentage = Amplitude.getSongPlayedPercentage();
                        if (bar && songPlayedPercentage) {
                            bar.animate(songPlayedPercentage / 100);
                        }
                    },
                    'ended': function () {
                        bar.set(1);
                        setTimeout(bar.animate(0), 4000);
                    }
                }
            });
            $('#listenModal .player-control').show();
            $('#listenModal .btnNext').show();
            $('#listenModal .loading').hide();
            $('.valRecordingFile').val(data.url);
        } else {
            $('#listenModal').modal('hide');
            alert(data.message);
        }
    }).fail(function (xhr, status, error) {
        console.log('xhr');
        console.log(xhr);
        console.log('status');
        console.log(status);
        console.log('error');
        console.log(error);
    });
}


function uploadAns(element) {

        var fd = new FormData();
        var files = $(element).closest('div').children('#file')[0].files;
        var id = $(element).closest('div').children("#exce-id").val();
        // Check file selected or not
        if (files.length > 0) {
            fd.append('file', files[0]);
            fd.append('id', id);

            $.ajax({
                url: '/epc-class/upload-answer',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    if (response == "success") {
                        alert("Upload file thành công");
                        location.reload();
                    } else {
                        alert('Upload file không thành công');
                    }
                },
            });
        } else {
            alert("Please select a file.");
        }
}
