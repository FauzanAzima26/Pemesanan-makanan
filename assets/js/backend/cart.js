$(document).ready(function () {
	$(".qty-input").on("input", function () {
		const qty = parseInt($(this).val());
		const cartId = $(this).data("id");
		const price = parseInt($(this).data("price"));
		const url = $(this).data("url");

		const subtotal = qty * price;
		$("#subtotal-" + cartId).text(
			new Intl.NumberFormat("id-ID", {
				style: "currency",
				currency: "IDR",
				minimumFractionDigits: 0,
			}).format(subtotal)
		);

		$.post(
			url,
			{
				cart_id: cartId,
				qty: qty,
			},
			function (res) {
				const data = JSON.parse(res);
				if (data.status !== "success") {
					alert("Gagal memperbarui qty");
				} else {
					// Update Price Detail bagian kanan
					$("#detail-qty-" + cartId).text(qty);
					$("#detail-subtotal-" + cartId).text(
						new Intl.NumberFormat("id-ID", {
							style: "currency",
							currency: "IDR",
							minimumFractionDigits: 0,
						}).format(subtotal)
					);

					// Ambil total baru dari server
					$.get("customer/cart/getCartTotal", function (response) {
						const totalData = JSON.parse(response);
						$("#total-semua").text(
							new Intl.NumberFormat("id-ID", {
								style: "currency",
								currency: "IDR",
								minimumFractionDigits: 0,
							}).format(totalData.total)
						);
					});
				}
			}
		);
	});
});

$(document).on("click", ".btn-remove-item", function () {
	const btn = $(this);
	const cartId = btn.data("id");
	const url = btn.data("url");

	Swal.fire({
		title: "Yakin ingin menghapus?",
		text: "Item akan dihapus dari keranjang.",
		icon: "warning",
		showCancelButton: true,
		confirmButtonText: "Ya, hapus",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(url, { cart_id: cartId }, function (res) {
				const data = JSON.parse(res);
				if (data.status === "success") {
					Swal.fire("Berhasil", "Item dihapus.", "success").then(() => {
						location.reload(); // 🔁 reload setelah berhasil
					});
				} else {
					Swal.fire("Gagal", "Item tidak dapat dihapus.", "error");
				}
			}).fail(function () {
				Swal.fire("Error", "Terjadi kesalahan server.", "error");
			});
		}
	});
});
