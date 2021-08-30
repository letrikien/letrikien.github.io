<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Đăng nhập</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Đăng nhập</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <form action="" method="POST" class="text-center">
            Tài khoản: <br><br>
            <input type="text" name="username" placeholder="Nhập tài khoản"><br><br>

            Mật khẩu: <br><br>
            <input type="password" name="password" placeholder="Nhập mật khẩu"><br><br>

            <input type="submit" name="submit" value="Đăng nhập" class="btn-primary">
            <br><br>
            </form>
        </div>

    </body>
</html>

<?php 

    if(isset($_POST['submit']))
    {
        
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";


        $res = mysqli_query($conn, $sql);

 
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User AVailable and Login Success
            $_SESSION['login'] = "<div class='success'>Đăng nhập thành công.</div>";
            $_SESSION['user'] = $username;

            header('location:'.SITEURL.'admin/');
        }
        else
        {

            $_SESSION['login'] = "<div class='error text-center'>Tài khoản hoặc mật khẩu không đúng.</div>";

            header('location:'.SITEURL.'admin/login.php');
        }


    }

?>