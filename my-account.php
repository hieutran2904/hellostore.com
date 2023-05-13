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

    $('#submit-info-customer').click(function(e) {
        e.preventDefault();
        console.log("click submit info customer");
        $.ajax({
            url: 'app/Handle/updateInfoCustomer.php',
            type: 'POST',
            data: {
                customer_name: $('.customer_name').val(),
                customer_phone: $('.customer_phone').val(),
                customer_address: $('.customer_address').val(),
                customer_pass_current: $('.customer_pass_current').val(),
                customer_npass: $('.customer_npass').val(),
                customer_cpass: $('.customer_cpass').val(),
            },
            dataType: 'json',
            success: function(data) {
                if (data.type == "no_name") warning_toast("Vui lòng nhập tên!", "Thông báo");
                else if (data.type == "no_phone") warning_toast("Vui lòng nhập số điện thoại!", "Thông báo");
                else if (data.type == "no_address") warning_toast("Vui lòng nhập địa chỉ!", "Thông báo");
                else if (data.type == "no_pass_current") warning_toast("Vui lòng nhập mật khẩu cũ!", "Thông báo");
                else if (data.type == "no_match_pass_current") warning_toast("Mật khẩu cũ không khớp!", "Thông báo");
                else if (data.type == "no_npass") warning_toast("Vui lòng nhập mật khẩu mới!", "Thông báo");
                else if (data.type == "no_cpass") warning_toast("Vui lòng nhập lại mật khẩu mới!", "Thông báo");
                else if (data.type == "no_match") warning_toast("Mật khẩu không khớp!", "Thông báo");
                else if (data.type == "success_info") {
                    success_toast("Cập nhật thông tin thành công!", "Thông báo");
                    $('#customer_name_status').html(data.name);
                    $('#customer_name_top').html(data.name);
                } else if (data.type == "success_password") {
                    success_toast("Cập nhật thông tin & mật khẩu thành công!", "Thông báo");
                    $('#customer_name_status').html(data.name);
                    $('#customer_name_top').html(data.name);
                    $('.customer_pass_current').val(data.pass);
                    $('.customer_npass').val("");
                    $('.customer_cpass').val("");
                } else if (data.type == "error") warning_toast("Cập nhật thông tin thất bại!", "Thông báo");
            }
        })
    });
</script>