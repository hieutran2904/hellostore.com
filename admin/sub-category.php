<?php
include("app/Controllers/View.php");
$view = new View;
$view->loadContent("include", "top");
$view->loadContent("include", "sidebar");
$view->loadContent("content", "sub-category");
$view->loadContent("include", "tail");
?>