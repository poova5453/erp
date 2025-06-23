$(document).ready(function () {
    $("#myTable").DataTable();
});

$("#add").click(function () {
    const name = $("#username").val();
    const email = $("#email").val();
    const mobile = $("#mobile").val();
    const address = $("#address").val();
    const gst = $("#gst").val();
    const url = "/customer";

    $.ajax({
        url: url,
        method: "post",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        data: JSON.stringify({
            name: name,
            email: email,
            mobile: mobile,
            address: address,
            gst: gst,
        }),
        success: function (data) {
            showToast("Customer created successfully", true, 3000);
            $("#addForm")[0].reset();
            setTimeout(() => {
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            }, 3000);
        },
        error: function () {
            showToast("Failed to create customer", false, 3000);
            setTimeout(() => {
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            }, 3000);
        },
    });
});
$(document).ready(function () {
    $(document).on("click", ".update", function (e) {
        e.preventDefault();

        id1 = $("#id1").val();
        console.log(id1);
        name1 = $("#name1").val();
        email1 = $("#email1").val();
        mobile1 = $("#mobile1").val();
        address1 = $("#address1").val();
        gst1 = $("#gst1").val();

        $.ajax({
            url: `/customer/${id1}`,
            type: "PUT",
            data: JSON.stringify({
                id: id1,
                name: name1,
                email: email1,
                mobile: mobile1,
                address: address1,
                gst: gst1,
            }),
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            success: function (data) {
                setTimeout(() => {
                    showToast(
                        "Customer Details Updated successfully",
                        true,
                        3000
                    );
                }, 0);
                $("#addForm")[0].reset();

                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            },
            error: function () {
                setTimeout(() => {
                    showToast("Failed to update customer Details", false, 3000);
                }, 0);

                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            },
        });
    });
});

$(document).on("click", ".editpost", function (e) {
    e.preventDefault();
    var customer = $(this).data("id");

    $.ajax({
        url: `/customer/${customer}/edit`,
        type: "GET",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        success: function (data) {
            var val = JSON.stringify(data);

            var val1 = JSON.parse(val);

            $("#id1").val(val1.id);
            $("#name1").val(val1.name);
            $("#email1").val(val1.email);
            $("#mobile1").val(val1.mobile);
            $("#address1").val(val1.address);
            $("#gst1").val(val1.gst);
            $(".editModal").modal("show");
        },
    });
});

$(document).on("click", "#deletePost", function () {
    var customer = $(this).data("id");

    if (confirm("Are you sure to delete this post?")) {
        $.ajax({
            url: `/customer/${customer}`,
            type: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            success: function (data) {
                showToast("Customer Details Deleted successfully", true, 3000);
                $("#addForm")[0].reset();
                setTimeout(() => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                }, 3000);
            },
            error: function () {
                showToast("Failed to delete customer Details", false, 3000);
                setTimeout(() => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                }, 3000);
            },
        });
    }
});
// function showToast(message, isSuccess = true, duration = 3000) {
//     const toastEl = document.getElementById("toastMessage");
//     const toastBody = document.getElementById("toast-body");

//     // Set the message and styling
//     toastBody.innerText = message;
//     toastEl.classList.remove("bg-success", "bg-danger");
//     toastEl.classList.add(isSuccess ? "bg-success" : "bg-danger");

//     // Show the toast using Bootstrap's API
//     const toast = new bootstrap.Toast(toastEl);
//     toast.show();
// }
function showToast(message, isSuccess = true, duration = 3000) {
    const toastEl = document.getElementById("toastMessage");
    const toastBody = document.getElementById("toast-body");

    // Set the message and styling
    toastBody.innerText = message;
    toastEl.classList.remove("bg-success", "bg-danger");
    toastEl.classList.add(isSuccess ? "bg-success" : "bg-danger");

    // Create or get Bootstrap Toast instance with options
    const toast = bootstrap.Toast.getOrCreateInstance(toastEl, {
        autohide: true,
        delay: duration,
    });

    toast.show();
}
