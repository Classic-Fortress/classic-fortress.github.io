module.exports = (function($) {
    var tab = $('meta[name=activeTab]').attr('content').toLowerCase();
    $('.top-menu').find('.active').removeClass('active');
    $('[data-page=' + tab + ']').addClass('active');

    return tab;
});