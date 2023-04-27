$(document).ready(function () {
    //Check admin password is correct
    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();
        $.ajax({
            type: "post",
            url: "/admin/check-current-password",
            data: { current_password: current_password },
            success: function (resp) {
                alert(resp);
            },
            error: function (err) {
                alert("Error:");
            },
        });
    });
});
