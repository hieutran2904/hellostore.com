<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="dashbroad.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0)">Order</a>
                </li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h4 class="card-title col-md-11">Data Table Order</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>CUSTOMER</th>
                                        <th>ORDER DATE</th>
                                        <th>SUB TOTAL</th>
                                        <th>DELIVERY CHARGE</th>
                                        <th>DISCOUNT AMOUNT</th>
                                        <th>GRAND TOTAL</th>
                                        <th>PAYMENT METHOD</th>
                                        <th>TRANSACTION STATUS</th>
                                        <th>ORDER STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Trần Trung Hiếu</td>
                                        <td>2023/01/15</td>
                                        <td>323.000đ</td>
                                        <td>0đ</td>
                                        <td>50.000đ</td>
                                        <td>450.000đ</td>
                                        <td>
                                            <span class="text-warning">VNPAY</span>
                                        </td>
                                        <td>
                                            <span class="text-success">Paid</span>
                                        </td>
                                        <td>
                                            <span class="text-success">Pending</span>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary mb-1" href="edit-order.php?id=2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa fa-pencil color-muted"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>CUSTOMER</th>
                                        <th>ORDER DATE</th>
                                        <th>SUB TOTAL</th>
                                        <th>DELIVERY CHARGE</th>
                                        <th>DISCOUNT AMOUNT</th>
                                        <th>GRAND TOTAL</th>
                                        <th>PAYMENT METHOD</th>
                                        <th>TRANSACTION STATUS</th>
                                        <th>ORDER STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
    Content body end
***********************************-->