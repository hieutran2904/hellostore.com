<?php
session_start();
include '../Models/Eloquent.php';
include '../../config/database.php';
include '../../config/site.php';
$eloquent = new Eloquent();
if (isset($_SESSION['SSCF_login_id'])) {
    $productListCart = $eloquent->loadCartInfo($_SESSION['SSCF_login_id']);
} else {
    $productListCart = [];
}

$priceSub = 0;
$priceShip = 0;
$priceDiscount = 0;
$priceTotal = 0;
if ($productListCart != []) {
    foreach ($productListCart as $eachProduct) {
        $productImageItem = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
        $priceSub += $eachProduct['product_price'] * $eachProduct['quantity'];
    }
    if ($priceSub < 200000) $priceShip = 30000;
    if (isset($_SESSION['PRICE_DISCOUNT_AMOUNT'])) {
        $priceDiscount = $_SESSION['PRICE_DISCOUNT_AMOUNT'];
    }
    $priceTotal = $priceSub + $priceShip - $priceDiscount;
}
?>
<tr>
    <td class="cart_total_label">Tổng tiền hàng</td>
    <td class="cart_total_amount">
        <span class="font-lg fw-500 text-brand load_total_sub_price"><?= number_format($priceSub, 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span>
    </td>
</tr>
<tr>
    <td class="cart_total_label">Phí vận chuyển</td>
    <td class="cart_total_amount font-lg fw-500 text-brand type_ship_price">
        <?= number_format($priceShip, 0, ",", ".") . $GLOBALS['CURRENCY'] ?>
    </td>
</tr>
<tr>
    <td class="cart_total_label">Giảm giá</td>
    <td class="cart_total_amount">
        <span class="font-lg fw-500 text-brand load_discount_price"><?= number_format($priceDiscount, 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span>
    </td>
</tr>
<tr>
    <td class="cart_total_label">Tổng thanh toán</td>
    <td class="cart_total_amount"><strong><span class="font-xl fw-700 text-brand"><?= number_format($priceTotal, 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span></strong></td>
</tr>
<?php
?>