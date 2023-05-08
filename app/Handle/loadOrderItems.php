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
                        <td><a data-itemid="<?= $eachOrder['idProductSC'] ?> " class="d-block review-customer">Đánh giá</a></td>
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
    // $('.review-customer').click(function(e) {
    //     e.preventDefault();
    //     let productSC = $(this).data('itemid');
    //     console.log(productSC);
    //     $('#popup-main').addClass('popup-main');
    //     $('#backdrop').addClass('backdrop');
    //     $('#popup').addClass('open-popup');
    // });
    // $('#btn-submit-review').click(function(e) {
    //     e.preventDefault();
    //     console.log("click submit");
    //     $('#popup-main').removeClass('popup-main');
    //     $('#popup').removeClass('open-popup');
    //     $('#backdrop').removeClass('backdrop');
    // });

    // $('#close-popup').click(function(e) {
    //     e.preventDefault();
    //     console.log("click close");
    //     $('#popup-main').removeClass('popup-main');
    //     $('#popup').removeClass('open-popup');
    //     $('#backdrop').removeClass('backdrop');
    // });
    $(document).ready(function() {
        let reviews = document.querySelectorAll('.review-customer');
        reviews.forEach(review => {
            review.addEventListener('click', function(e) {
                e.preventDefault();
                let productSC = this.getAttribute('data-itemid');
                console.log(productSC);
                $('#popup-main').addClass('popup-main');
                $('#backdrop').addClass('backdrop');
                $('#popup').addClass('open-popup');
            });

        });
    })
</script>