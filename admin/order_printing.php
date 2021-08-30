<html>
    <head>
        <title>Chi tiết đơn hàng</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/order.css">
        <script src="../resources/ckeditor/ckeditor.js"></script>
    </head>
    <body>
        <?php
                    include '../config/constants.php';

        //session_start();       
        if (!empty($_SESSION['user'])) {
            $orders = mysqli_query($conn, "SELECT tbl_cart.name, tbl_cart.address, tbl_cart.phone, tbl_cart.note, order_detail.*, tbl_food.title as tbl_food_name 
FROM tbl_cart
INNER JOIN order_detail ON tbl_cart.id = order_detail.order_id
INNER JOIN tbl_food ON tbl_food.id = order_detail.product_id
WHERE tbl_cart.id = " . $_GET['id']);
//var_dump($orders);exit;
            $orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);
        }
        ?>
        <div id="order-detail-wrapper">
            <div id="order-detail">
                <h1>Chi tiết đơn hàng</h1>
                <label>Người nhận: </label><span> <?= $orders[0]['name'] ?></span><br/>
                <label>Điện thoại: </label><span> <?= $orders[0]['address'] ?></span><br/>
                <label>Địa chỉ: </label><span> <?= $orders[0]['phone'] ?></span><br/>
                <hr/>
                <h3>Danh sách sản phẩm</h3>
                <ul>
                    <?php
                    $totalQuantity = 0;
                    $totalMoney = 0;
                    foreach ($orders as $row) {
                        ?>
                        <li>
                            <span class="item-name"><?= $row['tbl_food_name'] ?></span>
                            <span class="item-quantity"> - SL: <?= $row['quantity'] ?> sản phẩm</span>
                        </li>
                        <?php
                        $totalMoney += ($row['price'] * $row['quantity']);
                        $totalQuantity += $row['quantity'];
                    }
                    ?>
                </ul>
                <hr/>
                <label>Tổng SL:</label> <?= $totalQuantity ?> - <label>Tổng tiền:</label> <?= number_format($totalMoney, 0, ",", ".") ?> đ
                <p><label>Ghi chú: </label><?= $orders[0]['note'] ?></p>
            </div>
        </div>
    </body>
</html>