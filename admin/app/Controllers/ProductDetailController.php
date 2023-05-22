<?php
class ProductDetailController extends Controller
{
    public function ProductDetailList($productDetailList)
    {
        foreach ($productDetailList as $eachProductDetail) {
?>
            <tr>
                <td><?= $eachProductDetail['id'] ?></td>
                <td><?= $eachProductDetail['product_size'] ?></td>
                <td><?= $eachProductDetail['product_color'] ?></td>
                <td><?= $eachProductDetail['product_quantity'] ?></td>
                <td>
                    <span class="<?= $eachProductDetail['product_status'] == 'In Stock' ? 'text-success' : 'text-warning' ?>">
                        <?= $eachProductDetail['product_status'] ?>
                    </span>
                </td>
                <td><?= $eachProductDetail['created_at'] ?></td>
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
<?php
        }
    }
}
?>