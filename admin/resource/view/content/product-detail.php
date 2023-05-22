<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="dashboard.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="product.php">Product</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="#">Áo Thun VietNamese</a>
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
                            <h4 class="card-title col-md-11">Data Table Product Detail</h4>
                            <div class="bootstrap-modal col-md-1">
                                <a class="btn btn-success" href="manage-product-detail.php" data-toggle="tooltip" data-placement="top" title="Add">
                                    <i class="fa fa-plus color-muted"></i>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>SIZE</th>
                                        <th>COLOR</th>
                                        <th>QUANTITY</th>
                                        <th>STATUS</th>
                                        <th>PUBLISHED ON</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>L</td>
                                        <td>Yellow</td>
                                        <td>0</td>
                                        <td>
                                            <span class="text-warning">Out of Stock</span>
                                        </td>
                                        <td>2023/01/15</td>
                                        <td>
                                            <span>
                                                <a class="btn btn-primary mb-1" href="manage-product-detail.php?id=1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-pencil color-muted"></i>
                                                </a>
                                                <a class="btn btn-danger mb-1" href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa fa-trash color-danger"></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>XL</td>
                                        <td>Yellow</td>
                                        <td>120</td>
                                        <td>
                                            <span class="text-success">In Stock</span>
                                        </td>
                                        <td>2023/01/15</td>
                                        <td>
                                            <span>
                                                <a class="btn btn-primary mb-1" href="#" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-pencil color-muted"></i>
                                                </a>
                                                <a class="btn btn-danger mb-1" href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa fa-trash color-danger"></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>SIZE</th>
                                        <th>COLOR</th>
                                        <th>QUANTITY</th>
                                        <th>STATUS</th>
                                        <th>PUBLISHED ON</th>
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