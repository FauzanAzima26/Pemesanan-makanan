const base_url = $("#menu-form").data("base-url");

const table = $(".menuu").DataTable({
    ajax: {
        url: $("#menu-form").data("get-data-url"),
        type: "GET",
        dataSrc: "data",
    },
    columns: [
        {
            data: null,
            render: (data, type, row, meta) => meta.row + 1,
        },
        { data: "name" },
        { data: "price" },
        { data: "description" },
        {
            data: "image",
            render: (data) =>
                data ? `<img src="${base_url + data}" width="50">` : '-',
        },
        {
            data: null,
            render: (data, type, row) => `
                <button class="btn btn-sm btn-warning edit" data-id="${row.id}">Edit</button>
                <button class="btn btn-sm btn-danger delete" data-id="${row.id}">Delete</button>
            `,
        },
    ],
});

// Submit handler
document.getElementById("form-add-new-record").addEventListener("submit", function (e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    $.ajax({
        url: $("#menu-form").data("store-url"),
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success) {
                Swal.fire("Berhasil", response.message, "success");
                form.reset();
                bootstrap.Offcanvas.getInstance("#add-new-record").hide();
                table.ajax.reload(null, false);
            } else {
                Swal.fire("Gagal", response.message, "error");
            }
        },
        error: function () {
            Swal.fire("Error", "Terjadi kesalahan saat menyimpan data", "error");
        },
    });
});
