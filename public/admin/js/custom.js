$(document).ready(function () {
    $("#sections").DataTable();
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
    // Confirm deletion with simple javascript
    // $(".confirm_delete").click(function () {
    //     let title = $(this).attr("title");
    //     if (confirm("Are you sure you want to delete this " + title + "?")) {
    //         return true;
    //     }
    //     return false;
    // });
    // Confirm delete using sweetalert2
    $(".confirm_delete").click(function (event) {
        event.preventDefault(); // Prevent default link behavior
        let title = $(this).attr("title");
        const deleteUrl = $(this).attr("href");

        Swal.fire({
            title: "Are you sure you want to delete this " + title + "?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user clicks "Yes," perform the delete action
                Swal.fire("Deleted!", "Your file has been deleted.", "success");

                // Perform the delete action by navigating to the delete URL
                window.location.href = deleteUrl;
            }
        });
    });
});
