<?php
include('app/Controllers/View.php');
$view = new View();
$view->loadContent("include", "session");
$view->loadContent('include', 'top');
$view->loadContent('content', 'my-account');
$view->loadContent('include', 'tail');
?>

<script>
    var order_id = 0;
    $('.view-detail').click(function(e) {
        e.preventDefault();
        order_id = $(this).data('itemid');
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

    var starValue = sessionStorage.getItem("rating_session");
    const stars = document.querySelectorAll('.stars-rating');
    stars.forEach(star => {
        star.addEventListener('click', function() {
            starValue = star.value;
            console.log("Rating: " + starValue);
        });
    });

    $('#btn-submit-review').click(function(e) {
        e.preventDefault();
        console.log("click submit");
        $('#popup-main').removeClass('popup-main');
        $('#popup').removeClass('open-popup');
        $('#backdrop').removeClass('backdrop');
        $.ajax({
            url: 'app/Handle/addReview.php',
            type: 'POST',
            data: {
                order_id: order_id,
                product_sc_id: sessionStorage.getItem("product_sc_id_review"),
                review_detail: $('#review-detail').val(),
                id_reivew_check: $('#idReviewDB').val(),
                rating: starValue,
            },
            success: function(data) {
                $('.toastr_notification').html(data);
            }
        })
    });
    $('#close-popup').click(function(e) {
        e.preventDefault();
        console.log("click close");
        $('#popup-main').removeClass('popup-main');
        $('#popup').removeClass('open-popup');
        $('#backdrop').removeClass('backdrop');
    });
</script>