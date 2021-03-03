$imgUrl = $("#rbthot-img_path").val();
$("#img-preview").attr("src", $imgUrl);

var upload_type = "";
var widthLg = $("#dataWidth").val();
var heightLg = $("#dataHeight").val();

var widthThumb = $("#dataWidthThumb").val();
var heightThumb = $("#dataHeightThumb").val();

// $("#large-img-preview").width(widthLg);
// $("#large-img-preview").height(heightLg);

// $("#thumb-img-preview").width(widthThumb);
// $("#thumb-img-preview").height(heightThumb);

window.addEventListener('load', function () {
    if(document.querySelector('input[id="thumb-img-upload"]')) {
        document.querySelector('input[id="thumb-img-upload"]').addEventListener('change', function () {
            if (this.files && this.files[0]) {
                var ext = this.files[0].name.split('.').pop().toLowerCase();
                if ($.inArray(ext, ['png', 'bmp', 'jpg']) == -1) {
                    alert('File không đúng định dạng (png, jpeg, jpg).');
                    return false;
                }
                if (this.files[0].size >= 1024 * 1024) {
                    alert('File "' + this.files[0].name + '" quá lớn. Kích cỡ tối đa phải < 1 MiB.');
                    return false;
                }

                document.querySelector("#thumb-image").src = URL.createObjectURL(this.files[0]); // set src to blob url
                $('#modal-thumb').modal('show');
            }
        });
    }

    if(document.querySelector('input[id="large-img-upload"]')) {
        document.querySelector('input[id="large-img-upload"]').addEventListener('change', function () {
            if (this.files && this.files[0]) {
                var ext = this.files[0].name.split('.').pop().toLowerCase();
                if ($.inArray(ext, ['png', 'bmp', 'jpg']) == -1) {
                    alert('File không đúng định dạng (png, jpeg, jpg).');
                    return false;
                }
                if (this.files[0].size >= 1024 * 1024) {
                    alert('File "' + this.files[0].name + '" quá lớn. Kích cỡ tối đa phải < 1 MiB.');
                    return false;
                }

                document.querySelector("#large-image").src = URL.createObjectURL(this.files[0]); // set src to blob url
                $('#modal-large').modal('show');
            }
        });
    }
});

window.addEventListener('DOMContentLoaded', function () {

    var imageLg = document.getElementById('large-image');
    var imateThm = document.getElementById('thumb-image');
    var cropBoxData;
    var canvasData;
    var cropper;
    // console.log($fileId);

    $('#modal-large').on('shown.bs.modal', function () {
        cropper = new Cropper(imageLg, {
            autoCropArea: 0.5,
            // width: widthLg,
            // height: heightLg,
            aspectRatio: widthLg / heightLg, 
            // dragMode: 'move',
            cropBoxMovable: true,
            zoomOnWheel : false,
            cropBoxResizable: false,
            minCropBoxWidth: widthLg,
            minCropBoxHeight: heightLg,
            ready: function () {
                //Should set crop box data first here
                cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
            }
        });
    }).on('hidden.bs.modal', function () {
        cropBoxData = cropper.getCropBoxData();
        canvasData = cropper.getCanvasData();
        cropper.destroy();
    });

    $('#modal-thumb').on('shown.bs.modal', function () {
        cropper = new Cropper(imateThm, {
            autoCropArea: 0.5,
            width: widthThumb,
            height: heightThumb,
            aspectRatio: widthThumb / heightThumb, 
            // dragMode: 'move',
            cropBoxMovable: true,
            zoomOnWheel : false,
            cropBoxResizable: false,
            minCropBoxWidth: widthThumb,
            minCropBoxHeight: heightThumb,
            ready: function () {
                //Should set crop box data first here
                cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
            }
        });
    }).on('hidden.bs.modal', function () {
        cropBoxData = cropper.getCropBoxData();
        canvasData = cropper.getCanvasData();
        cropper.destroy();
    });
    if(document.getElementById('crop-large')) {
        document.getElementById('crop-large').addEventListener('click', function () {
            // var initialAvatarURL;
            var canvas;

            // $modal.modal('hide');
            var formData = new FormData();
            if (cropper) {
                canvas = cropper.getCroppedCanvas({});
                initialAvatarURL = imageLg.src;
                imageLg.src = canvas.toDataURL();
                $id = getUrlParameter('id');
                var modelName = $(this).attr('data-model');
                // console.log($id);

                // console.log(imageLg.src);
                formData.append('blob', imageLg.src);
                formData.append('ext', 'png');
                formData.append('id', $id);
                formData.append('cropType', 'large');
                formData.append('modelName', 'rbt-hot');
                formData.append('_csrf', $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    url: '/rbt-hot/upload-img',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    complete: function (data) {

                        // console.log(this.files);
                        // console.log(data.responseText);
                        $('#modal-large').modal('hide');
                        // $("#large-img-preview").width(widthLg);
                        // $("#large-img-preview").height(heightLg);
                        $("#rbthot-img_path").val('../' + data.responseText);
                        $("#img-preview").attr("src", '../' + data.responseText);

                    }
                });
            }
        });
    }

    function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };


});

function deleteThumbPic() {
    $("#image_thumb_link").val('../uploads/media1/images/landing/default.png');
    $("#thumb-img-preview").attr("src", '../uploads/media1/images/landing/default.png');
}

function deleteLargePic() {
    $("#img-preview").val('../uploads/media1/images/landing/default.png');
    $("#img-preview").attr("src", '../uploads/media1/images/landing/default.png');
}
