<?php
session_start();
include '../Models/Eloquent.php';
include '../../config/database.php';
include '../../config/site.php';
$eloquent = new Eloquent();

$orderItems = $eloquent->selectOrderItems($_SESSION['SSCF_login_id'], $_POST['order_id']);

?>
<div class="card-header">
    <h5 class="mb-0">Chi tiết đơn hàng #<?= $_POST['order_id'] ?></h5>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Đánh giá</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($orderItems as $eachOrder) {
                    $productImageItem = $GLOBALS['PRODUCT_DIRECTORY'] . $eachOrder['product_master_image'];
                ?>
                    <tr>
                        <td class="image product-thumbnail"><img src="<?= $productImageItem ?>" alt="#"></td>
                        <td>
                            <a href="#"><?= $eachOrder['product_name'] ?></a>
                            <p class="font-xs">Size: <?= $eachOrder['product_size'] ?> | Màu: <?= $eachOrder['product_color'] ?>
                        </td>
                        <td><?= number_format($eachOrder['product_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></td>
                        <td><?= $eachOrder['product_quantity'] ?></td>
                        <td><?= number_format($eachOrder['product_price'] * $eachOrder['product_quantity'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></td>
                        <td>
                            <a data-itemid="<?= $eachOrder['idProductSC'] ?>" class="d-block review-customer">
                                <?= $eachOrder['review_details'] == "" ? "Đánh giá" : "Sửa đánh giá" ?>
                            </a>
                            <input type="" id="idReview-inp-<?= $eachOrder['idProductSC'] ?>" name="" id="" value="<?= $eachOrder['idReview'] ?>">
                            <input type="" id="review_details-inp-<?= $eachOrder['idProductSC'] ?>" name="" id="" value="<?= $eachOrder['review_details'] ?>">
                            <input type="" id="rating-inp-<?= $eachOrder['idProductSC'] ?>" name="" id="" value="<?= $eachOrder['rating'] ?>">
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php

?>
<script>
    $(document).ready(function() {
        let reviews = document.querySelectorAll('.review-customer');
        reviews.forEach(review => {
            review.addEventListener('click', function(e) {
                e.preventDefault();
                let productSC = this.getAttribute('data-itemid');
                let idReview = $('#idReview-inp-' + productSC).val();
                let review_details = $('#review_details-inp-' + productSC).val();
                let rating = $('#rating-inp-' + productSC).val();
                sessionStorage.setItem("product_sc_id_review", productSC);
                console.log(productSC);
                console.log(idReview);
                console.log(review_details);
                console.log(rating);

                $('#popup-main').addClass('popup-main');
                $('#backdrop').addClass('backdrop');
                $('#popup').addClass('open-popup');
                $('#review-detail').val(review_details);
                $('#' + rating).val(rating);
                if (rating == "") {
                    $('#5').prop('checked', false);
                    $('#4').prop('checked', false);
                    $('#3').prop('checked', false);
                    $('#2').prop('checked', false);
                    $('#1').prop('checked', false);
                    sessionStorage.setItem("rating_session", 0);
                } else {
                    $('#' + rating).prop('checked', true);
                    sessionStorage.setItem("rating_session", rating);
                }
                $('#idReviewDB').val(idReview);
            });

        });
    })
</script>