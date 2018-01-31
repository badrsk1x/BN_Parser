$(function() {
    // If the cookie is not already set
    if (document.cookie.indexOf('js') < 0) {
        $.ajax({
            method: 'POST',
            url: '/javascript-enabled.php'
        });
    }
});