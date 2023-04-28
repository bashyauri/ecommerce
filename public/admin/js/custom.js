$(document).ready(function () {
    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();
        // console.log("Current password: " + current_password);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: "check-admin-password",
            data: { current_password: current_password },
            success: function (response) {
                alert(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            },
        });
    });
});
