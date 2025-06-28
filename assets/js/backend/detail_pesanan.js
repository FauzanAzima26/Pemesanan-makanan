const table = $(".detail_pesanan").DataTable({
    ajax: {
        url: $("#detail_pesanan-form").data("get-data-url"), // misal: data-get-data-url="<?= base_url('detail_pesanan/get_data') ?>"
        type: "GET",
        dataSrc: "data",
    },
    columns: [
        {
            data: null,
            render: (data, type, row, meta) => meta.row + 1,
        },
        { data: "menu" },
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
        {
			data: null,
			render: (data, type, row) => `
                <button class="btn btn-sm btn-primary detail" data-id="${row.id}">Detail</button>
            `,
		},
    ]
});
