var picture;
var changed = false;
var element = $('#real-dropzone');
var dropzone;
Dropzone.autoDiscover = false;
$(function() {
    dropzone = new Dropzone('#real-dropzone', {
        uploadMultiple: false,
        maxFilesize: 2,
        previewsContainer: false,
        addRemoveLinks: true,
        // The setting up of the dropzone
        init:function() {
            this.on('addedfile', function(file) {
                console.log(file);
            });
        },
        error: function(file, response) {
            errorShow(response);
        },
        success: function(file, done) {
            changed = true;
            if (picture)
                changePic(picture);
            $('img')[0].src = done.imageUrl;
            picture = done.uid;         
        }
    });
});

$(window).on('beforeunload', function(e){
    // console.log(e);
    if (changed) 
    {
        changePic(picture);
        $.cookie('uidPic', picture);
    }
});
$(window).on('load', function(e){
    // console.log(e);
    picture = $.cookie('uidPic');
    if (picture) changePic(picture);
});

var changePic = function(uid) {
    if (!changed) return;
    $.ajax({
        url: 'upload/delete',
        type: 'POST',
        async: false,
        dataType: 'html',
        data: {'uid': uid, _token: $('meta[name="csrf-token"]').attr('content')},
    })
    .error(function(file, response) {
        // errorShow(response);
    });
    picture = null;
    $.cookie('uidPic', picture);
}

var errorShow = function(text) {
    return;
    var newWindow = window.open();
    newWindow.document.write(text);
}
