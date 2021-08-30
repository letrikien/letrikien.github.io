<?php 

    include('../config/constants.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_cart WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        //echo "Admin Deleted";
        //$_SESSION['delete'] = "<div class='success'>Xóa đơn hàng thành công.</div>";
        header('location:'.SITEURL.'admin/manage-order-listing.php');
    }
    else
    {
        //echo "Failed to Delete Admin";

        //$_SESSION['delete'] = "<div class='error'>Xóa đơn hàng thất bại. Vui lòng thử lại sau.</div>";
        header('location:'.SITEURL.'admin/manage-order-listing.php');
    }

?>