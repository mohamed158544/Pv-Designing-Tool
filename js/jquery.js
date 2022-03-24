$(document).ready(function () {

    $('placeholder').on('focus' ,function () {
        $(this).attr('data' , $(this).attr('placeholder'));
        $(this).attr('placeholder' , '');

    }).on('blur' , function () {
        $(this).attr('placeholder' , $(this).attr('data'))
    });

});



