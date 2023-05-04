<?php
include '../Controllers/Toastr.php';
$toastr = new Toastr();
$eloquent = new Eloquent();

$deleteProductCart = $eloquent->deleteData('shopcarts', ['id' => $_POST['product_id']]);
$toastr->success_toast($_POST['product_name'] . "đã được xóa khỏi giỏ hàng", 'THÀNH CÔNG');
?>