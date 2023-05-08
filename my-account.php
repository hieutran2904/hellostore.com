<?php
include('app/Controllers/View.php');
$view = new View();
$view->loadContent("include", "session");
$view->loadContent('include', 'top');
$view->loadContent('content', 'my-account');
$view->loadContent('include', 'tail');
?>

<script>
    $('.view-detail').click(function(e) {
        e.preventDefault();
        let order_id = $(this).data('itemid');
        console.log(order_id);
        $.ajax({
            url: 'app/Handle/loadOrderItems.php',
            type: 'POST',
            data: {
                order_id: order_id,
            },
            success: function(data) {
                $('#load-order-items').html(data);
            }
        });
    });
    $('#btn-submit-review').click(function(e) {
        e.preventDefault();
        console.log("click submit");
        $('#popup-main').removeClass('popup-main');
        $('#popup').removeClass('open-popup');
        $('#backdrop').removeClass('backdrop');
    });
    $('#close-popup').click(function(e) {
        e.preventDefault();
        console.log("click close");
        $('#popup-main').removeClass('popup-main');
        $('#popup').removeClass('open-popup');
        $('#backdrop').removeClass('backdrop');
    });
</script>