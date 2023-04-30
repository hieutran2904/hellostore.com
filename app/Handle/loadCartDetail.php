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
$priceTotal = 0;
$SESSION['LIST_PRODUCT_CART'] = $productListCart;

if ($productListCart != [])
    foreach ($productListCart as $eachProduct) {
        $productItems = $eloquent->selectData(['*'], 'products', ['id' => $eachProduct['product_id']]);
        $productItem = $productItems[0];
        $productImageItem = $GLOBALS['PRODUCT_DIRECTORY'] . $productItem['product_master_image'];
        $priceTotal += $productItem['product_price'] * $eachProduct['quantity'];
?>
    <tr>
        <td class="image product-thumbnail"><img src="<?= $productImageItem ?>" alt="#"></td>
        <td class="product-des product-name">
            <h5 class="product-name"><a href="product-details.php?id=<?= $productItem['id'] ?>"><?= $productItem['product_name'] ?></a></h5>
            <p class="font-xs">Size: XL | Color: Red (load from database)
            </p>
        </td>
        <td class="price" data-title="Price"><span><?= $productItem['product_price'] . $GLOBALS['CURRENCY'] ?></span></td>
        <td class="text-center" data-title="Stock">
            <div class="detail-qty border radius  m-auto">
                <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                <span class="qty-val"><?= $eachProduct['quantity'] ?></span>
                <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
            </div>
        </td>
        <!-- <td class="text-right" data-title="Cart">
        <span>$65.00 </span>
    </td> -->
        <input type="hidden" name="" id="delete_product_cart_name">
        <td class="action"><a data-itemid="<?= $productItem['id'] ?>" class="text-muted"><i class="fi-rs-trash"></i></a></td>
    </tr>
<?php

    }

else {
    echo "<h4>" . "Không có sản phẩm nào trong giỏ hàng" . "</h4>";
}

?>

<script>
    $('.text-muted').click(function(e) {
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
                $('#load_product_detail').load("app/Handle/loadCartDetail.php");
                $('.toastr_notification').html(data);
            }
        });
    });
</script>