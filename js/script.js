$(document).ready(function() {
    $('#add-medicine-form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'dashboard.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                alert('Medicine added successfully');
                location.reload();
            }
        });
    });

    $('#sell-medicine-form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'dashboard.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                alert('Medicine sold successfully');
                location.reload();
            }
        });
    });

    $('.update-button').on('click', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');
        var stock = $(this).data('stock');
        $('#update-id').val(id);
        $('#update-name').val(name);
        $('#update-price').val(price);
        $('#update-stock').val(stock);
        $('#update-form').show();
    });
});
