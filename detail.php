<?php include('partials-front/menu.php'); ?>

<?php 
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Chi tiết sản phẩm</title>
    <style>
            body{
                font-family: arial;
            }
            .container{
                width: 1200px;
                margin: 0 auto;
                padding: 15px;
            }
            h1{
                text-align: center;
            }
            .product-items{
                border: 1px solid #ccc;
                padding: 30px;
            }
            .product-item{
                float: left;
                width: 23%;
                margin: 1%;
                padding: 10px;
                box-sizing: border-box;
                border: 1px solid #ccc;
                line-height: 26px;
            }
            .product-item label{
                font-weight: bold;
            }
            .product-item p{
                margin: 0;
                line-height: 26px;
                max-height: 52px;
                overflow: hidden;
            }
            .product-price{
                color: red;
                font-weight: bold;
            }
            .product-img{
                padding: 5px;
                border: 1px solid #ccc;
                margin-bottom: 5px;
            }
            .product-item img{
                max-width: 100%;
            }
            .product-item ul{
                margin: 0;
                padding: 0;
                border-right: 1px solid #ccc;
            }
            .product-item ul li{
                float: left;
                width: 33.3333%;
                list-style: none;
                text-align: center;
                border: 1px solid #ccc;
                border-right: 0;
                box-sizing: border-box;
            }
            .clear-both{
                clear: both;
            }
            a{
                text-decoration: none;
            }
            .buy-button{
                text-align: right;
                margin-top: 10px;
            }
            .buy-button a{
                background: #444;
                padding: 5px;
                color: #fff;
            }
            #pagination{
                text-align: right;
                margin-top: 15px;
            }
            .page-item{
                border: 1px solid #ccc;
                padding: 5px 9px;
                color: #000;
            }
            .current-page{
                background: #000;
                color: #FFF;
            }
            
            #product-detail{
                border-top: 1px solid #000;
                padding: 15px 0 0 0;
            }
            #product-img{
                width: 30%;
                float: left;
            }
            #product-info{
                float: right;
                width: 70%;
                text-align: left;
                padding-left: 30px;
            }
            #product-img img{
                max-width: 100%;
                padding: 5px;
                border: 1px solid #000;
                background: #eee;
                
            }
            h1{
                text-align: left;
                margin-top: 0;
            }
            label.add-to-cart{
                background: #000;
                border: 1px solid #000;
                margin-top: 15px;
                padding: 15px;
                display: inline-block;
                color: #fff;
            }
            label a{
                color: #FFF;
            }
            *{
                box-sizing: border-box;
            }
            .comment{
                background-color: #DDE0E6;
                margin-bottom: 5px;
            }
            .comment p{
                margin-bottom: 0px;
                padding: 5px 5px 0 5px;
            }
            .name{
                color: blue;
            }
        </style>
</head>

<body>
    <?php
        include('config/constants.php');
        
        $result = mysqli_query($conn, "SELECT * FROM tbl_food WHERE id = ".$_GET['id']);
        $product = mysqli_fetch_assoc($result);
    ?>
    <?php 
    include('config/constants.php'); 

    //$user = [];
    //$user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];
    //$user = $_SESSION['user'];
    ?>

    <div class="container">
        <h2>Chi tiết sản phẩm</h2>
        <div id="product-detail">
            <div id="product-img">
                <img src="images/food/<?= $product['image_name']?>">
            </div>
            <div id="product-info">
                <h1><?= $product['title']?></h1>
                <label>Giá: </label><span class="product-price"><?= number_format($product['price'], 0, ", ", ".")?>VNĐ</span><br/>
                <p><?= $product['description']?></p>
                <form id="add-to-cart-form" action="cart.php?action=add" method="POST">
                    <input type="text" value="1" name="quantity[<?= $product['id']?>]" size="2">
                    <input type="submit" value="Mua sản phẩm">
                </form>
                <div>
                    <form action="" method="POST">    
                        <hr>
                        <?php
                            if(isset($user['name'])){
                        ?>
                        Tên người bình luận: <input type="text" name="name" class="form-control" required="" value="<?php echo $user['name']?>">
                        Bình luận: <input type="text" name="comment" class="form-control"required=""><br>
                        <input type="submit" name="submit1" class="add-to-cart" value="Gửi bình luận"><br><br>
                        <?php 
                        if(isset($_POST['submit1'])){
                            $product_id = $product['id'];
                            $name = $_POST['name'];
                            $comment = $_POST['comment'];
                            $date = date("Y-m-d H:i:s");

                            //echo $product_id,$name,$comment,$date;
                            $sql = "INSERT INTO `tbl_comment` (`comment_id`, `comment_name`, `comment`, `product_id`, `datetime`) VALUES (NULL, '$name', '$comment', '$product_id', '$date');";
                            $res = mysqli_query($conn, $sql) or die(mysqli_error());
                        }
                        ?>
                        <?php 
                        }else{
                            echo "<p class='error'>Vui lòng đăng nhập để bình luận sản phẩm!</p>";
                        ?>
                        <?php } ?>
                        <?php 
                        if(isset($_POST['submit'])){

                            $product_id = $product['id'];
                            $name = $_POST['name'];
                            $comment = $_POST['comment'];
                            $date = date("Y-m-d H:i:s");

                            //echo $product_id,$name,$comment,$date;
                            $sql = "INSERT INTO `tbl_comment` (`comment_id`, `comment_name`, `comment`, `product_id`, `datetime`) VALUES (NULL, '$name', '$comment', '$product_id', '$date');";
                            $result1 = $conn->query($sql);
                        }
                        ?>
                        <?php 
                            $sql1 = "SELECT * FROM tbl_comment WHERE product_id = ".$_GET['id'];
                            $result2 = $conn->query($sql1);
                            while($row = $result2 ->fetch_assoc()){
                                // echo'<pre>';
                                // print_r($row);
                                echo
                                "
                                <div class='comment'>
                                    <p class='name'>".$row['comment_name']."</p>
                                    <p>".$row['comment']."</p>
                                </div>
                                ";       
                            }
                        ?>
                    </form>
                </div>
            </div>
            <div class="clear-both"></div>
        </div>
    </div>
</body>
</html>
<?php include('partials-front/footer.php'); ?>