<?php
session_start();
include '../Models/Eloquent.php';
include '../../config/database.php';
include '../../config/site.php';
$eloquent = new Eloquent();

$tableName = "shopcarts";
if (isset($_SESSION['SSCF_login_id'])) {
    $productListCart = $eloquent->selectData(['*'], $tableName, ['customer_id' => $_SESSION['SSCF_login_id']]);
    $count_product_cart = count($productListCart);
} else {
    $count_product_cart = 0;
    $productListCart = [];
}
$SESSION['LIST_PRODUCT_CART'] = $productListCart;
//load cart
?>
<a class="mini-cart-icon" href="cart.php">
    <img alt="" src="public/assets/imgs/theme/icons/icon-cart.svg">
    <span class="pro-count blue"><?= $count_product_cart; ?></span>
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
                <form class="shopping-cart-delete">
                    <input type="hidden" id="delete_product_cart_name<?= $productItem['id'] ?>" value="<?= $productItem['product_name'] ?>">
                    <a class="delete_product_cart" data-itemid="<?= $productItem['id'] ?>"><i class="fi-rs-cross-small"></i></a>
                </form>
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
            <a href="checkout.php">Thanh toán</a>
        </div>
    </div>
</div>
<?php

?>

<script>
    $('.delete_product_cart').click(function(e) {
        e.preventDefault();
        var id = $(this).data('itemid');
        console.log(id);
        var name = $('#delete_product_cart_name' + id).val();
        $.ajax({
            url: 'app/Handle/deleteToCart.php',
            type: 'POST',
            data: {
                product_id: id,
                product_name: name
            },
            success: function(data) {
                $('.cart_product').load("app/Handle/loadCart.php");
                $('.toastr_notification').html(data);
            }
        });
    });
</script>