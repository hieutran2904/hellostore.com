<?php
include('app/Controllers/View.php'); // start session in View.php
$view = new View();
$view->loadContent("include", "session");
$view->loadContent('include', 'top');
$view->loadContent('content', 'product-detail');
$view->loadContent('include', 'tail');