<?php
require_once 'header.php' ?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="./index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
        <h1>Manage Products</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <!--start-top-serch-->
        <div id="searchProduct" style="float: left;">
            <input type="text" placeholder="Name Search..." id='searchInput'>
            <ul id="searchList" class="list-group px-3 pb-3" style='list-style: none'>
            </ul>
        </div>
        <!--close-top-serch-->
        <div class="row-fluid">
            <div class="span12 col-12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><a href="./form.php?functionType=products"> <i class="icon-plus"></i>
                            </a></span>
                        <?php foreach (Category::getAllCategory_RemoveAll() as $key => $value) :?>
                            <h5 class='list-category-item' id=<?= $value['category_id']?>><?= $value['category_name']?></h5>
                        <?php endforeach;?>

                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th class='mobile-hidden'>Description</th>
                                    <th>Price</th>
                                    <th>Vote</th>
                                    <th>Receipt</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="productsList">
                                <?php
                                $page = 1;
                                $resultsPerPage = 5;
                                // $totalLinks = ceil($totalResults/$resultsPerPage);
                                if (isset($_GET['page']) == true) {
                                    $page = $_GET['page'];
                                }
                                $list_of_products = Product::getAllProducts_andCreatePagination($page, $resultsPerPage);
                                $totalResults = count(Product::getAllProductsAdmin());
                                if (isset($_GET['keyword'])) {
                                    $keyWord = $_GET['keyword'];
                                    if ($keyWord != ' ') {
                                        $list_of_products = Product::searchProduct_andCreatePagination($_GET['keyword'], $page, $resultsPerPage);
                                        $totalResults = count(Product::searchProduct($_GET['keyword']));
                                    }
                                }
                                // Output:
                                echo "<p style=\"text-align:center;\" id='totalResult'><b>There are $totalResults results.</b></p>";
                                foreach ($list_of_products as $key => $value) {
                                    ?>
                                    <tr >
                                        <td width=250>
                                            <img src='<?= $value['pro_image']; ?>' alt="" class='img-fluid'>
                                        </td>
                                        <td>
                                            <h5><?= $value['name']; ?></h5>
                                        </td>
                                        <td class='mobile-hidden'>
                                            <p><?= substr($value['description'], 0, 100).' ...'; ?></p>
                                        </td>
                                        <td>
                                            <h5><?= '$'.$value['price']; ?></h5>
                                        </td>
                                        <td> <h5><?= $value['vote']; ?></h5></td>
                                        <td> <h5><?= $value['receipt']; ?></h5></td>
                                        <td> <h5><?= date_format(date_create($value['created_at']), 'F j, Y'); ?></h5></td>
                                        <td>
                                            <a href="form_update.php?functionType=products&id=<?= $value['id']; ?>" class="btn btn-success btn-mini" style='margin-bottom: 5px'>Edit</a>
                                            <a href="delete_product.php?id=<?= $value['id']; ?>" class="btn btn-danger btn-mini" style='margin-bottom: 5px'>Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="text-align:center;" id='paginate'>
        <?php
        if (isset($_GET['keyword']) == true) {
            echo Product::paginate("?keyword=" . $_GET['keyword'] . "&", $page, $totalResults, $resultsPerPage, 2);
        } else {
            echo Product::paginate("?", $page, $totalResults, $resultsPerPage, 1);
        }
        ?>
    </div>
</div>
<!-- END CONTENT -->
<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> 2017 &copy; TDC - Lập trình web 1</div>
</div>
<?php
if (isset($_GET['deleteResult']) == TRUE) {
    if ($_GET['deleteResult'] == 1) {
        echo "<script type='text/javascript'>alert('Deleted successfully!');</script>";
    } elseif ($_GET['deleteResult'] == 0) {
        echo "<script type='text/javascript'>alert('Deleted unsuccessfully!');</script>";
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
<script src="./js/script.js"></script>
</body>

</html>