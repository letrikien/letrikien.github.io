<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Admin - Home Page</title>
</head>
<style>
    table {
    border-collapse: collapse;
    text-align: center;
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
    <?php
    include './partials/menu.php';
    //include '../config/constants.php';

    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(!empty($where)){
        $totalRecords = mysqli_query($conn, "SELECT * FROM `tbl_cart` where (".$where.")");
    }else{
        $totalRecords = mysqli_query($conn, "SELECT * FROM `tbl_cart`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($where)){
        $orders = mysqli_query($conn, "SELECT * FROM `tbl_cart` where (".$where.") ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
        $orders = mysqli_query($conn, "SELECT * FROM `tbl_cart` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($conn);
    ?>
<body class="container">
    <h2>Danh sách</h2>
    <form action="admin-search.php" method="POST">
        <input type="search" name="search" placeholder="Tìm kiếm đơn hàng..." required>
        <input type="submit" name="submit" value="Tìm kiếm">
    </form><br>

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
        <?php  while ($row = mysqli_fetch_array($orders)) { ?>
        <tr>
            <td><?=$row['id']?></td>
            <td><?=$row['name']?></td>
            <td><?=$row['address']?></td>
            <td><?=$row['phone']?></td>
            <td style="color: red;"><?=$row['status']?></td>
            <td><?=date('d/m/Y H:i', $row['created_time'])?></td>
            <td>
                <a href="update-order-listing.php?id=<?= $row['id']?>">Sửa</a>
                <a style="color:red" href="delete-order.php?id=<?= $row['id']?>">Xoá</a>
            </td>
        </tr>
        <?php  } ?>
    </table>
    <?php /*
              include './pagination.php';
             */ 
        include './partials/footer.php';
    ?>
</body>
</html>