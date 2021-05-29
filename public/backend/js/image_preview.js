$(function() {
    'use strict';

    var changePicture = $('#change-picture'),
        userAvatar = $('.user-avatar');

    // Change Picture
    if (changePicture.length) {
        $(changePicture).on('change', function(e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function() {
                if (userAvatar.length) {
                    userAvatar.attr('src', reader.result);
                }
            };
            reader.readAsDataURL(files[0]);
        });
    }
});