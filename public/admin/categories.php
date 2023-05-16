<?php require_once 'header.php' ?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
        <h1>Categories Manager</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <!--close-top-serch-->
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><a href="form.php?functionType=categories"> <i class="icon-plus"></i>
                            </a></span>
                        <h5>Categories</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Products</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $countProducts = 0;
                                $page = 1;
                                $resultsPerPage = 5;
                                // $totalLinks = ceil($totalResults/$resultsPerPage);
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                }
                                $list_of_category = Category::getAllCategories_andCreatePagination($page, $resultsPerPage);
                                $totalResults = count(Category::getAllCategory());
                                // Output:
                                echo "<p style=\"text-align:center;\"><b>There are $totalResults results.</b></p>";
                                foreach ($list_of_category as $key => $value) {
                                    if ($value['category_name'] == 'All') {
                                        $countProducts = count(Category::getCountProducts_ByCategory($value['category_id'], 'default_category'));
                                    } else {
                                        $countProducts = count(Category::getCountProducts_ByCategory($value['category_id'], 'category'));
                                    }

                                ?>
                                    <tr class="">
                                        <td>
                                            <h5><?php echo $value['category_name']; ?></h5>
                                        </td>
                                        <td><?= $countProducts ?> products</td>
                                        <td>
                                            <a href="form_update.php?functionType=categories&category_id=<?php echo $value['category_id']; ?>" class="btn btn-success btn-mini">Edit</a>
                                            <a href="delete_categories.php?category_id=<?php echo $value['category_id']; ?>" class="btn btn-danger btn-mini">Delete</a>
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
    <div style="text-align: center;">
        <?php
        echo Category::paginate("?", $page, $totalResults, $resultsPerPage, 1);
        ?>
    </div>
</div>
<!-- END CONTENT -->
<!--Footer-part-->
<?php
if (isset($_GET['deleteResult']) == TRUE) {
    if ($_GET['deleteResult'] == 1) {
        echo "<script type='text/javascript'>alert('Deleted successfully!');</script>";
    } elseif ($_GET['deleteResult'] == 0) {
        echo "<script type='text/javascript'>alert('Unable to delete! Because there is the existence of products that belong to this Category.');</script>";
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