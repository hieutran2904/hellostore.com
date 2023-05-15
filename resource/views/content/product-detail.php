<?php
$control = new Controller;
$eloquent = new Eloquent;

if (isset($_REQUEST['id'])) {
    $_SESSION['SSCF_product_product_id'] = $_REQUEST['id'];
}

//fetch all products
$columnName = ['*'];
$tableName = 'products';
$whereValue = ['id' => $_SESSION['SSCF_product_product_id']];
$productList = $eloquent->selectData($columnName, $tableName, $whereValue);

$imageMaster = $GLOBALS['PRODUCT_DIRECTORY'] . $productList[0]['product_master_image'];
$imageOne = $GLOBALS['PRODUCT_DIRECTORY'] . $productList[0]['product_image_one'];
$imageTwo = $GLOBALS['PRODUCT_DIRECTORY'] . $productList[0]['product_image_two'];
$imageThree = $GLOBALS['PRODUCT_DIRECTORY'] . $productList[0]['product_image_three'];

//san pham co lien quan
$getCategoryID = $eloquent->selectData(['category_id'], 'products', ['id' => $_SESSION['SSCF_product_product_id']]);
$whereValue = ['category_id' => $getCategoryID[0]['category_id']];
$relateProductList = $eloquent->selectData(['*'], 'products', $whereValue, [], [], [], 0, ['START' => 0, 'END' => 8]);
//print_r($relateProductList);

//fetch all color for product id
$colorProductList = $eloquent->selectData(['product_color'], 'products_sc', ['product_id' => $_SESSION['SSCF_product_product_id']], [], [], ['product_color' => 'product_color']);
//print_r($colorProductList);

//fetch all size for product id
$productSizeList = $eloquent->selectData(['product_size'], 'products_sc', ['product_id' => $_SESSION['SSCF_product_product_id']], [], [], ['product_size' => 'product_size']);
//print_r($productSizeList);

