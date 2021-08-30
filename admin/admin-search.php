<?php include('partials/menu.php'); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    table {
    border-collapse: collapse;
    text-align: center;
    margin-bottom: 30px;
}
th, td {
    border: 1px solid #ccc;
    text-align: center!important;
}

a{
    margin-right: 10px;
    /* background-color: blue; */
}
</style>
<section class="food-search text-center">
    <div class="container">
        <?php 
            $search = mysqli_real_escape_string($conn, $_POST['search']);       
        ?>


        <h2>Đơn đặt hàng với tên: <a href="#" style="color: red">"<?php echo $search; ?>"</a></h2>

    </div>
</section>



<section>
    <div class="container">
        <h2>Danh sách đơn đặt hàng</h2>
        <table style="width:100%">
        <tr style="background-color: #717171; color: white;">
            <th>ID</th>
            <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
        <?php 

            // "SELECT * FROM tbl_food WHERE title LIKE '%burger'%' OR description LIKE '%burger%'";
            $sql = "SELECT * FROM tbl_cart WHERE name LIKE '%$search%'";

            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $name = $row['name'];
                    $address = $row['address'];
                    $phone = $row['phone'];
                    $status = $row['status'];
                    $created_time = $row['created_time'];                
                    ?>

                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $address; ?></td>
                            <td><?php echo $phone; ?></td>
                            <td style="color: red;"><?php echo $status; ?></td>
                            <td><?php echo $created_time; ?></td>
                            <td>
                                <a href="update-order-listing.php?id=<?= $row['id']?>">Sửa</a>
                                <a style="color:red" href="delete-order.php?id=<?= $row['id']?>">Xoá</a>
                            </td>
                        </tr>

                    <?php

                }
            }
            else
            {
                echo "<div class='error'>Không tìm thấy đơn hàng.</div>";
            }
        
        ?>

        </table>

        

        <div class="clearfix"></div>

        

    </div>

</section>

<?php include('partials/footer.php'); ?>