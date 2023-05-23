<?php
include '../../config/database.php';
include '../Models/Eloquent.php';
include '../Controllers/Controller.php';
include '../Controllers/CategoryController.php';

$eloquent = new Eloquent();

//get list
// $categoryList = $eloquent->selectData(['*'], 'categories');
// $subCategoryList = $eloquent->selectData(['*'], 'subcategories');
// $productList = $eloquent->selectData(['*'], 'products');



$id = $_POST['id'];
$tableName = $_POST['tableName'];

if ($tableName == 'categories'){
    $deleteData = $eloquent->deleteData($tableName, ['id' => $id]);
    $categoryList = $eloquent->selectData(['*'], 'categories');
    $categoryShow = new CategoryController();
    $categoryShow->CategoryList($categoryList);
}

?>

<script src="public/js/main.js"></script>
