<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li class="dropdown" id="profile-messages"><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i> <span class="text">Welcome Super Admin</span><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
       <li class="divider"></li>
            </ul>
        </li>
        <?php
             $listMessage  = [];
             $allOrder = Order::getAllOrderUnConfirm();
             if (count($allOrder) > 0) {
                $idOrder =  $allOrder[0]['cart_id'];   
                foreach ($allOrder as $key => $value) {
                    if ($value['cart_id'] == $idOrder) {
                        if (in_array($value['cart_id'], $listMessage)) {
                            continue;
                        } else {
                            array_push($listMessage, $idOrder);
                        }
                    } else {
                        $idOrder = $value['cart_id'];
                        if (in_array($value['cart_id'], $listMessage)) {
                            continue;
                        } else {
                            array_push($listMessage, $idOrder);
                        }
                    }
                }
             } 
        ?>
        <li class="" id="menu-messages">
            <a href="./orders.php">
                <i class="icon icon-envelope"></i> 
                <span class="text">Messages</span> 
                <span class="label label-important" style='border-radius: 50%; padding: 2px 5px'><?php echo count($listMessage)?></span> 
            </a>
        </li>
        <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
        <li class=""><a title="" href="../login/logout.php" style="background-color:#fff;color:red;"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
    </ul>
</div>