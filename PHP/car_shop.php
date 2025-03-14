<?php
     $con=new mysqli("localhost","root","","php_1");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/car_shop.css">
    <link rel="stylesheet" href="../Bootstrap_for_use/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <header>
        <h1 align="center">My Car Shop</h1>
        <p align="center">Please Check Your Favorite Car in My Car Shop</p>
        <a class="btn btn-success" href="../PHP/exercise2.php">Add More Product</a>
    </header>
    <div class="border"></div>
    <div class="container">
        <div class="row">
            <?php
                $sql="SELECT * FROM cars ORDER BY OD DESC";
                $result=$con->query($sql);
                while($col=$result->fetch_array()){
                    ?>
                        <div class="col-3">
                            <div class="content">
                                <div class="img">
                                    <img src="../move_img/<?php echo $col[6] ?>" alt="">
                                </div>
                                <p class="stk">In Stock</p>
                                <div class="txt">
                                    <ul>
                                        <li>Name    : <?php echo $col[1] ?></li>
                                        <li>Quantity    : <?php echo $col[2] ?></li>
                                        <li>price   :   <span>$<?php echo $col[3] ?></span></li>
                                        <li>Model   : <?php echo $col[4] ?></li>
                                    </ul>
                                    <div class="foot">
                                        <p class="btn btn-warning">See more...</p>
                                        <p class="btn btn-danger">Add to Card</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>
</body>
</html>