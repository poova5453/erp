$(document).ready(function () {
    $("#myTable").DataTable();
});

$("#add").click(function () {
    const itemname = $("#itemname").val();
    const itemcode = $("#itemcode").val();
    const gst = $("#gst").val();
    const rate = $("#rate").val();
    const url = "/item";
    

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
            itemname: itemname,
            itemcode: itemcode,
            gst: gst,
            rate: rate
        }),
        success: function (data) {
            showToast("Item created successfully", true, 3000);
            $("#addForm")[0].reset();
            setTimeout(() => {
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            }, 3000);
        },
        error: function () {
            showToast("Failed to create item", false, 3000);
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
        itemname1 = $("#itemname1").val();
        itemcode1 = $("#itemcode1").val();
        gst1 = $("#gst1").val();
        rate1 = $("#rate1").val()

        $.ajax({
            url: `/item/${id1}`,
            type: "PUT",
            data: JSON.stringify({
                id: id1,
                itemname: itemname1,
                itemcode: itemcode1,
                gst: gst1,
                rate: rate1,
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
                        "Item Details Updated successfully",
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
                    showToast("Failed to update item Details", false, 3000);
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
    var item = $(this).data("id");

    $.ajax({
        url: `/item/${item}/edit`,
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
            $("#itemname1").val(val1.itemname);
            $("#itemcode1").val(val1.itemcode);
            $("#gst1").val(val1.gst);
            $("#rate1").val(val1.rate);
            $(".editModal").modal("show");
        },
    });
});

$(document).on("click", "#deletePost", function () {
    var item = $(this).data("id");

    if (confirm("Are you sure to delete this post?")) {
        $.ajax({
            url: `/item/${item}`,
            type: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            success: function (data) {
                showToast("Item Details Deleted successfully", true, 3000);
                $("#addForm")[0].reset();
                setTimeout(() => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                }, 3000);
            },
            error: function () {
                showToast("Failed to delete item Details", false, 3000);
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
