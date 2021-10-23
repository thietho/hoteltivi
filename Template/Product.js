$(document).ready(function () {
    $('.tab-item').click(function () {
        var target = $(this).attr('data-target')
        $('.tab-pane').removeClass('active');
        $(target).addClass('active');
    });
});
