$(document).ready(function () {
    //Check admin password is correct
    $("current_password").keyup(function () {
        var current_password = $("#current_password").val();
        alert(current_password);
    });
});
