<?php

include '../Controllers/Toastr.php';
//da goi sesstion_start(), globals database, eloquent trong class Toastr
include '../../config/site.php';
$toastr = new Toastr();
$eloquent = new Eloquent();


$id = $_POST['product_id'];
$name = $_POST['product_name'];
$qty = $_POST['product_qty'];

if (@$_SESSION['SSCF_login_id'] > 0) {
    //check1: kiem tra xem san pham da co trong gio hang chua?
    $columnName = ['*'];
    $tableName = "shopcarts";
    $whereValue = [
        'product_id' => $_POST['product_id'],
        'customer_id' => $_SESSION['SSCF_login_id']
    ];
    $availabilityInCart = $eloquent->selectData($columnName, $tableName, @$whereValue);

    //$_SESSION['COUNT_PRODUCT_CART'] = count($availabilityInCart);
    //neu co san pham do trong gio hang
    if (!empty($availabilityInCart)) {
        // update so luong san pham trong gio hang
        $tableName = "shopcarts";
        $columnValue["quantity"] = $_POST['product_qty'] + $availabilityInCart[0]['quantity'];
        // $whereValue["customer_id"] = $_SESSION['SSCF_login_id'];
        // $whereValue["product_id"] = $_POST['cart_product_id'];
        $whereValue = [
            'customer_id' => $_SESSION['SSCF_login_id'],
            'product_id' => $_POST['product_id']
        ];
        $updateCartResult = $eloquent->updateData($tableName, $columnValue, $whereValue);
        $_SESSION['ADD_TO_CART_RESULT'] = $updateCartResult;
        $productListCart = $eloquent->selectData(['*'], $tableName, ['customer_id' => $_SESSION['SSCF_login_id']]);
        $count_product_cart = count($productListCart);
    } else {
        #== INSERT ITEMS INTO THE ADD TO CART
        $columnValue = $tableName = null;
        $tableName = "shopcarts";
        $columnValue = [
            'customer_id' => $_SESSION['SSCF_login_id'],
            'product_id' => $_POST['product_id'],
            'quantity' => $_POST['product_qty'],
            'created_at' => date("Y-m-d H:i:s")
        ];
        // $columnValue["customer_id"] = @$_SESSION['SSCF_login_id'];
        // $columnValue["product_id"] = $_POST['cart_product_id'];
        // $columnValue["quantity"] = $_POST['cart_product_quantity'];
        // $columnValue["created_at"] = date("Y-m-d H:i:s");
        $addToCartResult = $eloquent->insertData($tableName, $columnValue);
        $productListCart = $eloquent->selectData(['*'], $tableName, ['customer_id' => $_SESSION['SSCF_login_id']]);
        $count_product_cart = count($productListCart);
        //$arr['count'] = count($productListCart);

        //$arr['cart'] = $productListCart;

        $_SESSION['ADD_TO_CART_RESULT'] = $addToCartResult;
    }
    $toastr->success_toast($name . " đã thêm vào giỏ hàng ", 'Thành công');
} else {
    $_SESSION['ADD_TO_CART_RESULT'] = 0;
    $toastr->error_toast('Vui lòng đăng nhập để thêm vào giỏ hàng ', 'Thất bại');
}
//header('Content-Type: application/json');
// echo json_encode($arr);
// echo "<h1>test</h1>";
?>
<a class="mini-cart-icon" href="cart.php">
    <img alt="Surfside Media" src="public/assets/imgs/theme/icons/icon-cart.svg">
    <span class="pro-count blue"><?= $count_product_cart ?></span>
</a>
<div class="cart-dropdown-wrap cart-dropdown-hm2">
    <ul>
        <?php
        $priceTotal = 0;
        if ($productListCart != [])
            foreach ($productListCart as $key => $product) {
                $productItems = $eloquent->selectData(['*'], 'products', ['id' => $product['product_id']]);
                $productItem = $productItems[0];
                $productImageItem = $GLOBALS['PRODUCT_DIRECTORY'] . $productItem['product_master_image'];
                $priceTotal += $productItem['product_price'] * $product['quantity'];

        ?>
            <li>
                <div class="shopping-cart-img">
                    <a href="product-detail.php?id=<?= $productItem['id'] ?>"><img alt="" src="<?= $productImageItem ?>"></a>
                </div>
                <div class="shopping-cart-title">
                    <h4><a href="product-detail.php?id=<?= $productItem['id'] ?>"><?= $productItem['product_name'] ?></a></h4>
                    <h4><span><?= $product['quantity'] ?> × </span><?php echo number_format($productItem['product_price']) . $GLOBALS['CURRENCY'] ?></h4>
                </div>
                <div class="shopping-cart-delete">
                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                </div>
            </li>
        <?php
            }
        else {
        ?>
            <li>
                <div class="shopping-cart-title">
                    <h4>Không có sản phẩm nào trong giỏ hàng</h4>
                </div>
            </li>
        <?php
        }
        ?>
    </ul>
    <div class="shopping-cart-footer">
        <div class="shopping-cart-total">
            <h4>Tổng: <span><?php echo number_format($priceTotal) . $GLOBALS['CURRENCY'] ?></span></h4>
        </div>
        <div class="shopping-cart-button">
            <a href="cart.php" class="outline">Giỏ hàng</a>
            <a href="checkout.html">Thanh toán</a>
        </div>
    </div>
</div>
<?php
