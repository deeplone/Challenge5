/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('.voice-priority-update-actions').on('click', function () {
        var url = $(this).data('url');
        var action = $(this).data('action');
        var ids = [];
        var ids_checked = [];
        var priority = [];
        $('.epr-voices-index input[name="id[]').each(function(e) {
            ids.push(this.value);
        });
        $('.landingpage-index input[name="selection[]"]:checked').each(function(e) {
            ids_checked.push(this.value);
        });
        $('input[name="priority[]"]').each(function(e) {
            priority.push(this.value);
        });
        console.log(url);

        if(ids_checked.length > 0 || action == 'update') {
            if(confirm('Bạn có chắc chắn thực hiện thao tác này?')) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        'action': action,
                        'ids': ids,
                        'ids_checked': ids_checked,
                        'priority': priority,
                        '_csrf': $('meta[name="csrf-token"]').attr("content")
                    },
                    complete: function (result) {
                        window.location.reload();
                    }
                });
            }
        } else {
            alert('Vui lòng chọn ít nhất một đối tượng');
        }
    });

    $('body').on('change', 'input[name="tone-upload-file"]', function () {
        //e.preventDefault();
        var file_data = $(this).prop('files')[0];
        var ext = file_data.name.split('.').pop().toLowerCase();
        if ($.inArray(ext, ['mp3']) == -1) {
            alert('File không đúng định dạng (mp3).');
            $(this).val('');
            return false;
        }
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('_csrf', $('meta[name="csrf-token"]').attr("content"));
        $.ajax({
            url: '/profile/upload?id=' + $(this).attr('profile'),
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (data) {
                $(this).val('');
                if (data.error == 0) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            }
        });
    });

    document.addEventListener('play', function (e) {
        var audios = document.getElementsByTagName('audio');
        for (var i = 0, len = audios.length; i < len; i++) {
            if (audios[i] != e.target) {
                audios[i].pause();
            }
        }
    }, true);

    $('button[name="enterprise_approved"]').click(function () {
        var status = $(this).attr('status');
        $('#enterprisefile-status').val(status);
        $('form').submit();
    });

    $('#eprrecordingcontents-recording_content').on('keyup', function() {
        $('#counter-character').html('(' + this.value.length + '/1200)');
    });


});

function alert(message) {
    $.alert({
        title: '',
        content: message
    });
    return false;
}

