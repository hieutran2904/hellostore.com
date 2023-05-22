<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="order.php">Order</a></li>
                <li class="breadcrumb-item active"><a href="manage-category.php">Order Detail ID: 1</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="#" method="post">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="col-lg-12 col-form-label">Customer Name: </label>
                                        <div class="col-lg-12">
                                            <input readonly type="text" class="form-control" value="Trần Trung Hiếu">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="col-lg-12 col-form-label">Order Date: </label>
                                        <div class="col-lg-12">
                                            <input readonly type="text" class="form-control" value="2023/01/01">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label class="col-lg-12 col-form-label">Sub Total: </label>
                                        <div class="col-lg-12">
                                            <input readonly type="text" class="form-control" value="1000000">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="col-lg-12 col-form-label">Delivery Charge: </label>
                                        <div class="col-lg-12">
                                            <input readonly type="text" class="form-control" value="5000">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="col-lg-12 col-form-label">Discount Amount: </label>
                                        <div class="col-lg-12">
                                            <input readonly type="text" class="form-control" value="132555">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="col-lg-12 col-form-label">Grand Total: </label>
                                        <div class="col-lg-12">
                                            <input readonly type="text" class="form-control" value="123132">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label class="col-lg-12 col-form-label">Payment Method: </label>
                                        <div class="col-lg-12">
                                            <input readonly type="text" class="form-control" value="VNPAY">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-lg-12 col-form-label" for="val-status">Transaction Status <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-12">
                                            <select class="form-control" id="val-status" name="val-status">
                                                <option selected value="1">Paid</option>
                                                <option value="2">Unpaid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-lg-12 col-form-label" for="val-status">Order Status <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-12">
                                            <select class="form-control" id="val-status" name="val-status">
                                                <option selected value="1">Pending</option>
                                                <option value="2">Processing</option>
                                                <option value="3">Completed</option>
                                                <option value="4">Cancel</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 ml-auto text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>