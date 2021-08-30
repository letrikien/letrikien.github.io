<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/cart.css">
    <title>Giỏ hàng</title>
</head>
<body>
    <?php
    include'./config/constants.php';
    if(!isset($_SESSION["cart"])){
        $_SESSION["cart"] = array();
    }
    $error = false;
    $success = false;
        if(isset($_GET['action'])){
            function update_cart($add = false){
                foreach($_POST['quantity'] as $id => $quantity){
                    if($quantity <= 0||$quantity > 30){
                        unset($_SESSION["cart"][$id]);
                    }else{
                        if($add){
                            $_SESSION["cart"][$id] += $quantity;
                        }else{
                            $_SESSION["cart"][$id] = $quantity;
                        }
                    }                                
                }
            }
             switch($_GET['action']){
                case "add":
                    update_cart(true);
                    header('Location: ./cart.php');
                    break;
                case "delete":
                    if(isset($_GET['id'])){
                        unset($_SESSION["cart"][$_GET['id']]);
                    }
                    header('Location: ./cart.php');
                    break;
                    case "submit":
                        if(isset($_POST['update_click'])){
                            update_cart();
                            header('Location: ./cart.php');
                        }elseif($_POST['order_click']){
                            if(empty($_POST['name'])){
                                $error = "Bạn chưa nhập tên";
                            }
                            elseif(empty($_POST['phone'])){
                                $error = "Bạn chưa nhập số điện thoại";
                            }
                            elseif(empty($_POST['address'])){
                                $error = "Bạn chưa nhập địa chỉ";
                            }elseif(empty($_POST['quantity'])){
                                $error = "Giỏ hàng rỗng";
                            }
                            if($error ==false && !empty($_POST['quantity'])){//Xử lý lưu giỏ hàng vào database
                                //"SELECT *FROM 'tb_food' WHERE 'id' IN (7,8);"
                                $products = mysqli_query($conn,"SELECT *FROM tbl_food WHERE id IN (".implode("," ,array_keys($_POST['quantity'])).");");
                                $total = 0;
                                $orderProducts = array();
                                while($row = mysqli_fetch_array($products)){
                                    $orderProducts[] = $row;
                                    $total += $row['price'] * $_POST['quantity'][$row['id']];
                                }
                                $insertOrder = mysqli_query($conn,"INSERT INTO `tbl_cart` (`id`,`name`, `phone`, `address`, `note`, `total`, `status`, `created_time`, `last_updated`) VALUES (NULL,'".$_POST['name']."', '".$_POST['phone']."', '".$_POST['address']."', '".$_POST['note']."', '".$total."', 'Đơn mới', '".time()."', '".time()."');");
                                $orderID = $conn->insert_id;
                                $insertString = "";
                                foreach($orderProducts as $key => $product){
                                    $insertString .= "(NULL,'".$orderID."','".$product['id']."','".$_POST['quantity'][$product['id']]."','".$product['price']."','".time()."','".time()."')";
                                    if($key !=count($orderProducts) - 1){
                                        $insertString .= ",";
                                        unset($_SESSION['cart']);
                                    }
                                }
                                $insertOrder = mysqli_query($conn,"INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_time`, `last_updated`) VALUES ".$insertString.";");
                                $success = "Đặt hàng thành công";
                            }
                        }
                        break;
            }
        }
        if(!empty($_SESSION["cart"])){

            $products = mysqli_query($conn, "SELECT * FROM tbl_food WHERE id IN (".implode(",", array_keys($_SESSION["cart"])).")");
        }
    ?>
    <div class="container">
        <a style="color: red;" href="./index.php">Trang chủ</a>
        <?php if(!empty($error)){ ?>
            <div id="notify-msg">
                <?=$error?>. <a href="./cart.php">Quay lại</a>
            </div>
        <?php } elseif(!empty($success)){ ?>
            <div id="notify-msg">
                <?=$success?>. <a href="./index.php">Tiếp tục mua hàng</a>
            </div>
        <?php } else { ?>
            <h2>Giỏ hàng</h2>
            <form id="cart-form" action="cart.php?action=submit" method="POST">
                <table style="width: 100%">
                    <tr>
                        <th class="product-number">STT</th>
                        <th class="product-name">Tên sản phẩm</th>
                        <th class="product-img">Ảnh sản phẩm</th>
                        <th class="product-price">Đơn giá</th>
                        <th class="product-quantity">Số lượng</th>
                        <th class="total-money">Thành tiền</th>
                        <th class="product-delete">Xóa</th>
                    </tr>
                    <?php
                    if(!empty($products)){
                        $total = 0;
                        $num = 1; 
                        while ($row = mysqli_fetch_assoc($products)) { ?>
                        <tr>
                            <td class="product-number"><?=$num++;?></td>
                            <td class="product-name"><?=$row['title'];?></td>
                            <td class="product-img"><img src="images/food/<?= $row['image_name']?>" alt=""></td>
                            <td class="product-price"><?= number_format($row['price'], 0, ", ", ".")?></td>
                            <td class="product-quantity"><input type="text" value="<?=$_SESSION["cart"][$row['id']]?>" name="quantity[<?=$row['id'];?>]"></td>
                            <td class="total-money"><?= number_format($row['price'] * $_SESSION["cart"][$row['id']], 0, ", ", ".")?></td>
                            <td class="product-delete"><a onclick="return confirm('Xóa món ăn?')" href="cart.php?action=delete&id=<?= $row['id']?>">Xóa</a></td>
                        </tr>
                        <?php 
                            $total += $row['price'] * $_SESSION["cart"][$row['id']];
                        }?>                     
                            <tr id="row-total">
                                <td class="product-number">&nbsp</td>
                                <td class="product-name">Tổng tiền:</td>
                                <td class="product-img">&nbsp</td>
                                <td class="product-price">&nbsp</td>
                                <td class="product-quantity">&nbsp</td>
                                <td class="total-money"><?= number_format($total, 0, ", ", ".")?></td>
                                <td class="product-delete">&nbsp</td>
                            </tr>
                        <?php
                    }
                     ?>
                </table>
                <div id="form-button">
                    <input type="submit" name="update_click" value="Cập nhật">
                </div>
                <hr>
                <div><label>Người nhận: <input type="text" value="" name="name"></label></div>
                <div><label>Điện thoại: <input type="text" value="" name="phone"></label></div>
                <div><label>Địa chỉ: <input type="text" value="" name="address"></label></div>
                <div><label>Ghi chú: <input name="note" rows="?" cols="50"></label></div>
                <input type="submit" name="order_click" value="Đặt hàng">
            </form>
        <?php } ?>
        
    </div>
</body>
</html>