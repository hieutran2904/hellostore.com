<?php
class HomeController extends Controller
{
    public function productLister($productList, $col = 3, $typeCard = ['' => ''])
    {
        foreach ($productList as $eachProduct) {
            if (empty($eachProduct['product_master_image']))
                $productImage = $GLOBALS['PRODUCT_DIRECTORY'] . "Image_not_available.png";
            else
                $productImage = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
            echo '<div class="col-lg-' . $col . ' col-md-4 col-sm-6 col-xs-6 col-6">
                <div class="product-cart-wrap mb-30">
                    <div class="product-img-action-wrap">
                        <div class="product-img product-img-zoom">
                            <a href="product-detail.php?id=' . $eachProduct['id'] . '">
                                <img class="default-img" src="' . $productImage . '" alt="">
                            </a>
                        </div>
                        <form method="post" action="" class="product-action-1">
                            <input type="hidden" name="cart_product_id" value="' . $eachProduct['id'] . '"/>
                            <input type="hidden" name="cart_product_quantity" value="1"/>
                            <button name="quick_view" aria-label="Xem nhanh" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                <i class="fi-rs-eye"></i>
                            </button>
                            <button name="add_to_favourite" aria-label="Yêu thích" class="action-btn hover-up">
                                <i class="fi-rs-heart"></i>
                            </button>
                            <button name="add_to_cart" aria-label="Thêm vào giỏ hàng" class="action-btn hover-up">
                                <i class="fi-rs-shopping-bag-add"></i>
                            </button>
                        </form>
                        <div class="product-badges product-badges-position product-badges-mrg">
                            <span class="' . key($typeCard) . '">' . ucwords($typeCard[key($typeCard)]) . '</span>
                        </div>
                    </div>
                    <div class="product-content-wrap">
                        <div class="product-category">
                            <a href="shop.html">Clothing</a>
                        </div>
                        <h2><a href="product-detail.php?id=' . $eachProduct['id'] . '">' . $eachProduct['product_name'] . '</a></h2>
                        <div class="rating-result" title="90%">
                            <span>
                                <span>90%</span>
                            </span>
                        </div>
                        <div class="product-price">
                            <span>' . number_format($eachProduct['product_price']) . '&#8363; </span>
                            <span class="old-price">' . number_format($eachProduct['product_price'] *= 1.1) . '&#8363; </span>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }
}
