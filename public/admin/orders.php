<?php require_once 'header.php' ?>
<?php 
    function getCustomerName($cartId) {
        $customerId = Cart::getCustomerId_ByCartId($cartId)[0]['customerid'];
        return User::getUserName($customerId)['username'];
    } 
    function getProductName($productId) {
        return Product::getProduct_ByID($productId)[0]['name'];
    } 
    function getOrdersDetail($cart_id) {
        return OrderDetail::getOrderDetail_ByCartId($cart_id);
    } 

?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="./index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
        <h1>Orders Manager</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <!--close-top-serch-->
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <h5>Orders</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th class='mobile-hidden'>Instruction</th>
                                    <th>Products List</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $page = 1;
                                    $resultsPerPage = 5;
                                    if (isset($_GET['page'])) {
                                        $page = $_GET['page'];
                                    }
                                    $list_of_orders = Order::getOrders_andCreatePagination($page, $resultsPerPage);
                                    $totalResults = count(Order::getAllOrders());
                                    foreach ($list_of_orders as $key => $value) :
                                ?>
                                <tr>
                                    <td>
                                        <?= getCustomerName($value['cart_id'])?>
                                    </td>
                                    <td>
                                        <p>
                                            <?= $value['address']?>
                                        </p>
                                    </td>
                                    <td>
                                        <ul>
                                            <li>Phone: <?= $value['phone']?></li>
                                            <li>Email: <?= $value['email']?></li>
                                        </ul>
                                    </td>
                                    <?php 
                                        $instructionTxt = (strlen($value['instructions']) > 0) ? $value['instructions'] : 'NONE';
                                    ?>
                                    <td class='mobile-hidden'>
                                        <p><?= $instructionTxt?></p>
                                    </td>
                                    <td>
                                        <ul>
                                            <?php 
                                            foreach (getOrdersDetail($value['cart_id']) as $key2 => $value2) :
                                            ?>
                                            <li>
                                                <a href="./index.php?keyword=<?= getProductName($value2['productid'])?>" target='_blank'><?= getProductName($value2['productid'])?></a>  
                                                x<span><b><?= $value2['quantity']?></b></span>
                                            </li>
                                            <?php endforeach;?>
                                        </ul>
                                        Total Price: <b>$<?= $value['total_price']?></b>
                                    </td>
                                    <td>
                                        <?php
                                            if ($value['confirm'] == 0) { 
                                        ?>
                                        <a href="./check_order.php?cartId=<?= $value['cart_id']?>&orderId=<?= $value['order_id']?>&action=confirm" class="btn btn-success btn-mini btn-block">CONFIRM</a>
                                        <?php } else {?>
                                        <a href="./check_order.php?cartId=<?= $value['cart_id']?>&orderId=<?= $value['order_id']?>&action=cancelconfirm" class="btn btn-danger btn-mini btn-block">CANCEL</a>
                                        <?php }?>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="text-align: center;">
        <?=
            Order::paginate("?", $page, $totalResults, $resultsPerPage, 1);
        ?>
    </div>
</div>
<!-- END CONTENT -->
<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> 2021 &copy; Uneo</div>
</div>
<?php

if (isset($_GET['resultConfirm'])) {
    if ($_GET['resultConfirm'] == 1) {
        echo "<script type='text/javascript'>alert('Confirm successfully!');</script>";
    } elseif ($_GET['resultConfirm'] == -1) {
        echo "<script type='text/javascript'>alert('Confirm unsuccessfully!');</script>";
    }
}

if (isset($_GET['resultCancel'])) {
    if ($_GET['resultCancel'] == 1) {
        echo "<script type='text/javascript'>alert('Cancel successfully!');</script>";
    } elseif ($_GET['resultCancel'] == -1) {
        echo "<script type='text/javascript'>alert('Cancel unsuccessfully!');</script>";
    }
}
?>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.uniform.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.tables.js"></script>
</body>

</html>