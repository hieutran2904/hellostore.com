<?php
session_start();
include '../Models/Eloquent.php';
include '../../config/database.php';
include '../../config/site.php';

$eloquent = new Eloquent();
$idProductsSC = "";
// if (isset($_POST['color'])) echo "<p class=\"text-danger\">Bạn chưa chọn size 🤔</p>";
// else if (isset($_POST['size'])) echo "<p class=\"text-danger\">Bạn chưa chọn màu 🤔</p>";
// echo "color: ".$_POST['color'].", size: ".$_POST['size'];
// echo "<br>";
// echo "product_id: ".$_POST['product_id']; 
// $columnName = ['*'];
// $tableName = 'products_sc';
// $whereValue = [
//     'product_id' => $_POST['product_id'],
//     'product_color' => $_POST['color'],
//     'product_size' => $_POST['size']
// ];
if (isset($_POST['color']) && isset($_POST['size']) && isset($_POST['product_id'])) {
    echo "color: " . $_POST['color'] . ", size: " . $_POST['size'];
    echo "<br>";

    $columnName = ['*'];
    $tableName = 'products_sc';
    $whereValue = [
        'product_id' => $_POST['product_id'],
        'product_color' => $_POST['color'],
        'product_size' => $_POST['size']
    ];
    $productItem = $eloquent->selectData($columnName, $tableName, $whereValue);
    if ($productItem != []) {
        $productQuantity = $productItem[0]['product_quantity'];
        if ($productQuantity > 0) {
            echo "<p class=\"text-success\">Số lượng sản phẩm trong kho: $productQuantity &#10004;</p>";
            //$idProductsSC = $eloquent->selectData(['id'], 'products_sc', ['product_id' => $_POST['product_id'], 'product_color' => $_POST['color'], 'product_size' => $_POST['size']]);
            $idProductsSC = $productItem[0]['id'];
            echo "<input type=\"hidden\" id=\"idProductsSC\" value=\"$idProductsSC\">";
            exit();
        } else echo "<p class=\"text-danger\">Sản phẩm đã hết hàng 🤔</p>";
    } else echo "<p class=\"text-danger\">Sản phẩm đã hết hàng 🤔</p>";
} else echo "<p class=\"text-danger\">Bạn chưa chọn size hoặc màu 🤔</p>";
echo "<input type=\"hidden\" id=\"idProductsSC\" value=\"$idProductsSC\">";
