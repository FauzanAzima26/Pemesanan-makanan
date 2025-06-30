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

// Reset form saat klik "Add New"
$(".btn[data-bs-target='#add-new-record']").on("click", function () {
	const form = $("#form-add-new-record")[0];
	form.reset();
	$("#id_menu").val("");
	$("#old_image").val("");
	$("#image").prop("required", true);
	$("#preview-image").hide();
});

// Submit handler (store atau update)
$("#form-add-new-record").on("submit", function (e) {
	e.preventDefault();
	const form = this;
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
				$("#id_menu").val("");
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

// Event klik tombol Edit
$(document).on("click", ".edit", function () {
	const id = $(this).data("id");

	$.ajax({
		url: base_url + "menu/get_data",
		type: "GET",
		data: { id: id },
		dataType: "json",
		success: function (response) {
			if (!response.error) {
				$("#id_menu").val(response.id_menu);
				$("#name").val(response.name);
				$("#price").val(response.price);
				$("#description").val(response.description);
				$("#image").prop("required", false); // tidak wajib saat edit

				if (response.image) {
					$("#old_image").val(response.image);
					$("#preview-image")
						.attr("src", base_url + response.image)
						.css("max-width", "100px")
						.show();
				} else {
					$("#old_image").val("");
					$("#preview-image").hide();
				}

				const offcanvas = new bootstrap.Offcanvas("#add-new-record");
				offcanvas.show();
			} else {
				Swal.fire("Gagal", response.error, "error");
			}
		},
		error: function () {
			Swal.fire("Error", "Gagal mengambil data", "error");
		},
	});
});
