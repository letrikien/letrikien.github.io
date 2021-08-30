<?php
    include('config/constants.php');


    $err = [];
    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];

        if(empty($name)) {
            $err['name'] = 'Bạn chưa nhập tên';
        }
        if(empty($email)) {
            $err['email'] = 'Bạn chưa nhập email';
        }
        if(empty($password)) {
            $err['password'] = 'Bạn chưa nhập password';
        }
        if($password != $rpassword) {
            $err['rpassword'] = 'Mật khẩu không trùng khớp';
        }
        //var_dump(!empty($err));
        if(empty($err)){
            $pass = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO tbl_user(name,email,password) VALUES('$name','$email','$pass')";
            $query = mysqli_query($conn,$sql);
            if($query){
                header('location: login.php');
        }
        }
        //die(); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <title>Đăng ký</title>
    <style>
        .has-error{
            color: red;
        }
    </style>
</head>
<body>
    <div class="container" style="margin: 15% 40%;">
    <a href="./index.php" style="color:red">Trang chủ</a>
        <legend>Đăng ký</legend>
        <div class="row">
            <div class="col-md-6">
                <form action="" method="POST" role="form ">
                    <table>
                        <tr>
                            <td>Tên đăng nhập: </td>
                            <td><input type="text" name="name"></td>
                            <div class="has-error">
                                <span> <?php echo (isset($err['name']))?$err['name']:'' ?></span>
                            </div>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><input type="text" name="email"></td>
                            <div class="has-error">
                                <span> <?php echo (isset($err['email']))?$err['email']:'' ?></span>
                            </div>
                        </tr>
                        <tr>
                            <td>Mật khẩu: </td>
                            <td><input type="password" name="password"></td>
                            <div class="has-error">
                                <span> <?php echo (isset($err['password']))?$err['password']:'' ?></span>
                            </div>
                        </tr>
                        <tr>
                            <td>Nhập lại mật khẩu: </td>
                            <td><input type="password" name="rpassword"></td>
                            <div class="has-error">
                                <span> <?php echo (isset($err['rpassword']))?$err['rpassword']:'' ?></span>
                            </div>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" name="submit">Đăng ký</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>  
        </div>
    </div>
</body>
</html>