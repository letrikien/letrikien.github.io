<?php
    include('config/constants.php');
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM tbl_user WHERE email='$email'";
        $query = mysqli_query($conn,$sql);
        $data = mysqli_fetch_assoc($query);
        $checkEmail = mysqli_num_rows($query);
        if($checkEmail == 1){

            $checkPass = password_verify($password, $data['password']);

            if($checkPass){
                $_SESSION['user'] = $data;
                header('location: index.php');
            }
            else
            {
                echo "Sai mat khau";
            }

        }
        else
        {
            echo "Email khong ton tai";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <title>Đăng nhập</title>
</head>
<body>
        <div class="container">
            
            <div class="row" style="margin: 15% 35%;">
            <a href="./index.php" style="color: red">Trang chủ</a>
                <div class="col-md-12">
                    <form action="" method="POST" role="form" style="text-align: center;margin: 0 auto;">
                        <legend>Đăng nhập</legend>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" id="" placeholder="Input field" name="email">
                            <div class="has-error">
                                <span> <?php echo (isset($err['email']))?$err['email']:'' ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Mật khẩu</label>
                            <input type="password" class="form-control" id="" placeholder="Input field" name="password">
                            <div class="has-error">
                                <span> <?php echo (isset($err['password']))?$err['password']:'' ?></span>
                            </div>
                        </div>
                        <div>
                            <td colspan="2">
                            <button type="submit" name="submit">Đăng nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>