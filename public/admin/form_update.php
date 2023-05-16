<?php require_once 'header.php'; ?>
>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="./index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i>
                Home</a></div>
        <h1>Updated Manager</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Product info</h5>
                    </div>
                    <div class="widget-content nopadding">


                        <!-- ____________________________________________________________________________________________________ -->
                        <!-- FUNCTION: Update products. -->
                        <?php
                        if (isset($_GET['functionType']) == TRUE && $_GET['functionType'] == "products" && isset($_GET['id']) == TRUE) {
                            $selectedProduct = Product::getProduct_ByID($_GET['id'])[0];
                        ?>
                            <!-- BEGIN USER FORM -->
                            <form action="update_product.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label">ID :</label>
                                    <div class="controls">
                                        <input type="text" name="id" value="<?php echo $selectedProduct['id']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Name :</label>
                                    <div class="controls">
                                        <input type="text" class="span11" placeholder="Product name" name="name" value="<?php echo $selectedProduct['name']; ?>" required /> *
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Choose a category:</label>
                                    <div class="controls">
                                        <?php
                                        $list_of_categories = Category::getAllCategory_RemoveAll();
                                        ?>
                                        <select name="category_id" id="cate">
                                            <?php
                                            foreach ($list_of_categories as $key => $value) {
                                            ?>
                                                <option value="<?php echo $value['category_id']; ?>" <?php if ($selectedProduct['category'] == $value['category_id']) {
                                                                                                            echo "selected";
                                                                                                        } ?>>
                                                    <?php echo $value['category_name']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select> *
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Current image :</label>
                                    <div class="controls" style="width:25%;height:auto;">
                                        <img src="<?= $selectedProduct['pro_image']; ?>" alt="" />
                                        <input type="text" name="currentImg" id="currentImg" value="<?php echo $selectedProduct['pro_image']; ?>" readonly style="font-style:italic;">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Change image (URL):</label>
                                    <div class="controls">
                                        <input type="text" name="newImg" id="newImg">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea class="span11" placeholder="Description" name="description"><?php echo $selectedProduct['description']; ?></textarea>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Price :</label>
                                        <div class="controls">
                                            <input type="text" class="span11" placeholder="price" name="price" value="<?php echo $selectedProduct['price']; ?>" required /> *
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Receipt :</label>
                                        <div class="controls">
                                            <input type="number" class="span11" name="receipt" min="1" value="<?php echo $selectedProduct['receipt']; ?>" required />
                                        </div>
                                    </div>
                                    <div class="form-actions" style="text-align:center;">
                                        <button type="submit" name="submit" class="btn btn-success" style="padding:5px 50px;">Update</button>
                                    </div>
                                </div>
                            </form>
                            <!-- INSERT RESULT: -->
                            <div style="padding:30px 0;text-align:center;font-weight:bold;font-size:15px;">
                                <?php
                                echo "<div style=\"text-decoration:underline;\">RESULT:</div>";
                                if (isset($_GET['updateResult']) == TRUE) {
                                    if ($_GET['updateResult'] > 0) {
                                        echo "<span style=\"color:green;\">" . "Updated successfully!" . "</span>";
                                    } else {
                                        echo "<span style=\"color:red;\">" . "Fail to update!" . "</span>";
                                    }
                                }
                                ?>
                            </div>
                            <!-- END USER FORM -->
                        <?php
                        }
                        ?>



                        <!-- ____________________________________________________________________________________________________ -->
                        <!-- FUNCTION: Update categories. -->
                        <?php
                        if (isset($_GET['functionType']) == TRUE && $_GET['functionType'] == "categories" && isset($_GET['category_id']) == TRUE) {
                            $selectedManu = Category::getCategoryById($_GET['category_id'])[0];
                        ?>
                            <!-- BEGIN USER FORM -->
                            <form action="update_categories.php" method="get" class="form-horizontal" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label">Category ID :</label>
                                    <div class="controls">
                                        <input type="text" name="category_id" value="<?php echo $_GET['category_id']; ?>" readonly>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Category name:</label>
                                        <div class="controls">
                                            <input type="text" class="span11" placeholder="Categories name" name="category_name" required value="<?php echo $selectedManu['category_name']; ?>" /> *
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Current image :</label>
                                            <div class="controls" style="width:25%;height:auto;">
                                                <img src="<?= $selectedManu['category_img']; ?>" alt="" />
                                                <input type="text" name="currentImg" id="currentImg" value="<?php echo $selectedManu['category_img']; ?>" readonly style="font-style:italic;">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Change image (URL):</label>
                                            <div class="controls">
                                                <input type="text" name="newImg" id="newImg">
                                            </div>
                                        </div>
                                        <div class="form-actions" style="text-align:center;">
                                            <button type="submit" name="submit" class="btn btn-success" style="padding:5px 50px;">Update</button>
                                        </div>
                                    </div>
                            </form>
                            <!-- INSERT RESULT: -->
                            <div style="padding:30px 0;text-align:center;font-weight:bold;font-size:15px;">
                                <?php
                                echo "<div style=\"text-decoration:underline;\">RESULT:</div>";
                                if (isset($_GET['updateResult']) == TRUE) {
                                    if ($_GET['updateResult'] > 0) {
                                        echo "<span style=\"color:green;\">" . "Updated successfully!" . "</span>";
                                    } else {
                                        echo "<span style=\"color:red;\">" . "Fail to update!" . "</span>";
                                    }
                                }
                                ?>
                            </div>
                            <!-- END USER FORM -->
                        <?php
                        }
                        ?>



                        <!-- ____________________________________________________________________________________________________ -->
                        <!-- FUNCTION: Update product types. -->
                        <?php
                        if (isset($_GET['functionType']) == TRUE && $_GET['functionType'] == "protypes" && isset($_GET['type_id']) == TRUE) {
                            $selectedProtype = Protype::getTypeName($_GET['type_id']);
                        ?>
                            <!-- BEGIN USER FORM -->
                            <form action="update_protype.php" method="get" class="form-horizontal" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label">Type ID :</label>
                                    <div class="controls">
                                        <input type="text" name="type_id" value="<?php echo $_GET['type_id']; ?>" readonly>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Product type:</label>
                                        <div class="controls">
                                            <input type="text" class="span11" placeholder="Product type" name="type_name" value="<?php echo $selectedProtype; ?>" required /> *
                                        </div>
                                        <div class="form-actions" style="text-align:center;">
                                            <button type="submit" name="submit" class="btn btn-success" style="padding:5px 50px;">Update</button>
                                        </div>
                                    </div>
                            </form>
                            <!-- INSERT RESULT: -->
                            <div style="padding:30px 0;text-align:center;font-weight:bold;font-size:15px;">
                                <?php
                                echo "<div style=\"text-decoration:underline;\">RESULT:</div>";
                                if (isset($_GET['updateResult']) == TRUE) {
                                    if ($_GET['updateResult'] > 0) {
                                        echo "<span style=\"color:green;\">" . "Updated successfully!" . "</span>";
                                    } else {
                                        echo "<span style=\"color:red;\">" . "Fail to update!" . "</span>";
                                    }
                                }
                                ?>
                            </div>
                            <!-- END USER FORM -->
                        <?php
                        }
                        ?>



                        <!-- ____________________________________________________________________________________________________ -->
                        <!-- FUNCTION: Update users types. -->
                        <?php
                        if (isset($_GET['functionType']) == TRUE && $_GET['functionType'] == "user" && isset($_GET['id']) == TRUE) {
                            $selectedUser = User::getUserName($_GET['id']);
                        ?>
                            <!-- BEGIN USER FORM -->
                            <form action="./update_user.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label">User ID :</label>
                                    <div class="controls">
                                        <input type="text" name="id" value="<?php echo $selectedUser['id']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Username :</label>
                                    <div class="controls">
                                        <input type="text" name="username" value="<?php echo $selectedUser['username']; ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Password :</label>
                                    <div class="controls">
                                        <input type="password" name="password" value="<?php echo $selectedUser['password']; ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">New Password :</label>
                                    <div class="controls">
                                        <input type="password" name="newpassword">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Confirm Password :</label>
                                    <div class="controls">
                                        <input type="password" name="password2">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Permission :</label>
                                    <div class="controls">
                                        <select name="permission" id="permission">
                                            <?php if ($selectedUser['permission'] == 'user') { ?>
                                                <option value="user" selected>User</option>
                                                <option value="admin">Admin</option>
                                            <?php } else { ?>
                                                <option value="user">User</option>
                                                <option value="admin" selected>Admin</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-actions" style="text-align:center;">
                                        <button type="submit" name="submit" class="btn btn-success" style="padding:5px 50px;">Update</button>
                                    </div>
                                </div>
                            </form>
                            <!-- INSERT RESULT: -->
                            <div style="padding:30px 0;text-align:center;font-weight:bold;font-size:15px;">
                                <?php
                                echo "<div style=\"text-decoration:underline;\">RESULT:</div>";
                                if (isset($_GET['updateResult']) == TRUE) {
                                    if ($_GET['updateResult'] > 0) {
                                        echo "<span style=\"color:green;\">" . "Updated successfully!" . "</span>";
                                    } else {
                                        echo "<span style=\"color:red;\">" . "Fail to update!" . "</span>";
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