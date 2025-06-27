const table = $(".order").DataTable({
	ajax: {
		url: $("#order-form").data("get-data-url"),
		type: "GET",
		dataSrc: "data",
	},
	columns: [
		{
			data: null,
			render: (data, type, row, meta) => meta.row + 1,
		},
		{ data: "pemesan" },
		{
			data: "status",
			render: function (data, type, row) {
				let badgeClass = '';
				if (data === 'paid') badgeClass = 'badge bg-success';
				else if (data === 'pending') badgeClass = 'badge bg-warning text-dark';
				else if (data === 'cancelled') badgeClass = 'badge bg-danger';
				else badgeClass = 'badge bg-secondary';

				return `<span class="${badgeClass}">${data}</span>`;
			}
		},
		{ data: "total" },
		{ data: "payment" },
	]
});
