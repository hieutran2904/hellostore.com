<?php
include '../Controllers/Toastr.php';
include '../../config/site.php';
$toastr = new Toastr();
$eloquent = new Eloquent();
$arr = array();
//update quantity
$productItem = $eloquent->updateData('shopcarts', ['quantity' => $_POST['product_quantity']], ['id' => $_POST['product_sc_id']]);

//get quantity
$productItemQty = $eloquent->selectData(['quantity'], 'shopcarts', ['id' => $_POST['product_sc_id']]);

if (isset($_SESSION['SSCF_login_id'])) {
    $productListCart = $eloquent->loadCartInfo($_SESSION['SSCF_login_id']);
    $count_product_cart = count($productListCart);
} else {
    $count_product_cart = 0;
    $productListCart = [];
}
$priceTotal = 0;
if ($productListCart != [])
    foreach ($productListCart as $eachProduct) {
        $productImageItem = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
        $priceTotal += $eachProduct['product_price'] * $eachProduct['quantity'];
    }

if ($priceTotal > 200000) $priceShip = 0;
else $priceShip = 30000;

$arr = array(
    'sub_price' => $productItemQty[0]['quantity'] * $_POST['product_price'],
    'total_price' => $priceTotal,
    'ship_price' => $priceShip,
);

echo json_encode($arr);
