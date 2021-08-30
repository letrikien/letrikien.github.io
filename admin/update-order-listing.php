<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Sửa đơn hàng</h1>
        <br><br>


        <?php 
        
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];

                $sql = "SELECT * FROM tbl_cart WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row=mysqli_fetch_assoc($res);

                    $name = $row['name'];
                    $address = $row['address'];
                    $phone = $row['phone'];
                    $note = $row['note'];
                    $total = $row['total'];
                    $status = $row['status'];
                    $created_time = $row['created_time'];
                    $last_updated = $row['last_updated'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-order-listing.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-order-listing.php');
            }
        
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td>Tên: </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Điện thoại: </td>
                    <td>
                        <input type="number" name="phone" value="<?php echo $phone; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Địa chỉ: </td>
                    <td>
                    <input type="text" name="address" value="<?php echo $address; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Ghi chú: </td>
                    <td>
                    <input type="text" name="note" value="<?php echo $note; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Tổng: </td>
                    <td>
                    <input type="number" name="total" value="<?php echo $total; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Trạng thái</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Đơn mới"){echo "selected";} ?> value="Đơn mới">Đơn mới</option>
                            <option <?php if($status=="Đang giao"){echo "selected";} ?> value="Đang giao">Đang giao</option>
                            <option <?php if($status=="Đã giao"){echo "selected";} ?> value="Đã giao">Đã giao</option>
                            <option <?php if($status=="Hủy đơn"){echo "selected";} ?> value="Hủy đơn">Hủy đơn</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Ngày tạo: </td>
                    <td>
                    <input type="number" name="created_time" value="<?php echo $created_time; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Ngày cập nhật: </td>
                    <td>
                    <input type="number" name="last_updated" value="<?php echo $last_updated; ?>">
                    </td>
                </tr>

                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Cập nhật" class="btn-secondary">
                    </td>
                </tr>
            </table>
        
        </form>


        <?php 
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                $id = $_POST['id'];
                $status = $_POST['status'];

                $sql2 = "UPDATE tbl_cart SET 
                
                    status = '$status'
                   
                    WHERE id=$id
                ";
                $res2 = mysqli_query($conn, $sql2);

                if($res2==true)
                {
                    //$_SESSION['update'] = "<div class='success'>Cập nhật đơn hàng thành công.</div>";
                    header('location:'.SITEURL.'admin/manage-order-listing.php');
                }
                else
                {
                    //$_SESSION['update'] = "<div class='error'>Cập nhật đơn hàng thất bại.</div>";
                    header('location:'.SITEURL.'admin/update-order-listing.php');
                }

                //var_dump($sql2);exit;
                
               
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>
