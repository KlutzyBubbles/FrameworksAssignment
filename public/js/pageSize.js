$(document).ready(function() {
    $('.size-selector').change(function() {
        if (document.location.href.indexOf('?') !== -1) {
            document.location = document.location.href + "&size=" + $(this).val();
        } else {
            document.location = document.location.href + "?size=" + $(this).val();
        }
    });
});
