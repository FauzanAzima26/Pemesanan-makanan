// File: assets/js/backend/menu.js

$(document).ready(function () {
	const tableElement = document.getElementById("menu-data");
	const getDataUrl = tableElement.dataset.getDataUrl;
	const storeUrl = tableElement.dataset.storeUrl;

	const table = $("#menu-table").DataTable({
		ajax: {
			url: getDataUrl,
			type: "GET",
			dataSrc: "data",
		},
		columns: [
			{ data: "no" },
			{ data: "restaurant_name" },
			{ data: "name" },
			{ data: "price" },
			{ data: "description" },
			{
				data: "image",
				render: function (data) {
					return `<img src="${data}" width="60"/>`;
				},
			},
			{
				data: null,
				orderable: false,
				searchable: false,
				render: function (data, type, row) {
					return `
						<button class="btn btn-icon btn-warning btn-sm edit" data-id="${row.id}" title="Edit">
							<i class="ti ti-pencil"></i>
						</button>
						<button class="btn btn-icon btn-danger btn-sm delete" data-id="${row.id}" title="Delete">
							<i class="ti ti-trash"></i>
						</button>`;
				},
			},
		],
	});

	// Submit form
	$("#menu-form").on("submit", function (e) {
		e.preventDefault();
		const form = $(this)[0];
		const formData = new FormData(form);

		$.ajax({
			url: storeUrl,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "json",
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

	// Edit
	$(document).on("click", ".edit", function () {
		const id = $(this).data("id");
		const editUrl = getDataUrl.replace("get_data", "edit");

		$.ajax({
			url: `${editUrl}?id=${id}`,
			type: "GET",
			dataType: "json",
			success: function (res) {
				if (res && res.id) {
					$("#id_menu").val(res.id);
					$("#restaurant_id").val(res.restaurant_id);
					$("#name").val(res.name);
					$("#price").val(res.price);
					$("#description").val(res.description);

					const offcanvas = new bootstrap.Offcanvas("#add-new-record");
					offcanvas.show();
				} else {
					Swal.fire("Gagal", res.message || "Data tidak ditemukan", "error");
				}
			},
			error: function () {
				Swal.fire("Error", "Gagal mengambil data dari server", "error");
			},
		});
	});

	// Delete
	$(document).on("click", ".delete", function () {
		const id = $(this).data("id");

		Swal.fire({
			title: "Yakin ingin menghapus?",
			text: "Data yang dihapus tidak dapat dikembalikan!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#d33",
			cancelButtonColor: "#3085d6",
			confirmButtonText: "Ya, hapus!",
			cancelButtonText: "Batal",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: getDataUrl.replace("get_data", "delete"),
					type: "POST",
					data: { id: id },
					dataType: "json",
					success: function (response) {
						if (response.success) {
							Swal.fire("Berhasil", response.message, "success");
							table.ajax.reload(null, false);
						} else {
							Swal.fire("Gagal", response.message, "error");
						}
					},
					error: function () {
						Swal.fire(
							"Error",
							"Terjadi kesalahan saat menghapus data",
							"error"
						);
					},
				});
			}
		});
	});

	const menuData = document.getElementById("menu-data");
	const restaurantUrl = menuData.dataset.restaurantUrl;

	function loadRestaurants() {
		$.ajax({
			url: restaurantUrl,
			type: "GET",
			dataType: "json",
			success: function (data) {
				const select = $("#restaurant_id");
				select.empty().append('<option value="">-- Pilih Restoran --</option>');
				data.forEach((resto) => {
					select.append(`<option value="${resto.id}">${resto.name}</option>`);
				});
			},
			error: function () {
				console.error("Gagal memuat daftar restoran.");
			},
		});
	}

	$(document).ready(function () {
		loadRestaurants();
	});
});
