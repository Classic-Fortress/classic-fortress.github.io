module.exports = function(open, $) {
    if (window.location.hash == '#login' || open == true) {

        var tar = $('.account');
        if (tar.hasClass('hidden')) {
            tar.removeClass('hidden');
            $("html, body").animate({scrollTop: tar.position().top - 54}, "slow");
        } else {
            tar.addClass('hidden');
        }

    }
};