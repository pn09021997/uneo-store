<?php require_once 'header.php'; ?>
>
    <!-- BEGIN CONTENT -->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="./index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i>
                    Home</a></div>
            <h1>Adding Manager</h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                            <h5></h5>
                        </div>
                        <div class="widget-content nopadding">


                            <!-- ____________________________________________________________________________________________________ -->
                            <!-- FUNCTION: Insert products. -->
                            <?php
                            if (isset($_GET['functionType']) == TRUE && $_GET['functionType'] == "products") {
                            ?>
                                <!-- BEGIN USER FORM -->
                                <form action="./insert_product.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">Name :</label>
                                        <div class="controls">
                                            <input type="text" class="span11" placeholder="Product name" name="name" required /> *
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Choose a manufacture:</label>
                                        <div class="controls">
                                            <?php
                                            $list_of_category = Category::getAllCategory_RemoveAll();
                                            ?>
                                            <select name="category_id" id="cate">
                                                <?php
                                                foreach ($list_of_category as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value['category_id']; ?>"><?php echo $value['category_name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select> *
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="control-group">
                                            <label class="control-label">Choose an image (URL):</label>
                                            <div class="controls">
                                                <input type="text" name="newImg" id="newImg" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Description</label>
                                            <div class="controls">
                                                <textarea class="span11" placeholder="Description" name="description"></textarea>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Price :</label>
                                                <div class="controls">
                                                    <input type="text" class="span11" placeholder="price" name="price" required /> *
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Receipt :</label>
                                                <div class="controls">
                                                    <input type="number" size="4" class="input-text qty text" title="Qty" value="100" name="receipt" min="1" step="1">
                                                </div>
                                            </div>
                                            <div class="form-actions" style="text-align:center;">
                                                <button type="submit" name="submit" class="btn btn-success" style="padding:5px 50px;">Add</button>
                                            </div>
                                        </div>
                                </form>
                                <!-- INSERT RESULT: -->
                                <div style="padding:30px 0;text-align:center;font-weight:bold;font-size:15px;">
                                    <?php
                                    echo "<div style=\"text-decoration:underline;\">RESULT:</div>";
                                    if (isset($_GET['insertResult']) == TRUE) {
                                        if ($_GET['insertResult'] > 0) {
                                            echo "<span style=\"color:green;\">" . "Data has been inserted." . "</span>";
                                        } else {
                                            echo "<span style=\"color:red;\">" . "Can not insert data!" . "</span>";
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- END USER FORM -->
                            <?php
                            }
                            ?>



                            <!-- ____________________________________________________________________________________________________ -->
                            <!-- FUNCTION: Insert manufacturers. -->
                            <?php
                            if (isset($_GET['functionType']) == TRUE && $_GET['functionType'] == "categories") {
                            ?>
                                <!-- BEGIN USER FORM -->
                                <form action="insert_categories.php" method="get" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">Category name:</label>
                                        <div class="controls">
                                            <input type="text" class="span11" placeholder="Category name" name="category_name" required /> *
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Change image (URL):</label>
                                            <div class="controls">
                                                <input type="text" name="newImg" id="newImg">
                                            </div>
                                        </div>
                                        <div class="form-actions" style="text-align:center;">
                                            <button type="submit" name="submit" class="btn btn-success" style="padding:5px 50px;">Add</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- INSERT RESULT: -->
                                <div style="padding:30px 0;text-align:center;font-weight:bold;font-size:15px;">
                                    <?php
                                    echo "<div style=\"text-decoration:underline;\">RESULT:</div>";
                                    if (isset($_GET['insertResult']) == TRUE) {
                                        if ($_GET['insertResult'] > 0) {
                                            echo "<span style=\"color:green;\">" . "Data has been inserted." . "</span>";
                                        } else {
                                            echo "<span style=\"color:red;\">" . "Can not insert data!" . "</span>";
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- END USER FORM -->
                            <?php
                            }
                            ?>



                            <!-- ____________________________________________________________________________________________________ -->
                            <!-- FUNCTION: Insert product types. -->
                            <?php
                            if (isset($_GET['functionType']) == TRUE && $_GET['functionType'] == "protypes") {
                            ?>
                                <!-- BEGIN USER FORM -->
                                <form action="insert_protype.php" method="get" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">Product type:</label>
                                        <div class="controls">
                                            <input type="text" class="span11" placeholder="Product type" name="type_name" required /> *
                                        </div>
                                        <div class="form-actions" style="text-align:center;">
                                            <button type="submit" name="submit" class="btn btn-success" style="padding:5px 50px;">Add</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- INSERT RESULT: -->
                                <div style="padding:30px 0;text-align:center;font-weight:bold;font-size:15px;">
                                    <?php
                                    echo "<div style=\"text-decoration:underline;\">RESULT:</div>";
                                    if (isset($_GET['insertResult']) == TRUE) {
                                        if ($_GET['insertResult'] > 0) {
                                            echo "<span style=\"color:green;\">" . "Data has been inserted." . "</span>";
                                        } else {
                                            echo "<span style=\"color:red;\">" . "Can not insert data!" . "</span>";
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- END USER FORM -->
                            <?php
                            }
                            ?>

                            <!-- ____________________________________________________________________________________________________ -->
                            <!-- FUNCTION: Insert users. -->
                            <?php
                            if (isset($_GET['functionType']) == TRUE && $_GET['functionType'] == "users") {
                            ?>
                                <!-- BEGIN USER FORM -->
                                <form action="insert_user.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">Username:</label>
                                        <div class="controls">
                                            <input type="text" class="span11" placeholder="Username..." name="username" required /> *
                                        </div>
                                        <label class="control-label">Password:</label>
                                        <div class="controls">
                                            <input type="password" class="span11" placeholder="Password..." name="password" required /> *
                                        </div>
                                        <label class="control-label">Confirm Password:</label>
                                        <div class="controls">
                                            <input type="password" class="span11" placeholder="Confirm Password..." name="password2" required /> *
                                        </div>
                                        <label class="control-label">Role:</label>
                                        <div class="controls">
                                            <select name="permission" id="permission">
                                                <option value="user">User</option>
                                                <option value="admin">Admin</option>
                                            </select> *
                                        </div>

                                        <div class="form-actions" style="text-align:center;">
                                            <button type="submit" name="submit" class="btn btn-success" style="padding:5px 50px;">Add</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- INSERT RESULT: -->
                                <div style="padding:30px 0;text-align:center;font-weight:bold;font-size:15px;">
                                    <?php
                                    echo "<div style=\"text-decoration:underline;\">RESULT:</div>";
                                    if (isset($_GET['insertResult']) == TRUE) {
                                        if ($_GET['insertResult'] > 0) {
                                            echo "<span style=\"color:green;\">" . "User has been inserted." . "</span>";
                                        } else {
                                            echo "<span style=\"color:red;\">" . "Can not insert User!" . "</span>";
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- END USER FORM -->
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT -->
    <!--Footer-part-->
    <div class="row-fluid">
        <div id="footer" class="span12"> 2017 &copy; TDC - Lập trình web 1</div>
    </div>
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