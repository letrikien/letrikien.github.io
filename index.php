<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./slick.css">
    <title>Trang chủ</title>
</head>
<body>
<?php include('partials-front/menu.php'); ?>

<div class="detail" style="margin-bottom: 30px;">
    <img style="width: 100%; height: 300px;" src="./images/banner/banner3.jpg" alt="">
    <img style="width: 100%; height: 300px;" src="./images/banner/banner2.jpg" alt="">
</div>

<section class="food-search text-center">
    <div class="container">            
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Tìm kiếm món ăn..." required>
            <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-primary">
        </form>

    </div>
</section>

<?php 
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>

<section class="categories">
    <div class="container">
        <h2 class="text-center">Thể loại món ăn</h2>

        <?php 
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                                if($image_name=="")
                                {
                                    echo "<div class='error'>Image not Available</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>

                    <?php
                }
            }
            else
            {
                echo "<div class='error'>Category not Added.</div>";
            }
        ?>


        <div class="clearfix"></div>
    </div>
</section>



<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Danh sách món ăn</h2>

        <?php 
        
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

        $res2 = mysqli_query($conn, $sql2);

        $count2 = mysqli_num_rows($res2);

        if($count2>0)
        {
            while($row=mysqli_fetch_assoc($res2))
            {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>

                <div class="food-menu-box" style="width: 490px; height: 120px;">
                    <div class="food-menu-img">
                        <?php 
                            if($image_name=="")
                            {
                                echo "<div class='error'>Không có hình ảnh.</div>";
                            }
                            else
                            {
                                ?>
                                <a href="detail.php?id=<?= $row['id']?>"><img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Ảnh" class="img-responsive img-curve"></a>
                                <?php
                            }
                        ?>
                        
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo number_format(($price), 0,",","."); ?></p>
                        <!-- <p class="food-detail">
                            <?php echo $description; ?>
                        </p> -->
                        <br>

                        <a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>

                <?php
            }
        }
        else
        {
            echo "<div class='error'>Food not available.</div>";
        }
        
        ?>
        <div class="clearfix"></div>

        

    </div>

    <p class="text-center">
        <a href="foods.php">Tất cả các món</a>
    </p>
</section>


<?php include('partials-front/footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
    <script src="./slide.js"></script>
    <script src="./slick.min.js"></script>
</body>
</html>