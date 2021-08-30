<?php 
    include('config/constants.php'); 

    //$user = [];
    $user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];
    //$user = $_SESSION['user'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container" style="display: block">
            <div class="logo">
                <a href="index.php" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <?php
                    if(isset($user['name'])){
                ?>
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Trang chủ</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Thể loại</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Món ăn</a>
                    </li>
                    <li>
                        <a href="contact.php">Liện hệ</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>cart.php">Giỏ hàng</a>
                    </li>
                    <!-- <li>
                        <a href="login.php">Đăng nhập</a>
                    </li> -->
                    <!-- <li>
                        <a href="register.php">Đăng ký</a>
                    </li> -->
                    <li>
                        <a href="logout.php">Đăng xuất</a>
                    </li>
                    <li>
                        <p>Xin chào: <?php echo $user['name']?></p>
                    </li>
                </ul>
                <?php 
                    }else{
                    ?>
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Trang chủ</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Thể loại</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Món ăn</a>
                    </li>
                    <li>
                        <a href="contact.php">Liên hệ</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>cart.php">Giỏ hàng</a>
                    </li>
                    <li>
                        <a href="login.php">Đăng nhập</a>
                    </li>
                    <li>
                        <a href="register.php">Đăng ký</a>
                    </li>
                    
                </ul>
                    <?php } ?>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->