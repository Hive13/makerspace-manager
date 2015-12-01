function loadPageFunctions() {
    $('.javascript-function').each(function (index, element) {
        var pageFunction = $(element).attr('data-function').toString();
        var fn = window[pageFunction];
        if (typeof fn === "function") {
            console.log('Applying' + pageFunction);
            fn.apply(null, [element]);
        }
    });
}

$(document).ready(function () {
    loadPageFunctions();
    $(document)
        .pjax('a', '#pjax-container')
        .on('submit', 'form', function (event) {
            $.pjax.submit(event, '#pjax-container')
        })
        .on('pjax:start', function () {
            $('#pjax-container').fadeOut(100);
        })
        .on('pjax:end', function () {
            pageFunction = "";
            $('#pjax-container').fadeIn(100);
            loadPageFunctions();
        });
});