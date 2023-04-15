<?php
class HomeController extends Controller
{
    public function productLister($productList)
    {
        foreach ($productList as $eachProduct) {
            if (empty($eachProduct['product_master_image']))
                $productImage = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
            else
                $productImage = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
            echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
            <div class="product-cart-wrap mb-30">
                <div class="product-img-action-wrap">
                    <div class="product-img product-img-zoom">
                        <a href="product-details.html">
                            <img class="default-img" src="'.$GLOBALS['PRODUCT_DIRECTORY'].''.$eachProduct['product_master_image'].'" alt="">
                            <img class="hover-img" src="public/assets/imgs/shop/product-1-2.jpg" alt="">
                        </a>
                    </div>
                    <div class="product-action-1">
                        <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                        <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i class="fi-rs-heart"></i></a>
                        <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a>
                    </div>
                    <div class="product-badges product-badges-position product-badges-mrg">
                        <span class="hot">Hot</span>
                    </div>
                </div>
                <div class="product-content-wrap">
                    <div class="product-category">
                        <a href="shop.html">Clothing</a>
                    </div>
                    <h2><a href="product-details.html">'. $eachProduct['product_name'] .'</a></h2>
                    <div class="rating-result" title="90%">
                        <span>
                            <span>90%</span>
                        </span>
                    </div>
                    <div class="product-price">
                        <span>$238.85 </span>
                        <span class="old-price">$245.8</span>
                    </div>
                    <div class="product-action-1 show">
                        <a aria-label="Add To Cart" class="action-btn hover-up" href="cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                    </div>
                </div>
            </div>
        </div>';
        }
    }
}
