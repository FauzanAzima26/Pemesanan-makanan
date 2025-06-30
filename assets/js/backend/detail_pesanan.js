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
				let badgeClass = "";
				if (data === "paid") badgeClass = "badge bg-success";
				else if (data === "pending") badgeClass = "badge bg-warning text-dark";
				else if (data === "cancelled") badgeClass = "badge bg-danger";
				else badgeClass = "badge bg-secondary";

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

	$("#qrModalBody").html(`
        <p>Detail untuk pesanan ID: <strong>${orderId}</strong></p>
        <img src="${baseUrl}customer/qrcodetest/show/${orderId}" class="img-fluid" alt="QR Code">
    `);

	$("#qrModal").modal("show");
});
