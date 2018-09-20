$(document).ready(function() {
   /* document.location.href = document.location.href.replace(/&?size=([^&]$|[^&]*)/ig, "");
    document.location.href = document.location.href.replace(/&?show_trashed=([^&]$|[^&]*)/ig, "");*/
    $('.size-selector').change(function() {
        let url = document.location.href
            .replace(/[&?]?show_trashed=([^&]$|[^&]*)/ig, '')
            .replace(/[&?]?size=([^&]$|[^&]*)/ig, '')
            .replace(/[&?]*$/ig, '');
        if (url.indexOf('?') !== -1) {
            document.location = url + "&size=" + $(this).val();
        } else {
            document.location = url + "?size=" + $(this).val();
        }
    });
    $('[data-toggle="tooltip"]').tooltip({boundary: 'window'});
    $('.show-trashed').click(function() {
        let url = document.location.href
            .replace(/[&?]?show_trashed=([^&]$|[^&]*)/ig, '')
            .replace(/[&?]?size=([^&]$|[^&]*)/ig, '')
            .replace(/[&?]*$/ig, '');
        if (url.indexOf('?') !== -1) {
            document.location = url + "&show_trashed=" + $('#show-trashed').is(':checked');
        } else {
            document.location = url + "?show_trashed=" + $('#show-trashed').is(':checked');
        }
    });
    $('.row-link').click(function() {
       document.location = $(this).data('href');
    });
    $('.select-change').on('change', function() {
        $($(this).data('ref')).val($(this).val());
    });
});
