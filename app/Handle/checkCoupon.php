<?php
include '../Controllers/Toastr.php';
include '../../config/site.php';
$toastr = new Toastr();
$eloquent = new Eloquent();
$_SESSION['PRICE_DISCOUNT_AMOUNT'] = 0;
if ($_POST['coupon_code'] == "") {
    $toastr->error_toast("Mã giảm giá không hợp lệ", 'THẤT BẠI');
    exit();
}
$couponItem = $eloquent->selectData(['*'], 'discounts', ['discount_code' => $_POST['coupon_code'], 'discount_status' => 'Active', 'is_delete' => '0']);
if ($couponItem != []) {
    $_SESSION['PRICE_DISCOUNT_AMOUNT'] = $couponItem[0]['price_discount_amount'];
    $toastr->success_toast("Mã giảm giá đã được áp dụng", 'THÀNH CÔNG');
} else {
    $_SESSION['PRICE_DISCOUNT_AMOUNT'] = 0;
    $toastr->error_toast("Mã giảm giá không hợp lệ", 'THẤT BẠI');
}
