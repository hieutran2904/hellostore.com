<?php
include('app/Controllers/SearchController.php');

$homeController = new HomeController();
$eloquent = new Eloquent();
$searchCtrl = new SearchController;

//check keywords
if (isset($_POST['keywords'])) {
    //list product search
    $_SESSION['search_keywords'] = strip_tags($_POST['keywords']);
    $productList = $searchCtrl->searchProduct($_SESSION['search_keywords'], 0, 100);
    $productNameSearch = $_SESSION['search_keywords'];
} else if (isset($_GET['tags'])) {
    //list product search
    $_SESSION['search_keywords'] = strip_tags($_GET['tags']);
    $productList = $searchCtrl->searchProduct($_SESSION['search_keywords'], 0, 100);
    $productNameSearch = $_SESSION['search_keywords'];
} else if (isset($_GET['subCategoryId'])) {
    //tim san pham theo subcategory
    unset($_SESSION['search_keywords']);
    $columnName = ['*'];
    $tableName = 'products';
    $whereValue = ['subcategory_id' => $_GET['subCategoryId']];
    $productList = $eloquent->selectData($columnName, $tableName, @$whereValue);
    $productNameSearch = $eloquent->selectData(['*'], 'subcategories', ['id' => $_GET['subCategoryId']])[0]['subcategory_name'];
} else if (isset($_GET['categoryId'])) {
    //tim san pham theo category
    unset($_SESSION['search_keywords']);
    $columnName = ['*'];
    $tableName = 'products';
    $whereValue = ['category_id' => $_GET['categoryId']];
    $productList = $eloquent->selectData($columnName, $tableName, @$whereValue);
    $productNameSearch = $eloquent->selectData(['*'], 'categories', ['id' => $_GET['categoryId']])[0]['category_name'];
} else {
    //ko tim san pham ma click vao trang san pham
    $columnName = ['*'];
    $tableName = 'products';
    $productList = $eloquent->selectData($columnName, $tableName);
    $productNameSearch = '';
}
$countItem = $productList != null ? count($productList) : 0;

//phan trang
if (!empty($productList)) {
    // nod = Number of Data
    $nod = $countItem;
    // rpp = Result Per Page
    if ($nod > 3) {
        $rpp = 3;
    } else {
        $rpp = $nod;
    }
    // nop = Number of Page
    $nop = ceil($nod / $rpp);
    // defaul page no 1
    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    // cp = Current Page
    $cp = ($page - 1) * $rpp;

    $text = 0;
    if ($text >= $nod) {
        $text = $nod;
    } else if ($text <= $nod) {
        $text = $rpp * $page;
    }

    $url = "";
    if (isset($_POST['keywords'])) {
        //list product search
        $_SESSION['search_keywords'] = strip_tags($_POST['keywords']);
        $url = 'tags=' . $_SESSION['search_keywords'] . '&';
        $productList = $searchCtrl->searchProduct($_SESSION['search_keywords'], $cp, $rpp);
        $productNameSearch = $_SESSION['search_keywords'];
    } else if (isset($_GET['tags'])) {
        //list product search
        $_SESSION['search_keywords'] = strip_tags($_GET['tags']);
        $url = 'tags=' . $_SESSION['search_keywords'] . '&';
        $productList = $searchCtrl->searchProduct($_SESSION['search_keywords'], $cp, $rpp);
        $productNameSearch = $_SESSION['search_keywords'];
    } else if (isset($_GET['subCategoryId'])) {
        //tim san pham theo subcategory
        $url = 'subCategoryId=' . $_GET['subCategoryId'] . '&';
        $columnName = ['*'];
        $tableName = 'products';
        $whereValue = ['subcategory_id' => $_GET['subCategoryId']];
        $productList = $eloquent->selectData($columnName, $tableName, $whereValue, [], [], [], ['DESC' => 'id'], ['START' => $cp, 'END' => $rpp]);
        $productNameSearch = $eloquent->selectData(['*'], 'subcategories', ['id' => $_GET['subCategoryId']])[0]['subcategory_name'];
    } else if (isset($_GET['categoryId'])) {
        //tim san pham theo category
        $url = 'categoryId=' . $_GET['categoryId'] . '&';
        $columnName = ['*'];
        $tableName = 'products';
        $whereValue = ['category_id' => $_GET['categoryId']];
        $productList = $eloquent->selectData($columnName, $tableName, $whereValue, [], [], [], ['DESC' => 'id'], ['START' => $cp, 'END' => $rpp]);
        $productNameSearch = $eloquent->selectData(['*'], 'categories', ['id' => $_GET['categoryId']])[0]['category_name'];
    } else {
        //ko tim san pham ma click vao trang san pham
        $columnName = ['*'];
        $tableName = 'products';
        $productList = $eloquent->selectData($columnName, $tableName, [], [], [], [], ['ASC' => 'id'], ['START' => $cp, 'END' => $rpp]);
        $productNameSearch = '';
    }

    $previous = $page - 1;
    $next = $page + 1;

    $pageNumber = '';
    for ($i = 1; $i <= $nop; $i++) {
        if ($i == $page) $type = 'active';
        else $type = '';
        $pageNumber .= '<li class="page-item ' . $type . '"><a class="page-link" href="product-category.php?' . $url . 'page=' . $i . '">' . $i . '</a></li>';
    }
}
?>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Trang chủ</a>
                <span></span> Sản phẩm
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>Chúng tôi tìm thấy <strong class="text-brand"><?= $countItem ?></strong> sản phẩm
                                <strong class="text-brand"><?php echo $productNameSearch ?></strong>
                            </p>
                            <p>
                                <?php
                                if (!empty($productList)) {
                                    if ($text >= $countItem)
                                    $text = $countItem;
                                    echo '<label>📋Kết quả: ' . ($cp + 1) . '&rarr;' . $text . '</label>';
                                }
                                ?>
                            </p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <!-- <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div> -->
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">50</a></li>
                                        <li><a href="#">100</a></li>
                                        <li><a href="#">150</a></li>
                                        <li><a href="#">200</a></li>
                                        <li><a href="#">All</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Release Date</a></li>
                                        <li><a href="#">Avg. Rating</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid-3">
                        <?php
                        if ($productList != null)
                            $homeController->productLister($productList, $col = 4, ['hot' => 'hot']);
                        ?>
                    </div>
                    <!--pagination-->
                    <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item"><a class="page-link" href="product-category.php?<?= $url ?>page=<?= $previous < 1 ? 1 : $previous ?>"><i class="fi-rs-angle-double-small-left"></i></a></li>
                                <?php
                                if (!empty($productList))
                                    echo $pageNumber;
                                ?>
                                <li class="page-item"><a class="page-link" href="product-category.php?<?= $url ?>page=<?= $next > $nop ? $nop : $next ?>"><i class="fi-rs-angle-double-small-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <?php include("./resource/views/include/site-bar.php") ?>
            </div>
        </div>
    </section>
</main>