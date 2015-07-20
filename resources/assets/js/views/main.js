module.exports = (function($) {

    $('[data-class]').hover(function(e) {
        $('.class__'+$(this).data('class')).addClass('hover')
    }, function(e) {
        $('.class__'+$(this).data('class')).removeClass('hover')
    });

});