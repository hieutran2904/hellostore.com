<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="sub-category.php">Sub-Category</a></li>
                <li class="breadcrumb-item active"><a href="#">Add Sub-Category</a></li>
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
                                    <label class="col-lg-3 col-form-label" for="val-category">Sub-Category Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="val-category" name="val-category" placeholder="Enter a sub-category..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-category">Category Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="val-category" name="val-category">
                                            <option selected value="1">Áo Nam</option>
                                            <option value="2">Quần Nam</option>
                                            <option value="2">Tất , Nón</option>
                                            <option value="2">Phụ Kiện</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-status">Status <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="val-status" name="val-status">
                                            <option selected value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-image">Image <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control" id="val-image" name="val-image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="val-image">Show</label>
                                    <div class="col-lg-9">
                                        <img style="width: 600px; height: 200px;" class="img-fluid img-thumbnail rounded" src="public/images/member/1.jpg" alt="#">
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