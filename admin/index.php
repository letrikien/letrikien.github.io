
<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1 style="text-align: center;">Thống kê</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>

                <div class="col-4 text-center" style="width: 14%;">

                    <?php 
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                    Thể loại
                </div>

                <div class="col-4 text-center" style="width: 14%;">

                    <?php 
                        $sql2 = "SELECT * FROM tbl_food";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br />
                    Các món ăn
                </div>

                <div class="col-4 text-center" style="width: 14%;">
                    
                    <?php 
                        $sql3 = "SELECT * FROM tbl_cart";
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br />
                    Tổng các đơn hàng
                </div>

                <div class="col-4 text-center" style="width: 14%; color: red;">
                    
                    <?php 
                        $sql3 = "SELECT * FROM tbl_cart WHERE status='Đơn mới'";
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br />
                    Đơn hàng mới
                </div>

                <div class="col-4 text-center" style="width: 14%;">
                    
                    <?php 
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_cart WHERE status='Đã giao'";

                        $res4 = mysqli_query($conn, $sql4);

                        $row4 = mysqli_fetch_assoc($res4);
                        
                        $total_revenue = $row4['Total'];
                        $format_number = number_format($total_revenue);

                    ?>

                    <h1><?php echo $format_number;?></h1>
                    <br />
                    Doanh thu
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Content Setion Ends -->

<?php include('partials/footer.php') ?>