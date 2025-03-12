<?php
    $con=new mysqli("localhost","root","","php_1");
    if(isset($_POST['tsave'])){
        $id=$_POST['tid'];
        $name=$_POST['tname'];
        $qty=$_POST['tqty'];
        $price=$_POST['tprice'];
        $model=$_POST['tmodel'];
        $od=$_POST['tod'];
        $img=$_FILES['tfile'];
        $type_img=pathinfo($img['name'],PATHINFO_EXTENSION);
        $type_name=rand(0000,9999).time().".".$type_img;
        $tmp_img=$img['tmp_name'];
        move_uploaded_file($tmp_img,"../move_img/".$type_name);
        $sql="INSERT INTO cars VALUES(null,'$name',$qty,$price,'$model',$od,'$type_name')";
        $con->query($sql);
    }
    else if(isset($_POST['tupdate'])){
        $getID=$_POST['tid'];
        $name=$_POST['tname'];
        $qty=$_POST['tqty'];
        $price=$_POST['tprice'];
        $model=$_POST['tmodel'];
        $od=$_POST['tod'];
        $img=$_FILES['tfile'];
        if($img['name']==NULL){
            $type_name=$_POST['img-UD'];
        }
        else{
            $type_img=pathinfo($img['name'],PATHINFO_EXTENSION);
            $type_name=rand(0000,9999).time().".".$type_img;
            $tmp_img=$img['tmp_name'];
            move_uploaded_file($tmp_img,"../move_img/".$type_name);
        }
        $sql="UPDATE cars SET NAME='$name',QTY=$qty,PRICE=$price,MODEL='$model',OD=$od,IMG='$type_name' WHERE ID=$getID";
        $con->query($sql);
    }
    else if(isset($_GET['idDL'])){
        $deleted=$_GET['idDL'];
        $sql="DELETE FROM cars WHERE ID=$deleted";
        $con->query($sql);
    }
    $getcartID='';
    $idcar='';
    $namecar='';
    $qtycar='';
    $pricecar='';
    $modelcar='';
    $odcar='';
    $img_UD='';
    if(isset($_GET['idUD'])){
        $IDUD=$_GET['idUD'];
        $sql="SELECT * FROM cars WHERE ID=$IDUD";
        $result=$con->query($sql);
        $col=$result->fetch_array();
        $getcartID=$col[0];
        $namecar=$col[1];
        $qtycar=$col[2];
        $pricecar=$col[3];
        $modelcar=$col[4];
        $odcar=$col[5];
        $img_UD=$col[6];
    }
    else{
        $sql="SELECT ID FROM cars ORDER BY ID DESC";
        $result=$con->query($sql);
        $count=$result->num_rows;
        if($count>0){
            $col=$result->fetch_array();
            $getcartID=$col[0]+1;
        }
        else{
            $getcartID=1;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Bootstrap_for_use/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/exercise2.css">
    <title>Document</title>
</head>
<body>
    <div class="main">
        <form action="exercise2.php" enctype="multipart/form-data" method="post">
            <label for="id">ID</label>
            <input type="text" name="tid" value="<?php echo $getcartID ?>" id="id" placeholder="Input ID " class="form-control">
            <label for="Name">NAME</label>
            <input type="text" name="tname" id="name" value="<?php echo $namecar ?>" placeholder="Input Name" class="form-control">
            <label for="qty">QTY</label>
            <input type="text" name="tqty" id="qty"  value="<?php echo $qtycar ?>" placeholder="Input Qty" class="form-control">
            <label for="price">PRICE</label>
            <input type="text" name="tprice" id="price"  value="<?php echo $pricecar ?>" placeholder="Input Price" class="form-control">
            <label for="model">MODEL</label>
            <input type="text" name="tmodel" id="model"  value="<?php echo $modelcar ?>" placeholder="Input Model" class="form-control">
            <label for="od">OD</label>
            <input type="text" name="tod" value="<?php echo $getcartID ?>" id="od" placeholder="Input OD" class="form-control">
            <label for="uping">Upload Photo</label>
            <div class="photo">
                <input type="file" name="tfile" id="img">
            </div>
            <input class="okay" type="text" name="img-UD" id="img-UD" value="<?php echo $img_UD ?>">
            <?php
                if(isset($_GET['idUD'])){
                    ?>
                        <input type="submit" value="Update" name="tupdate" class="btn btn-primary mt-2" >
                    <?php
                }
                else{
                    ?>
                        <input type="submit" value="Save" name="tsave" class="btn btn-primary mt-2" >
                    <?php
                }
            ?>
        </form>
    </div>  

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>QTY</th>
            <th>PRICE</th>
            <th>MODEL</th>
            <th>IMG</th>
            <th>OD</th>
            <th>Action</th>
        </tr>
        <?php
            $sql="SELECT * FROM cars ORDER BY ID DESC";
            $result=$con->query($sql);
            while($col=$result->fetch_array()){
        ?>
            <tr class="img">
                <td><?php echo $col[0] ?></td>
                <td><?php echo $col[1] ?></td>
                <td><?php echo $col[2] ?></td>
                <td><?php echo $col[3] ?></td>
                <td><?php echo $col[4] ?></td>
                <td><img src="../move_img/<?php echo $col[6] ?>" alt=""></td>
                <td><?php echo $col[5] ?></td>
                <td>
                    <a href="exercise2.php?idUD=<?php echo $col[0] ?>" class="btn btn-primary">Edit</a>
                    <a href="exercise2.php?idDL=<?php echo $col[0] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php
        }
    ?>
    </table>
</body>
</html>
<script>
    if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
    }
</script>