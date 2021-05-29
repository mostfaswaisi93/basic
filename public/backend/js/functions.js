// CKEDITOR Language
$(document).ready(function() {
    CKEDITOR.config.language = "{{ app()->getLocale() }}";
});

// Footer Year
document.getElementById("year").innerHTML = new Date().getFullYear();

// File Upload
function FileUpload() {
    event.preventDefault();
    document.getElementById("image").click();
}

// Icon Upload
function IconUpload() {
    event.preventDefault();
    document.getElementById("icon").click();
}

// DataTable Language
function getDataTableLanguage() {
    var lang = $('html').attr('lang');
    return '//cdn.datatables.net/plug-ins/1.10.22/i18n/' + lang + '.json';
}

// Feather Icon
$(window).on('load', function() {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }
});

(function(window, document, $) {
    'use strict';
    // Flatpickr
    var basicPickr = $('.flatpickr-basic');

    // Default
    if (basicPickr.length) {
        basicPickr.flatpickr();
    }
})(window, document, jQuery);