//customer review
$reviewProductList = $eloquent->selectReviewProduct($_SESSION['SSCF_product_product_id']);
?>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php" rel="nofollow">Trang chủ</a>
                <a href="product-category.php"><span></span>Sản phẩm</a>
                <span></span><?= $productList[0]['product_name'] ?>
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        <figure class="border-radius-10">
                                            <img src="<?= $imageMaster ?>" alt="product image">
                                        </figure>
                                        <figure class="border-radius-10">
                                            <img src="<?= $imageOne ?>" alt="product image" class="w-100 h-100">
                                        </figure>
                                        <figure class="border-radius-10">
                                            <img src="<?= $imageTwo ?>" alt="product image" class="w-100 h-100">
                                        </figure>
                                        <figure class="border-radius-10">
                                            <img src="<?= $imageThree ?>" alt="product image" class="w-100 h-100">
                                        </figure>
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-10">
                                        <div><img src="<?= $imageMaster ?>" alt="product image"></div>
                                        <div><img src="<?= $imageOne ?>" alt="product image"></div>
                                        <div><img src="<?= $imageTwo ?>" alt="product image"></div>
                                        <div><img src="<?= $imageThree ?>" alt="product image"></div>
                                        <!-- <div><img src="public/assets/imgs/shop/thumbnail-7.jpg" alt="product image"></div>
                                        <div><img src="public/assets/imgs/shop/thumbnail-8.jpg" alt="product image"></div>
                                        <div><img src="public/assets/imgs/shop/thumbnail-9.jpg" alt="product image"></div> -->
                                    </div>
                                </div>
                                <!-- End Gallery -->
                                <!-- <div class="social-icons single-share">
                                    <ul class="text-grey-5 d-inline-block">
                                        <li><strong class="mr-10">Share this:</strong></li>
                                        <li class="social-facebook"><a href="#"><img src="public/assets/imgs/theme/icons/icon-facebook.svg" alt=""></a></li>
                                        <li class="social-twitter"> <a href="#"><img src="public/assets/imgs/theme/icons/icon-twitter.svg" alt=""></a></li>
                                        <li class="social-instagram"><a href="#"><img src="public/assets/imgs/theme/icons/icon-instagram.svg" alt=""></a></li>
                                        <li class="social-linkedin"><a href="#"><img src="public/assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a></li>
                                    </ul>
                                </div> -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <form class="detail-info">
                                    <h2 class="title-detail"><?= $productList[0]['product_name'] ?></h2>
                                    <div class="product-detail-rating">
                                        <div class="pro-details-brand">
                                            <span> Brands: <a href="product.php">HTH</a></span>
                                        </div>
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:50%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted">(db load reviews)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            <ins><span class="text-brand"><?= number_format($productList[0]['product_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span></ins>
                                            <ins><span class="old-price font-md ml-15"><?= number_format($productList[0]['product_price'] *= 1.1, 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span></ins>
                                            <span class="save-price  font-md color3 ml-15">10% Off</span>
                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <p><?= $productList[0]['product_summary'] ?></p>
                                    </div>
                                    <!-- <div class="product_sort_info font-xs mb-30">
                                        <ul>
                                            <li class="mb-10"><i class="fi-rs-crown mr-5"></i> 1 Year AL Jazeera Brand Warranty</li>
                                            <li class="mb-10"><i class="fi-rs-refresh mr-5"></i> 30 Day Return Policy</li>
                                            <li><i class="fi-rs-credit-card mr-5"></i> Cash on Delivery available</li>
                                        </ul>
                                    </div> -->
                                    <div class="attr-detail attr-color mb-15">
                                        <strong class="mr-10">Màu</strong>
                                        <ul class="list-filter color-filter">
                                            <?php
                                            foreach ($colorProductList as $eachColor) {
                                                echo '<li class=""><a class="choice-color" data-color="' . $eachColor['product_color'] . '"><span class="product-color-' . $eachColor['product_color'] . '"></span></a></li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="attr-detail attr-size">
                                        <strong class="mr-10">Size</strong>
                                        <ul class="list-filter size-filter font-small load-size">
                                            <?php
                                            foreach ($productSizeList as $eachSize) {
                                                echo '<li class="mr-5"><a class="choice-size" data-size="' . $eachSize['product_size'] . '">' . $eachSize['product_size'] . '</a></li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="attr-detail mt-10">
                                        <span class="in-stock text-success load-status-quantity">
                                        </span>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <div class="detail-extralink">
                                        <div class="detail-qty border radius">
                                            <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val">1</span>
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <div class="product-extra-link2">
                                            <button type="submit" class="button button-add-to-cart add_to_cart">Thêm vào giỏ hàng</button>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                    </div>
                                    <!-- <ul class="product-meta font-xs color-grey mt-50">
                                        <li class="mb-5">SKU: <a href="#">FWM15VKT</a></li>
                                        <li class="mb-5">Tags: <a href="#" rel="tag">Cloth</a>, <a href="#" rel="tag">Women</a>, <a href="#" rel="tag">Dress</a> </li>
                                        <li>Availability:<span class="in-stock text-success ml-5">8 Items In Stock</span></li>
                                    </ul> -->
                                </form>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">MÔ TẢ</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Đánh giá (<?= $reviewProductList != [] ? count($reviewProductList) : 0 ?>)</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        <p><?= $productList[0]['product_details'] ?></p>
                                        <h4 class="mt-30">Hướng dẫn chọn size</h4>
                                        <hr class="wp-block-separator is-style-wide">
                                        <p>Size M: 50-57kg / Cao 1m53 – 1m68</p>
                                        <p>Size L: 58-64kg / Cao 1m160 – 1m70</p>
                                        <p>Size XL: 65-70kg / Cao 1m70 – 1m78</p>
                                        <p>Size XXL: 71-85kg / Cao 1m78 – 1m85</p>
                                        <p>Tùy mỗi người thích body hoặc vừa người thì tăng hoặc giảm 1 size, chỉ số trên là tương đối mặc</p>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane fade" id="Additional-info">
                                    <table class="font-md">
                                        <tbody>
                                            <tr class="stand-up">
                                                <th>Stand Up</th>
                                                <td>
                                                    <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-wo-wheels">
                                                <th>Folded (w/o wheels)</th>
                                                <td>
                                                    <p>32.5″L x 18.5″W x 16.5″H</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-w-wheels">
                                                <th>Folded (w/ wheels)</th>
                                                <td>
                                                    <p>32.5″L x 24″W x 18.5″H</p>
                                                </td>
                                            </tr>
                                            <tr class="door-pass-through">
                                                <th>Door Pass Through</th>
                                                <td>
                                                    <p>24</p>
                                                </td>
                                            </tr>
                                            <tr class="frame">
                                                <th>Frame</th>
                                                <td>
                                                    <p>Aluminum</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-wo-wheels">
                                                <th>Weight (w/o wheels)</th>
                                                <td>
                                                    <p>20 LBS</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-capacity">
                                                <th>Weight Capacity</th>
                                                <td>
                                                    <p>60 LBS</p>
                                                </td>
                                            </tr>
                                            <tr class="width">
                                                <th>Width</th>
                                                <td>
                                                    <p>24″</p>
                                                </td>
                                            </tr>
                                            <tr class="handle-height-ground-to-handle">
                                                <th>Handle height (ground to handle)</th>
                                                <td>
                                                    <p>37-45″</p>
                                                </td>
                                            </tr>
                                            <tr class="wheels">
                                                <th>Wheels</th>
                                                <td>
                                                    <p>12″ air / wide track slick tread</p>
                                                </td>
                                            </tr>
                                            <tr class="seat-back-height">
                                                <th>Seat back height</th>
                                                <td>
                                                    <p>21.5″</p>
                                                </td>
                                            </tr>
                                            <tr class="head-room-inside-canopy">
                                                <th>Head room (inside canopy)</th>
                                                <td>
                                                    <p>25″</p>
                                                </td>
                                            </tr>
                                            <tr class="pa_color">
                                                <th>Color</th>
                                                <td>
                                                    <p>Black, Blue, Red, White</p>
                                                </td>
                                            </tr>
                                            <tr class="pa_size">
                                                <th>Size</th>
                                                <td>
                                                    <p>M, S</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> -->
                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <!-- <h4 class="mb-30">Customer questions & answers</h4> -->
                                                <div class="comment-list">
                                                    <?php
                                                    if ($reviewProductList != []) {
                                                        $countReview = count($reviewProductList);
                                                        $totalStar = 0;
                                                        $oneStar = 0;
                                                        $twoStar = 0;
                                                        $threeStar = 0;
                                                        $fourStar = 0;
                                                        $fiveStar = 0;
                                                        foreach ($reviewProductList as $eachReview) {
                                                            if ($eachReview['rating'] == 1) {
                                                                $oneStar++;
                                                                $percentRating = 20;
                                                            } else if ($eachReview['rating'] == 2) {
                                                                $twoStar++;
                                                                $percentRating = 40;
                                                            } else if ($eachReview['rating'] == 3) {
                                                                $threeStar++;
                                                                $percentRating = 60;
                                                            } else if ($eachReview['rating'] == 4) {
                                                                $fourStar++;
                                                                $percentRating = 80;
                                                            } else if ($eachReview['rating'] == 5) {
                                                                $fiveStar++;
                                                                $percentRating = 100;
                                                            }
                                                            $totalStar += $eachReview['rating'];
                                                    ?>
                                                            <div class="single-comment justify-content-between d-flex">
                                                                <div class="user justify-content-between d-flex col-lg-12">
                                                                    <div class="thumb text-center col-md-3">
                                                                        <!-- <img src="public/assets/imgs/page/avatar-6.jpg" alt=""> -->
                                                                        <h5><a href="#" class="text-brand"><?= $eachReview['customer_name'] ?></a></h5>
                                                                        <!-- <p class="font-xxs">Since 2012</p> -->
                                                                    </div>
                                                                    <div class="desc col-md-9">
                                                                        <div class="product-rate d-inline-block">
                                                                            <div class="product-rating" style="width: <?= $percentRating ?>%">
                                                                            </div>
                                                                        </div>
                                                                        <p><?= $eachReview['review_details'] ?></p>
                                                                        <div class="d-flex justify-content-between">
                                                                            <div class="d-flex align-items-center">
                                                                                <p class="font-xs mr-30"><?= $eachReview['created_at'] ?></p>
                                                                                <!-- <a href="#" class="text-brand btn-reply">Reply <i class="fi-rs-arrow-right"></i> </a> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php
                                                        }
                                                        $avgStar = round($totalStar / $countReview, 1);
                                                        $percentAvgStar = ($avgStar / 5) * 100;
                                                        $percentAvgOneStar = ($oneStar / $countReview) * 100;
                                                        $percentAvgTwoStar = ($twoStar / $countReview) * 100;
                                                        $percentAvgThreeStar = ($threeStar / $countReview) * 100;
                                                        $percentAvgFourStar = ($fourStar / $countReview) * 100;
                                                        $percentAvgFiveStar = ($fiveStar / $countReview) * 100;
                                                    } else {
                                                        echo "<h4 class='mb-30 text-brand'>Chưa có đánh giá nào</h4>";
                                                        $avgStar = 0;
                                                        $percentAvgStar = 0;
                                                        $percentAvgOneStar = 0;
                                                        $percentAvgTwoStar = 0;
                                                        $percentAvgThreeStar = 0;
                                                        $percentAvgFourStar = 0;
                                                        $percentAvgFiveStar = 0;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <!-- <h4 class="mb-30">Customer reviews</h4> -->
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width:<?= $percentAvgStar ?>%">
                                                        </div>
                                                    </div>
                                                    <h6><?= $avgStar ?>⭐ / 5⭐</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>5 ⭐</span>
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $percentAvgOneStar ?>%;" aria-valuemin="0" aria-valuemax="100"><?= $percentAvgOneStar ?>%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>4 ⭐</span>
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $percentAvgTwoStar ?>%;" aria-valuemin="0" aria-valuemax="100"><?= $percentAvgTwoStar ?>%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>3 ⭐</span>
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $percentAvgThreeStar ?>%;" aria-valuemin="0" aria-valuemax="100"><?= $percentAvgThreeStar ?>%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>2 ⭐</span>
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $percentAvgFourStar ?>%;" aria-valuemin="0" aria-valuemax="100"><?= $percentAvgFourStar ?>%</div>
                                                </div>
                                                <div class="progress mb-30">
                                                    <span>1 ⭐</span>
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $percentAvgFiveStar ?>%;" aria-valuemin="0" aria-valuemax="100"><?= $percentAvgFiveStar ?>%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-60">
                            <div class="col-12">
                                <h3 class="section-title style-1 mb-30">Sản phẩm liên quan</h3>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    <?php
                                    if ($relateProductList != [])
                                        foreach ($relateProductList as $eachRelateProduct) {
                                            $imageDefault = $GLOBALS['PRODUCT_DIRECTORY'] . $eachRelateProduct['product_master_image'];
                                            $iamgeHover = $GLOBALS['PRODUCT_DIRECTORY'] . $eachRelateProduct['product_image_one'];
                                    ?>
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap small hover-up">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="product-detail.php?id=<?= $eachRelateProduct['id'] ?>" tabindex="0">
                                                            <img class="default-img" src="<?= $imageDefault ?>" alt="">
                                                            <img class="hover-img" src="<?= $iamgeHover ?>" alt="">
                                                        </a>
                                                    </div>
                                                    <!-- <div class="product-action-1">
                                                        <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                        <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="wishlist.php" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                        <a aria-label="Compare" class="action-btn small hover-up" href="compare.php" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                                    </div> -->
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="hot">Hot</span>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a href="product-detail.php?id=<?= $eachRelateProduct['id'] ?>" tabindex="0"><?= $eachRelateProduct['product_name'] ?></a></h2>
                                                    <div class="rating-result" title="90%">
                                                        <span>
                                                        </span>
                                                    </div>
                                                    <div class="product-price">
                                                        <span><?= number_format($eachRelateProduct['product_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span>
                                                        <span class="old-price"><?= number_format($eachRelateProduct['product_price'] *= 1.1, 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    else {
                                        echo '<h3>Không có sản phẩm liên quan</h3>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-category mb-30">
                        <h5 class="section-title style-1 mb-30 wow fadeIn animated">DANH MỤC NỔI BẬT</h5>
                        <ul class="categories">
                            <?php
                            foreach ($subCategoryList as $eachSubCategory) {
                                echo '<li><a href="product-category.php?subCategoryId=' . $eachSubCategory['id'] . '">' . $eachSubCategory['subcategory_name'] . '</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    Fillter By Price
                    <div class="sidebar-widget price_range range mb-30">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Fill by price</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="price-filter">
                            <div class="price-filter-inner">
                                <div id="slider-range"></div>
                                <div class="price_slider_amount">
                                    <div class="label-input">
                                        <span>Range:</span><input type="text" id="amount" name="price" placeholder="Add Your Price">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item mb-10 mt-10">
                                <label class="fw-900">Color</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                    <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
                                    <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                    <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                                </div>
                                <label class="fw-900 mt-15">Item Condition</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                    <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="">
                                    <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished (27)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31" value="">
                                    <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                                </div>
                            </div>
                        </div>
                        <a href="shop.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                    </div>
                    Product sidebar Widget
                    <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Sản Phẩm Mới</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <?php
                        foreach ($newProductList as $eachNewProduct) {
                            $newProductImage = $GLOBALS['PRODUCT_DIRECTORY'] . $eachNewProduct['product_master_image'];
                        ?>
                            <div class="single-post clearfix">
                                <div class="image">
                                    <img src="<?= $newProductImage ?>" alt="#">
                                </div>
                                <div class="content pt-10">
                                    <h5><a href="product-detail.php?id=<?= $eachNewProduct['id'] ?>"><?php echo $eachNewProduct['product_name'] ?></a></h5>
                                    <p class="price mb-0 mt-5"><?php echo number_format($eachNewProduct['product_price']) ?>&#8363;</p>
                                    <div class="product-rate">
                                        <div class="product-rating" style="width:90%"></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div> -->
                <!-- add sitebar -->
                <?php include("./resource/views/include/site-bar.php") ?>
            </div>
        </div>
    </section>
</main>