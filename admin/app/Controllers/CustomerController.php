<?php
class CustomerController extends Controller
{
    public function CustomerList($customerList)
    {
        foreach ($customerList as $eachCustomer) {
?>
            <tr>
                <td><?= $eachCustomer['id'] ?></td>
                <td><img style="width: 80px;" class="img-fluid rounded" src="<?= $GLOBALS['CUSTOMERS_DIRECTORY'] . $eachCustomer['customer_image'] ?>" alt="#"></td>
                <td><?= $eachCustomer['customer_name'] ?></td>
                <td><?= $eachCustomer['customer_email'] ?></td>
                <td><?= $eachCustomer['customer_mobile'] ?></td>
                <td><span class="text-success"><?= $eachCustomer['customer_status'] ?></span></td>
                <td><?= $eachCustomer['created_at'] ?></td>
                <td>
                    <span>
                        <a class="btn btn-primary" href="manage-customer.php?id=<?= $eachCustomer['id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil color-muted"></i>
                        </a>
                    </span>
                </td>
            </tr>
<?php
        }
    }
}
