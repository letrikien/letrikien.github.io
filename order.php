
<?php include('partials-front/menu.php'); ?>


    <?php 
        if(isset($_GET['food_id']))
        {
            $food_id = $_GET['food_id'];

            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                header('location:'.SITEURL);
            }
        }
        else
        {
            header('location:'.SITEURL);
        }
    ?>
    <?php 

    //$user = [];
    $user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];
    //$user = $_SESSION['user'];
    ?>

    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Nhập thông tin đơn hàng.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Món ăn đã chọn</legend>

                    <div class="food-menu-img">
                        <?php 
                        
                            if($image_name=="")
                            {
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                    </div>

                </fieldset>
                
                <fieldset>
                    <?php
                        if(isset($user['name'])){
                    ?>
                    <legend>Thông tin chi tiết</legend>
                    <div class="order-label">Tên đầy đủ</div>
                    <input type="text" name="full-name" value="<?php echo $user['name']?>" class="input-responsive" required>

                    <div class="order-label">SĐT</div>
                    <input type="tel" name="contact" placeholder="VD: 0961.xxx.xxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" value="<?php echo $user['email']?>" class="input-responsive" required>

                    <div class="order-label">Địa chỉ</div>
                    <textarea name="address" rows="10" placeholder="VD: Tên đường, Thành phố" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                    <?php 
                        }else{
                    ?>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="VD: Trần Văn A" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="VD: 0961.xxx.xxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="VD: abc@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="VD: Tên đường, Thành phố" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                    <?php } ?>
                </fieldset>

            </form>

            <?php 

                if(isset($_POST['submit']))
                {

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // total = price x qty 

                    $order_date = date("Y-m-d h:i:sa");

                    $status = "Ordered";
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];


                    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    //echo $sql2; die();

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true)
                    {
                        $_SESSION['order'] = "<div class='success text-center'>Đặt hàng thành công.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class='error text-center'>Đặt hàng thất bại.</div>";
                        header('location:'.SITEURL);
                    }

                }
            
            ?>

        </div>
    </section>

    <?php include('partials-front/footer.php'); ?>