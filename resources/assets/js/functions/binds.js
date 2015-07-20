module.exports = (function($) {
    var calcHeight = require('./calcContentHeight')($);
    var box        = require('./openLoginBox');

    $(window).on('resize', calcHeight);

    // Wiki sidebar button
    var target = $('.wiki-sidebar');

    $('.toggle-wiki-sidebar').click(function () {
        if (target.hasClass('hidden')) {
            target.removeClass('hidden').css({
                right: -($('.wiki-sidebar').outerWidth() + 10)
            });
            $('.content').css({minHeight: target.outerHeight()});
        }
        else {
            target.addClass('hidden');
            calcHeight();
        }
    }.bind(this));

    // Login
    $('.login').on('click', function (e) {
        box(true, $);
        e.preventDefault();
    }.bind(box))

});