$(document).ready(function () {
    $('.qty-input').on('input', function () {
        const qty = parseInt($(this).val());
        const cartId = $(this).data('id');
        const price = parseInt($(this).data('price'));
        const url = $(this).data('url');

        const subtotal = qty * price;
        $('#subtotal-' + cartId).text(new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(subtotal));

        $.post(url, {
            cart_id: cartId,
            qty: qty
        }, function (res) {
            const data = JSON.parse(res);
            if (data.status !== 'success') {
                alert('Gagal memperbarui qty');
            } else {
                // Update Price Detail bagian kanan
                $('#detail-qty-' + cartId).text(qty);
                $('#detail-subtotal-' + cartId).text(new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(subtotal));
                
                // Ambil total baru dari server
                $.get('customer/cart/getCartTotal', function(response) {
                    const totalData = JSON.parse(response);
                    $('#total-semua').text(new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(totalData.total));
                });
            }
        });
    });
});