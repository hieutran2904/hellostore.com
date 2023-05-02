<?php

include '../Controllers/Toastr.php';
//da goi sesstion_start(), globals database, eloquent trong class Toastr
include '../../config/site.php';
$toastr = new Toastr();
$eloquent = new Eloquent();


$id = $_POST['product_sc_id'];
$name = $_POST['product_name'];
$qty = $_POST['product_qty'];

if (isset($_SESSION['SSCF_login_id'])) {
    //check1: kiem tra xem san pham da co trong gio hang chua?
    $columnName = ['*'];
    $tableName = "shopcarts";
    $whereValue = [
        'product_sc_id' => $id,
        'customer_id' => $_SESSION['SSCF_login_id']
    ];
    $availabilityInCart = $eloquent->selectData($columnName, $tableName, @$whereValue);

    //neu co san pham do trong gio hang
    if (!empty($availabilityInCart)) {
        // update so luong san pham trong gio hang
        $tableName = "shopcarts";
        $columnValue["quantity"] = $qty + $availabilityInCart[0]['quantity'];
        $whereValue = [
            'customer_id' => $_SESSION['SSCF_login_id'],
            'product_sc_id' => $id
        ];
        $updateCartResult = $eloquent->updateData($tableName, $columnValue, $whereValue);
        // $productListCart = $eloquent->selectData(['*'], $tableName, ['customer_id' => $_SESSION['SSCF_login_id']]);
        // $count_product_cart = count($productListCart);
        $_SESSION['ADD_TO_CART_RESULT'] = $updateCartResult;
        //$SESSION['LIST_PRODUCT_CART'] = $productListCart;
    } else {
        #== INSERT ITEMS INTO THE ADD TO CART
        $columnValue = $tableName = null;
        $tableName = "shopcarts";
        $columnValue = [
            'customer_id' => $_SESSION['SSCF_login_id'],
            'product_sc_id' => $id,
            'quantity' => $_POST['product_qty'],
            'created_at' => date("Y-m-d H:i:s")
        ];
        $addToCartResult = $eloquent->insertData($tableName, $columnValue);
        // $productListCart = $eloquent->selectData(['*'], $tableName, ['customer_id' => $_SESSION['SSCF_login_id']]);
        // $count_product_cart = count($productListCart);
        $_SESSION['ADD_TO_CART_RESULT'] = $addToCartResult;
        //$SESSION['LIST_PRODUCT_CART'] = $productListCart;
    }
    $toastr->success_toast($name . " đã thêm vào giỏ hàng ", 'Thành công');
} else {
    $_SESSION['ADD_TO_CART_RESULT'] = 0;
    $toastr->error_toast('Vui lòng đăng nhập để thêm vào giỏ hàng ', 'Thất bại');
}

//include 'loadCart.php';
