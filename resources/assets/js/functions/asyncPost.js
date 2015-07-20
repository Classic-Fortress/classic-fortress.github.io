module.exports = (function($) { if($('[asyncpostd]').length) {

    $.each($('[asyncpost]'), function (i, element) {
        $(element).on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: $(this).attr('href'),
                data: $(this).data('data'),
                headers: { 'X-CSRF-TOKEN' : $('meta[name=csrf]').attr('content')},
                success: function(data) {

                }
            });
        })
    })

}})