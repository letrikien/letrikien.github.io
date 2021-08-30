<?php 
    if(!isset($_SESSION['user']))
    {
        $_SESSION['no-login-message'] = "<div class='error text-center'>Vui lòng đăng nhập để truy cập trang quản trị.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>