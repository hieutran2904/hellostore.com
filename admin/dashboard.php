<?php
include("app/Controllers/View.php");
$view = new View;
$view->loadContent("include", "top");
$view->loadContent("include", "sidebar");
$view->loadContent("content", "dashboard");
$view->loadContent("include", "tail");
?>