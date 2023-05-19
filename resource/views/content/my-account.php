﻿<?php
$eloquent = new Eloquent();
//get order
$orderList = $eloquent->selectData(['*'], 'orders', ['customer_id' => $_SESSION['SSCF_login_id']], [], [], [], ['DESC' => 'id']);
// print_r($orderList);

if ($_SESSION['SSCF_login_user_image'] == "no-image.png") {
    $customerImageName = "no-image.png";
    $customerImagePath = $GLOBALS['NO_IMAGE'];
} else {
    $customerImageName = $_SESSION['SSCF_login_user_image'];
    $customerImagePath = $GLOBALS['CUSTOMER_DIRECTORY'] . $_SESSION['SSCF_login_user_image'];
}
?>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php" rel="nofollow">Trang chủ</a>
                <span></span> Tài khoản
            </div>
        </div>
    </div>
    <section class="pt-50 pb-50">
        <div class="container">
            <!-- start popup review -->
            <div id="popup-main" class="">
                <div id="backdrop" class=""></div>
                <div class="row m-auto popup" id="popup">
                    <div class="card-body text-center">
                        <img src="public/assets/imgs/logo/logoshop2023.png" alt="">
                        <a id="close-popup" class="text-right-btn-close" href="">X</a>
                        <h2 class="text-brand">Đánh giá của bạn</h2>
                        <br>
                        <div class="rating">
                            <input type="radio" name="rating" class="stars-rating" value="5" id="5">
                            <label for="5">☆</label>
                            <input type="radio" name="rating" class="stars-rating" value="4" id="4">
                            <label for="4">☆</label>
                            <input type="radio" name="rating" class="stars-rating" value="3" id="3">
                            <label for="3">☆</label>
                            <input type="radio" name="rating" class="stars-rating" value="2" id="2">
                            <label for="2">☆</label>
                            <input type="radio" name="rating" class="stars-rating" value="1" id="1">
                            <label for="1">☆</label>
                        </div>
                        <!-- lay id cua bang review de so sanh sau do thuc hien add or update -->
                        <input type="hidden" name="" id="idReviewDB" value="">
                        <!-- lay ra id san pham danh gia -->
                        <input type="hidden" name="" id="idProductSC" value="">
                        <div class="comment-area"> <textarea id="review-detail" class="form-control" placeholder="Bình luận ..." rows="30"></textarea> </div>
                        <button id="btn-submit-review" type="button">OK</button>
                    </div>
                </div>
            </div>
            <!-- end popup review -->
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Chi tiết tài khoản</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="change-password-tab" data-bs-toggle="tab" href="#change-password" role="tab" aria-controls="change-password" aria-selected="false"><i class="fi-rs-key mr-10"></i>Đổi mật khẩu</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Đơn hàng</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="?exit=yes"><i class="fi-rs-sign-out mr-10"></i>Đăng xuất</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content dashboard-content">
                                <div class="tab-pane fade active show" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Tài khoản <span id="customer_name_status" class="text-brand"><?= $_SESSION['SSCF_login_user_name'] ?></span></h5>
                                        </div>
                                        <div class="card-body">
                                            <form id="fupForm" name="enq" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Họ & Tên <span class="required text-brand">*</span></label>
                                                        <input required="" class="form-control square customer_name" name="dname" type="text" value="<?= $_SESSION['SSCF_login_user_name'] ?>">
                                                    </div>
                                                    <div class="form-group controls col-md-12">
                                                        <label class="control-label col-md-2 ">Ảnh</label>
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <input name="customer_image" type="file" class="default customer_image" onchange="readURL(this);" accept=".jpg, .png, .jpeg" set-to="div7" value="<?= $customerImageName ?>" />
                                                            <span class="fileupload-preview"></span>
                                                            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                                        </div>
                                                    </div>
                                                    <div class="form-group controls col-md-9">
                                                        <label class="control-label col-md-2">Hiển thị</label>
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-new thumbnail" style="width: 150px; height: 150px;">
                                                                <img class="img-fluid img-thumbnail rounded customer_image_display" style="height: 150px; width: 150px;" src="<?= $customerImagePath ?>" alt="Avt khách hàng" id="div7" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Số điện thoại <span class="required text-brand">*</span></label>
                                                        <input required="" class="form-control square customer_phone" name="dphone" type="text" value="<?= $_SESSION['SSCF_login_user_mobile'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Địa chỉ <span class="required text-brand">*</span></label>
                                                        <input required="" class="form-control square customer_address" name="address" type="text" value="<?= $_SESSION['SSCF_login_user_address'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Email <span class="required text-brand">*</span></label>
                                                        <input required="" readonly class="form-control square" name="email" type="email" value="<?= $_SESSION['SSCF_login_user_email'] ?>">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" name="submit" id="submit-info-customer" class="btn btn-fill-out submit" value="Submit">Lưu</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Thay đổi mật khẩu</h5>
                                        </div>
                                        <div class="card-body">
                                            <form id="fupForm-changePassword">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Mật khẩu cũ <span class="required text-brand">*</span></label>
                                                        <input required="" class="form-control square customer_pass_current" name="password" type="password" value="<?= $_SESSION['SSCF_login_user_password'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Mật khẩu mới <span class="required text-brand">*</span></label>
                                                        <input required="" class="form-control square customer_npass" name="npass" type="password" value="">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Nhập lại mật khẩu mới <span class="required text-brand">*</span></label>
                                                        <input required="" class="form-control square customer_cpass" name="cpass" type="password" value="">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" name="submit" id="submit-change-password" class="btn btn-fill-out submit" value="Submit">Lưu</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Đơn hàng của bạn</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Mã</th>
                                                            <th>Ngày đặt hàng</th>
                                                            <th>Trạng thái</th>
                                                            <th>Phí giao hàng</th>
                                                            <th>Giảm giá</th>
                                                            <th>Tổng thanh toán</th>
                                                            <th>Xem chi tiết</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($orderList as $eachOrder) {
                                                        ?>
                                                            <tr>
                                                                <td>#<?php echo $eachOrder['id']; ?></td>
                                                                <td><?php echo $eachOrder['order_date']; ?></td>
                                                                <td><?php echo $eachOrder['order_item_status']; ?></td>
                                                                <td><?php echo number_format($eachOrder['delivery_charge'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></td>
                                                                <td><?php echo number_format($eachOrder['discount_amount'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></td>
                                                                <td><?php echo number_format($eachOrder['grand_total'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></td>
                                                                <td><a data-itemid="<?= $eachOrder['id'] ?>" class="btn-small d-block view-detail">👀</a></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-10" id="load-order-items">
                                        <!-- load order items -->
                                    </div>
                                </div>
                                <!-- <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Orders tracking</h5>
                                        </div>
                                        <div class="card-body contact-from-area">
                                            <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <form class="contact-form-style mt-30 mb-50" action="#" method="post">
                                                        <div class="input-style mb-20">
                                                            <label>Order ID</label>
                                                            <input name="order-id" placeholder="Found in your order confirmation email" type="text" class="square">
                                                        </div>
                                                        <div class="input-style mb-20">
                                                            <label>Billing email</label>
                                                            <input name="billing-email" placeholder="Email you used during checkout" type="email" class="square">
                                                        </div>
                                                        <button class="submit submit-auto-width" type="submit">Track</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Billing Address</h5>
                                                </div>
                                                <div class="card-body">
                                                    <address>000 Interstate<br> 00 Business Spur,<br> Sault Ste. <br>Marie, MI 00000</address>
                                                    <p>New York</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Shipping Address</h5>
                                                </div>
                                                <div class="card-body">
                                                    <address>4299 Express Lane<br>
                                                        Sarasota, <br>FL 00000 USA <br>Phone: 1.000.000.0000</address>
                                                    <p>Sarasota</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>