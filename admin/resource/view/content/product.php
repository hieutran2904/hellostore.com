<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0)">Home</a>
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
                            <h4 class="card-title col-md-11">Data Table Product</h4>
                            <div class="bootstrap-modal col-md-1">
                                <a class="btn btn-success" href="manage-product.php" data-toggle="tooltip" data-placement="top" title="Add">
                                    <i class="fa fa-plus color-muted"></i>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>PRODUCT NAME</th>
                                        <th>PRICE</th>
                                        <th>SUB CATEGORY</th>
                                        <th>STATUS</th>
                                        <th>FEATURED</th>
                                        <th>PUBLISHED ON</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>123</td>
                                        <td><img style="width: 80px;" class="img-fluid rounded mx-auto d-block" src="public/images/member/1.jpg" alt="#"></td>
                                        <td>Áo Thun VietNamese</td>
                                        <td>219.000đ</td>
                                        <td>Áo t-shirt</td>
                                        <td>
                                            <span class="text-warning">Inactive</span>
                                        </td>
                                        <td>
                                            <span class="text-success">Yes</span>
                                        </td>
                                        <td>2023/01/15</td>
                                        <td>
                                            <span>
                                                <a class="btn btn-info mb-1" href="product-detail.php?id=1" data-toggle="tooltip" data-placement="top" title="View Detail">
                                                    <i class="fa fa-eye color-muted"></i>
                                                </a>
                                                <a class="btn btn-primary mb-1" href="manage-product.php?id=1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-pencil color-muted"></i>
                                                </a>
                                                <a class="btn btn-danger mb-1" href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa fa-trash color-danger"></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>321</td>
                                        <td><img style="width: 80px;" class="img-fluid rounded mx-auto d-block" src="public/images/member/2.jpg" alt="#"></td>
                                        <td>Áo Thun Cooler</td>
                                        <td>219.000đ</td>
                                        <td>Áo t-shirt</td>
                                        <td>
                                            <span class="text-success">Active</span>
                                        </td>
                                        <td>
                                            <span class="text-success">Yes</span>
                                        </td>
                                        <td>2023/01/15</td>
                                        <td>
                                            <span>
                                                <a class="btn btn-info mb-1" href="product-detail.php?id=1" data-toggle="tooltip" data-placement="top" title="View Detail">
                                                    <i class="fa fa-eye color-muted"></i>
                                                </a>
                                                <a class="btn btn-primary mb-1" href="manage-product.php?id=2" data-toggle="tooltip" data-placement="top" title="Edit">
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
                                        <th>IMAGE</th>
                                        <th>PRODUCT NAME</th>
                                        <th>PRICE</th>
                                        <th>SUB CATEGORY</th>
                                        <th>STATUS</th>
                                        <th>FEATURED</th>
                                        <th>PUBLISHED ON</th>
                                        <th>Action</th>
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