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

    var starValue = 0;
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
        for (let i = 0; i < stars.length; i++) {
            if (stars[i].checked) {
                starValue = stars[i].value;
                break;
            }
        }
        $('#popup-main').removeClass('popup-main');
        $('#popup').removeClass('open-popup');
        $('#backdrop').removeClass('backdrop');
        $.ajax({
            url: 'app/Handle/addReview.php',
            type: 'POST',
            data: {
                order_id: order_id,
                product_sc_id: $('#idProductSC').val(),
                review_detail: $('#review-detail').val(),
                id_reivew_check: $('#idReviewDB').val(),
                rating: starValue,
            },
            success: function(data) {
                $('.toastr_notification').html(data);
                $('#load-order-items').load('app/Handle/loadOrderItems.php', {
                    order_id: order_id,
                });
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