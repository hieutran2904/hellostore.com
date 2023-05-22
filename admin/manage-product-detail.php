<?php
include("app/Controllers/View.php");
$view = new View;
$view->loadContent("include", "top");
$view->loadContent("include", "sidebar");
$view->loadContent("content", "add-edit-product-detail");
$view->loadContent("include", "tail");
?>