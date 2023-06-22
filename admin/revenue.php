<?php
include("app/Controllers/View.php");
$view = new View;
$view->loadContent("include", "top");
$view->loadContent("include", "sidebar");
$view->loadContent("content", "revenue");
$view->loadContent("include", "tail");
?>