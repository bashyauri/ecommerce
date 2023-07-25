$(document).ready(function () {
    new DataTable("#sections");
    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");
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
                if (response === "false") {
                    $("#check_password").html(
                        "<font color='red'>Current Password is incorrect!</font>"
                    );
                } else if (response === "true") {
                    $("#check_password").html(
                        "<font color='green'>Current Password is Correct!</font>"
                    );
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            },
        });
    });
    // Update Admin Status
    $(document).on("click", ".updateAdminStatus", function () {
        let status = $(this).children("i").attr("status");
        let adminId = $(this).attr("admin_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: "/admin/update-admin-status",
            data: { status: status, adminId: adminId },
            success: function (response) {
                if (response["status"] === 0) {
                    $("#admin-" + adminId).html(
                        '<i style="font-size:25px;" class="mdi mdi-bookmark-outline" status="Inactive"></i>'
                    );
                } else if (response["status"] === 1) {
                    $("#admin-" + adminId).html(
                        '<i style="font-size:25px;" class="mdi mdi-bookmark-check" status="Active"></i>'
                    );
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            },
        });
    });
    //
    $(document).on("click", ".updateSectionStatus", function () {
        let status = $(this).children("i").attr("status");
        let sectionId = $(this).attr("section_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: "/admin/update-section-status",
            data: { status: status, sectionId: sectionId },
            success: function (response) {
                if (response["status"] === 0) {
                    $("#section-" + sectionId).html(
                        '<i style="font-size:25px;" class="mdi mdi-bookmark-outline" status="Inactive"></i>'
                    );
                } else if (response["status"] === 1) {
                    $("#section-" + sectionId).html(
                        '<i style="font-size:25px;" class="mdi mdi-bookmark-check" status="Active"></i>'
                    );
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            },
        });
    });
});
