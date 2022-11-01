$(function () {
    // feedback
    $('form').submit(function () {
        var name = $('input[name=name]').val();
        var email = $('input[name=email]').val();
        var message = $('textarea[name=message]').val();
        if (name == '' || email == '' || message == '') {
            alert('Լրացրեք պարտադիր լրացման դաշտերը - *');
            return false;
        }
    });
});