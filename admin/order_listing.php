<?php
include './partials/menu.php';
//include '../config/constants.php';

    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(!empty($where)){
        $totalRecords = mysqli_query($conn, "SELECT * FROM `tbl_cart` where (".$where.")");
    }else{
        $totalRecords = mysqli_query($conn, "SELECT * FROM `tbl_cart`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($where)){
        $orders = mysqli_query($conn, "SELECT * FROM `tbl_cart` where (".$where.") ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
        $orders = mysqli_query($conn, "SELECT * FROM `tbl_cart` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($conn);
    ?>
    <link rel="stylesheet" href="../css/order.css">
    <div class="main-content" style="width: 948px;">
        <h1>Danh sách</h1>
        <div class="listing-items">
            
            <div class="total-items">
                <?php /*
                  <span>Có tất cả <strong><?=$totalRecords?></strong> <?=$config_title?> trên <strong><?=$totalPages?></strong> trang</span> */ ?>
            </div>
            <ul>
                <li class="listing-item-heading">
                    <div class="listing-prop listing-id">ID</div>
                    <div class="listing-prop listing-name">Tên người nhận</div>
                    <div class="listing-prop listing-address">Địa chỉ</div>
                    <div class="listing-prop listing-phone" style="width: 197px;">Điện thoại</div>
                    <div class="listing-prop listing-button">
                        In đơn
                    </div>
                    <div class="listing-prop listing-time">Ngày tạo</div>
                    <div class="clear-both"></div>
                </li>
                <?php  while ($row = mysqli_fetch_array($orders)) { ?>
                <li style="text-align: center;">
                    <div class="listing-prop listing-id"><?=$row['id']?></div>
                    <div class="listing-prop listing-name"><?=$row['name']?></div>
                    <div class="listing-prop listing-address"><?=$row['address']?></div>
                    <div class="listing-prop listing-phone"><?=$row['phone']?></div>
                    <div class="listing-prop listing-button">
                        <a href="order_printing.php?id=<?=$row['id']?>" target="_blank">In</a>
                    </div>
                    <div class="listing-prop listing-time"><?=date('d/m/Y H:i', $row['created_time'])?></div>
                    <div class="clear-both"></div>
                </li>
                <?php  } ?>
            </ul>
            <?php /*
              include './pagination.php';
             */ 
                    include './partials/footer.php';
            ?>
            <div class="clear-both"></div>
        </div>
    </div>
    <?php
?>