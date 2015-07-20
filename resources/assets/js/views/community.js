module.exports = (function($, tab) { if(tab == 'community') {
    var marked = require('marked');

    var forum = {

        init: function() {
            this.enableRating();
            this.enablePreview();
        },

        enableRating: function() {
            $('.rating a[asyncpost]').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: $(this).attr('href'),
                    data: $(this).data('data'),
                    headers: { 'X-CSRF-TOKEN' : $('meta[name=csrf]').attr('content')},
                    success: function(data) {
                        $(this).parent().find('.number').html(data.rating)
                    }.bind(this)
                });
            })
        },

        enablePreview: function() {

            $('[mdpreview]').focus(function (e) {
                var el = $(this);

                if(! el.parent().find('[name=preview]').is(':checked')) return false;

                $('<div/>', {
                    class: 'mdpreview'
                }).appendTo(el.closest('.module'));

                $('<div/>', {
                    class: 'mdpreview__content',
                    html: marked($('[mdpreview]').val())
                }).appendTo($('.mdpreview'));

                if(el.closest('.module').hasClass('fixed')) {
                    $('.mdpreview').addClass('fixed');
                }

            }).focusout(function (e) {
                $('.mdpreview').remove();
            }).keyup(function (e) {
                $('.mdpreview>.mdpreview__content').html(marked($('[mdpreview').val())).scrollTop(10000);
            });


        }
    };

    forum.init();
}});