<?php
include('app/Controllers/View.php');
$view = new View();
$view->loadContent("include", "session");
$view->loadContent('include', 'top');
$view->loadContent('content', 'checkout');
$view->loadContent('include', 'tail');
?>
<script>
    $('#payment-cod').click(function(e) {
        e.preventDefault();
        console.log("test");
        $('.choice-payment-cod').html("Thanh toán khi nhận hàng!");
    });
</script>