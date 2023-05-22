<?php
if (isset($_GET['id'])) {
    $none = "d-none";
    $typeForm = "Edit";
    $imgDisplay = "";
} else {
    $none = "";
    $typeForm = "Add";
    $imgDisplay = "d-none";
}
?>
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="product.php">Product</a></li>
                <li class="breadcrumb-item active"><a href="#"><?= $typeForm ?> Product</a></li>
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
                            <div class="form-group row <?= $imgDisplay ?>">
                                <label class="col-lg-3 col-form-label">Product Image</label>
                                <div class="col-lg-9">
                                    <img style="width: 150px;" class="img-fluid img-thumbnail rounded" src="public/images/member/1.jpg" alt="#">
                                </div>
                            </div>
                            <form class="form-valide" action="#" method="post">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-category">Category Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-3">
                                        <select class="form-control" id="val-category" name="val-category">
                                            <option selected value="1">Áo Nam</option>
                                            <option value="2">Quần Nam</option>
                                            <option value="2">Tất , Nón</option>
                                            <option value="2">Phụ Kiện</option>
                                        </select>
                                    </div>
                                    <label class="col-lg-3 col-form-label" for="val-sub-category">Sub-Category Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-3">
                                        <select class="form-control" id="val-sub-category" name="val-sub-category">
                                            <option selected value="1">Áo Phông</option>
                                            <option value="2">Áo Polo</option>
                                            <option value="2">Áo Hoodie</option>
                                            <option value="2">Áo TankTop</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-product">Product Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="val-product" name="val-product" placeholder="Enter a product..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-product-price">Product Price <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="val-product-price" name="val-product-price" placeholder="Enter a product price..">
                                    </div>
                                    <label class="col-lg-3 col-form-label" for="val-product-price-virtual">Product Price Virtual <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="val-product-price-virtual" name="val-product-price-virtual" placeholder="Enter a product price virtual..">
                                    </div>
                                </div>
                                <div class="form-group row <?= $none ?>">
                                    <label class="col-lg-3 col-form-label" for="val-product-quantity">Product Quantity <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="val-product-quantity" name="val-product-quantity" placeholder="Enter a product quantity..">
                                    </div>
                                </div>
                                <div class="form-group row <?= $none ?>">
                                    <label class="col-lg-3 col-form-label" for="val-product-price">Product Size <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <select id="choose-size" class="form-control select2-multi" name="tag" multiple="multiple">
                                            <option value='tag1'>M</option>
                                            <option value='tag2'>L</option>
                                            <option value='tag3'>XL</option>
                                            <option value='tag1'>XXL</option>
                                        </select>
                                    </div>
                                    <label class="col-lg-3 col-form-label" for="val-product-price-virtual">Product Color <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <select id="choose-color" class="form-control select2-multi" name="tags" multiple="multiple">
                                            <option value='tag1'>red</option>
                                            <option value='tag2'>green</option>
                                            <option value='tag3'>blue</option>
                                            <option value='tag1'>yellow</option>
                                            <option value='tag2'>black</option>
                                            <option value='tag3'>white</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-product-tag">Product Tags <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="val-product-tag" name="val-product-tag" placeholder="Enter a product tags..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-product-summary">Product Summary <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="val-product-summary" name="val-product-summary" placeholder="Enter a product summary..">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-product-detail">Product Detail <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <div class="summernote">
                                            <h3>Default Summernote</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-image">Product Image <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control" id="val-image" name="val-image" multiple="multiple" accept="image/jpeg, image/png, image/jpg">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label text-center" for="val-show">Show Image (max: 4)</label>
                                </div>
                                <div class="form-group row result">
                                    <!-- show image here -->
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-type">Product Featured <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="val-type" name="val-type">
                                            <option selected value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-type">Product Type <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="val-type" name="val-type">
                                            <option selected value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-9 ml-auto">
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