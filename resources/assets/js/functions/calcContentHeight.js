module.exports = function($) {
    var minus = 0, height = $('body').outerHeight();
    $('.content-container').children().each(function (i, element) {
        if (!$(element).hasClass('content')) {
            minus += parseInt($(element).outerHeight(true));
        }
    });

    var headerHeight = $('header').is(':visible') ? 297:0;

    $('.content').css({minHeight: ((height - minus) - headerHeight)})
}