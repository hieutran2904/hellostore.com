<?php
class OrderController extends Controller
{
    public function OrderList($orderList)
    {
        foreach ($orderList as $eachOrder) {
?>
            <tr>
                <td><?= $eachOrder['id'] ?></td>
                <td><?= $eachOrder['customer_name'] ?></td>
                <td><?= $eachOrder['order_date'] ?></td>
                <td><?= number_format($eachOrder['sub_total'], 0, ',', '.') . $GLOBALS['CURRENCY'] ?></td>
                <td><?= number_format($eachOrder['delivery_charge'], 0, ',', '.') . $GLOBALS['CURRENCY'] ?></td>
                <td><?= number_format($eachOrder['discount_amount'], 0, ',', '.') . $GLOBALS['CURRENCY'] ?></td>
                <td><?= number_format($eachOrder['grand_total'], 0, ',', '.') . $GLOBALS['CURRENCY'] ?></td>
                <td>
                    <span class="text-info"><?= $eachOrder['payment_method'] ?></span>
                </td>
                <td>
                    <span class="<?= $eachOrder['transaction_status'] == 'Paid' ? 'text-success' : 'text-warning' ?>">
                        <?= $eachOrder['transaction_status'] ?>
                    </span>
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
<?php
        }
    }
}
