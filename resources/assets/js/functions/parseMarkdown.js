module.exports = (function($) {
    var marked = require('marked');

    if ($('[markdown]').length) {
        $.each($('[markdown]'), function (i, element) {
            $(element).html(marked($(element).text(), {gfm: true}));
        })
    }

    if ($('[markdown-html]').length) {
        $.each($('[markdown-html]'), function (i, element) {
            $(element).html(marked($(element).html(), {gfm: true}));
        })
    }

});