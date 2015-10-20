$(document).ready(function () {
    console.log("PJAX Loader Checking In");
    $(document)
        .pjax('a', '#pjax-container')
        .on('submit', 'form', function (event) {
            $.pjax.submit(event, '#pjax-container')
        })
        .on('pjax:start', function () {
            console.log('fadeOut');
            $('#pjax-container').fadeOut(200);
        })
        .on('pjax:end', function () {
            console.log('FadeIn');
            $('#pjax-container').fadeIn(200);
        });
    ;
    console.log("PJAX Loader Checking Out");
});