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
				data ? `<img src="${base_url + data}" width="50">` : "-",
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
document
	.getElementById("form-add-new-record")
	.addEventListener("submit", function (e) {
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

$(document).on("click", ".edit", function () {
	const id = $(this).data("id");

	$.ajax({
		url: base_url + "menu/edit/" + id,
		type: "GET",
		dataType: "json",
		success: function (response) {
			if (response.success) {
				const data = response.data;

				// Isi data ke form edit
				$("#edit-id").val(data.id);
				$("#edit-name").val(data.name);
				$("#edit-price").val(data.price);
				$("#edit-description").val(data.description);
				// Preview gambar jika ada
				if (data.image) {
					$("#preview-image")
						.attr("src", base_url + data.image)
						.show();
				} else {
					$("#preview-image").hide();
				}

				// Tampilkan offcanvas/modal edit
				const offcanvasEdit = new bootstrap.Offcanvas("#edit-record");
				offcanvasEdit.show();
			} else {
				Swal.fire("Gagal", response.message, "error");
			}
		},
		error: function () {
			Swal.fire("Error", "Gagal mengambil data untuk diedit", "error");
		},
	});
});
