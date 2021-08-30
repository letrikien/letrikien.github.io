<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Thêm Admin</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) 
            {
                echo $_SESSION['add']; 
                unset($_SESSION['add']); 
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Họ và tên: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Nhập tên của bạn">
                    </td>
                </tr>

                <tr>
                    <td>Tên đăng nhập: </td>
                    <td>
                        <input type="text" name="username" placeholder="Nhập tên đăng nhập">
                    </td>
                </tr>

                <tr>
                    <td>Mật khẩu: </td>
                    <td>
                        <input type="password" name="password" placeholder="Nhập mật khẩu">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Thêm Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php 


    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";

        //1. Get the Data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); 

        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
 
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        if($res==TRUE)
        {
            //Data Inserted
            //echo "Data Inserted";
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //echo "Faile to Insert Data";
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }
    
?>