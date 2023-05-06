<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" /> -->
<?php
$eloquent = new Eloquent();

// item order last insert
$lastInsertOrderId = $eloquent->selectData(['*'], 'orders', ['customer_id' => $_SESSION['SSCF_login_id']], [], [], [], ['DESC' => 'id'], ['START' => 0, 'END' => 1]);
// print_r($lastInsertOrderId);

//get order items detail
$orderItems = $eloquent->selectOrderItems($_SESSION['SSCF_login_id'], $lastInsertOrderId[0]['id']);
//print_r($orderItems);

//get shipping info
$shippings = $eloquent->selectData(['*'], 'shippings', ['customer_id' => $_SESSION['SSCF_login_id']], [], [], [], ['DESC' => 'id'], ['START' => 0, 'END' => 1]);
$shippingItem = $shippings[0];

//get invoice info
$invoice = $lastInsertOrderId[0];

//delete cart
$deleteCart = $eloquent->deleteData('shopcarts', ['customer_id' => $_SESSION['SSCF_login_id']]);

//set price session return 0
$_SESSION['priceSub'] = 0;
$_SESSION['priceShip'] = 0;
$_SESSION['priceDiscount'] = 0;
$_SESSION['priceTotal'] = 0;
$_SESSION['PRICE_DISCOUNT_AMOUNT'] = 0;

?>
<div class="container">
    <div class="page-content container">
        <div class="page-header text-blue-d2">
            <h6 class="page-title text-secondary-d1">
                <!-- Invoice -->
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-60"></i>
                    <!-- ID: #111-222 -->
                </small>
            </h6>

            <div class="page-tools">
                <div class="action-buttons">
                    <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        In
                    </a>
                    <!-- <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                        <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                        Export
                    </a> -->
                </div>
            </div>
        </div>

        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center text-150">
                                <i class="fa fa-book fa-2x text-success-m2 mr-1"></i>
                                <span class="text-default-d3">HELLO STORE'S</span>
                            </div>
                        </div>
                    </div>
                    <!-- .row -->

                    <hr class="row brc-default-l1 mx-n1 mb-4" />

                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">Người nhận:</span>
                                <span class="text-600 text-110 text-blue align-middle"><?= $shippingItem['shipping_name'] ?></span>
                            </div>
                            <div class="text-grey-m2">
                                <div class="my-1">
                                    Địa chỉ: <?= $shippingItem['shipping_address'] ?>
                                </div>
                                <div class="my-1">
                                    Thành phố: <?= $shippingItem['shipping_city'] ?>
                                </div>
                                <div class="my-1">
                                    <i class="fa fa-phone fa-flip-horizontal text-secondary"></i>
                                    <b class="text-600">Số điện thoại: <?= $shippingItem['shipping_phone'] ?></b>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->

                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <hr class="row brc-default-l1 mx-n1 mb-4" />
                            <div class="text-grey-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                    Hóa đơn
                                </div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID: </span>#<?= $invoice['transaction_id'] ?></div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Ngày đặt hàng: </span><?= $invoice['order_date'] ?></div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Phương thức thanh toán: </span><?= $invoice['payment_method'] ?></div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>

                    <div class="mt-4">
                        <div class="row text-600 text-white bgc-default-tp1 py-25">
                            <div class="d-none d-sm-block col-1">#</div>
                            <div class="col-5 col-sm-3">Sản phẩm</div>
                            <div class="d-none d-sm-block col-2 col-sm-2">Size | Color</div>
                            <div class="col-4 col-sm-2">Số lượng</div>
                            <div class="d-none d-sm-block col-sm-2">Giá</div>
                            <div class="col-2">Tổng</div>
                        </div>

                        <div class="text-95 text-secondary-d3">
                            <?php
                            $i = 1;
                            foreach ($orderItems as $eachItem) {
                            ?>
                                <div class="row mb-2 mb-sm-0 py-25">
                                    <div class="d-none d-sm-block col-1"><?= $i ?></div>
                                    <div class="col-5 col-sm-3"><?= $eachItem['product_name'] ?></div>
                                    <div class="d-none d-sm-block col-2 col-sm-2"><?= $eachItem['product_size'] . " | " . $eachItem['product_color'] ?></div>
                                    <div class="col-4 col-sm-2"><?= $eachItem['product_quantity'] ?></div>
                                    <div class="d-none d-sm-block col-sm-2"><?= number_format($eachItem['product_price'], 0, ",", ".") . $GLOBALS['CURRENCY']  ?></div>
                                    <div class="col-2"><?= number_format($eachItem['sub_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></div>
                                </div>
                            <?php
                                $i++;
                            }
                            ?>
                            <!-- <div class="row mb-2 mb-sm-0 py-25">
                                <div class="d-none d-sm-block col-1">1</div>
                                <div class="col-5 col-sm-3">Áo T-Shirt Glaxy</div>
                                <div class="d-none d-sm-block col-2 col-sm-2">XL | Black</div>
                                <div class="col-4 col-sm-2">1</div>
                                <div class="d-none d-sm-block col-sm-2">159.000đ</div>
                                <div class="col-2">159.000đ</div>
                            </div> -->
                        </div>
                        <div class="row border-b-2 brc-default-l2"></div>

                        <!-- or use a table instead -->
                        <!--
            <div class="table-responsive">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <thead class="bg-none bgc-default-tp1">
                        <tr class="text-white">
                            <th class="opacity-2">#</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th width="140">Amount</th>
                        </tr>
                    </thead>

                    <tbody class="text-95 text-secondary-d3">
                        <tr></tr>
                        <tr>
                            <td>1</td>
                            <td>Domain registration</td>
                            <td>2</td>
                            <td class="text-95">$10</td>
                            <td class="text-secondary-d2">$20</td>
                        </tr> 
                    </tbody>
                </table>
            </div>
            -->

                        <div class="row mt-3">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                <!-- Extra note such as company or payment information... -->
                            </div>

                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        Tổng tiền hàng
                                    </div>
                                    <div class="col-5">
                                        <span class="text-110 text-secondary-d1"><?= number_format($invoice['sub_total'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span>
                                    </div>
                                </div>

                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        Phí vận chuyển
                                    </div>
                                    <div class="col-5">
                                        <span class="text-110 text-secondary-d1"><?= number_format($invoice['delivery_charge'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span>
                                    </div>
                                </div>

                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        Giảm giá
                                    </div>
                                    <div class="col-5">
                                        <span class="text-110 text-secondary-d1"><?= number_format($invoice['discount_amount'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span>
                                    </div>
                                </div>

                                <div class="row my-2 align-items-center bgc-primary-l3">
                                    <div class="col-7 text-right">
                                        Tổng thanh toán
                                    </div>
                                    <div class="col-5">
                                        <span class="text-150 text-success-d3 opacity-2"><?= number_format($invoice['grand_total'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr />

                        <!-- <div>
                        <span class="text-secondary-d1 text-105">Thank you for your business</span>
                        <a href="#" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</a>
                    </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center text-150">
                                    <i class="fa fa-book fa-2x text-success-m2 mr-1"></i>
                                    <a href="#" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0 mb-10">Xong</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>