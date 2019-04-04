$(document).ready(function () {
    $('div.chooser a').on('click', function (event) {
        event.preventDefault();
        var item = $(this);
        var lat = item.attr('data-latitude');
        var lng = item.attr('data-longitude');
        map.setCenter([lat, lng], 8);
    });
});