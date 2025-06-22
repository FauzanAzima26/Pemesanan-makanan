$(document).ready(function () {
	const tableElement = document.getElementById("restaurant-data");
	const getDataUrl = tableElement.dataset.getDataUrl;
	const storeUrl = tableElement.dataset.storeUrl;

	const table = $("#restaurant-table").DataTable({
		ajax: {
			url: getDataUrl,
			type: "GET",
			dataSrc: "data",
		},
		columns: [
			{ data: "no" },
			{ data: "owner" },
			{ data: "name" },
			{ data: "address" },
			{ data: "status" },
			{
				data: "actions",
				orderable: false,
				searchable: false,
			},
		],
	});

	// Submit form (Add atau Update)
	$("#restaurant-form").on("submit", function (e) {
		e.preventDefault();
		const formData = $(this).serialize();

		$.ajax({
			url: storeUrl,
			type: "POST",
			data: formData,
			dataType: "json",
			success: function (response) {
				if (response.success) {
					Swal.fire("Berhasil", response.message, "success");
					$("#restaurant-form")[0].reset();
					bootstrap.Offcanvas.getInstance("#add-new-record").hide();
					table.ajax.reload(null, false);
					$(".data-submit").text("Submit");
				} else {
					Swal.fire("Gagal", response.message, "error");
				}
			},
			error: function () {
				Swal.fire("Error", "Terjadi kesalahan saat menyimpan data", "error");
			},
		});
	});

	// Saat klik tombol Edit
	$(document).on("click", ".edit", function () {
		const id = $(this).data("id");
		const editUrl = getDataUrl.replace("get_data", "edit");

		$.ajax({
			url: `${editUrl}?id=${id}`, // <-- gunakan query string
			type: "GET",
			dataType: "json",
			success: function (res) {
				if (res && res.id) {
					$("#id_restaurant").val(res.id);
					$("#owner").val(res.owner);
					$("#name").val(res.name);
					$("#address").val(res.address);
					$("#status").val(res.status);

					const offcanvas = new bootstrap.Offcanvas("#add-new-record");
					offcanvas.show();
					$(".data-submit").text("Update");
				} else {
					Swal.fire("Gagal", res.message || "Data tidak ditemukan", "error");
				}
			},
			error: function () {
				Swal.fire("Error", "Gagal mengambil data dari server", "error");
			},
		});
	});

	// Saat klik tombol Delete
	$(document).on("click", ".btn-danger", function () {
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
});
