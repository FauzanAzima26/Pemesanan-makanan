const baseUrl = $("#detail_pesanan-form").data("base-url");

const table = $(".detail_pesanan").DataTable({
	ajax: {
		url: $("#detail_pesanan-form").data("get-data-url"),
		type: "GET",
		dataSrc: "data",
	},
	columns: [
		{
			data: null,
			render: function (data, type, row, meta) {
				return meta.row + 1;
			},
		},
		{ data: "menu" },
		{
			data: "status",
			render: function (data) {
				let badgeClass = "badge bg-secondary";
				if (data === "paid") badgeClass = "badge bg-success";
				else if (data === "pending") badgeClass = "badge bg-warning text-dark";
				else if (data === "cancelled") badgeClass = "badge bg-danger";
				return `<span class="${badgeClass}">${data}</span>`;
			},
		},
		{ data: "total" },
		{ data: "payment" },
		{
			data: null,
			render: function (data, type, row) {
				return `<button class="btn btn-sm btn-primary detail" data-id="${row.id}">Detail</button>`;
			},
		},
	],
});

$(document).on("click", ".detail", function () {
	const orderId = $(this).data("id");

	$("#orderIdDisplay").text(orderId);
	$("#qrModalBody").html(`
		<div class="d-flex justify-content-center mb-3">
			<div class="spinner-border text-primary" role="status">
				<span class="visually-hidden">Memuat...</span>
			</div>
		</div>
	`);

	$("#qrModal").modal("show");

	// Pastikan tidak bind berkali-kali
	$("#qrModal").one("shown.bs.modal", function () {
		$("#qrModalBody").html(`
			<img src="${baseUrl}customer/qrcodetest/show/${orderId}" 
				class="img-fluid p-2 border rounded" 
				alt="QR Code Pesanan ${orderId}"
				style="max-width: 100%; height: auto;">
		`);
	});
});
