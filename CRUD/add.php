<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method = "POST">
        
        item id: <input type="text" name = 'itemid'>
        <br>
        item name: <input type="text" name="itemname" >
        <br>
        item quantity: <input type="text" name="itemquantity" >
        <br>
        item price: <input type="text" name="itemprice" >
        <br>
        <!-- hiện danh sách brand name/ brand id và catid/catname để chọn
        hoàn thiện file edit -->
        <input type="submit" value='Add' name='addnewitem'>
        <br>
        brand:
        <select name="brand_id" id="">
            <?php
            require 'connectdtb.php';
            $sql = 'Select * from brand';
            $result = mysql_query($conn, $sql);
            while($brand=mysql_fetch_array($result))
            { 
                echo '<option value="'.$brand["brand_id"].'">'.$brand["brand_nam"].'</option>';
            }
            ?>
        </select>
        <br>
        category:
        <select name="cat_id" id="">
            <?php
               require 'connectdtb.php';
            $sql = 'Select * from category';
            $result = mysql_query($conn, $sql);
            while($cat=mysql_fetch_array($result))
            { 
                echo '<option value="'.$cat["cat_id"].'">'.$cat["cat_name"].'</option>';
            }
            ?>
        </select>
    </form>
<?php
    if(isset($_POST['addnewitem']))
    {
        $itemid=$_POST['itemid'];
        if(!empty($itemid))
        {
            $itemname=$POST['itemname'];
            if(!empty($itemname))
            {
                $itemquantity = $_POST['itemquantity'];
                if(!empty($itemquantity)){
                    $itemprice = $_POST['itemprice'];
                    if(!empty($itemprice)){
                        require 'connectdtb.php';
                        $sql="INSERT INTO item(item_id, item_name, item_price, item_quantity, cat_id, brand_id) VALUES ('".$itemid."','".$itemname."','".$itemquantity."','".$itemprice."','".$POST['cat_id']."','".$POST['brand_id']."')";
                        $result=mysqli_query($conn, $sql);
                        header('location:listitems.php');
                    }
                }
            }
            echo $itemid;
        } 
        else echo 'hay nhap itemid';
    }
    
?>
</body>
</html>

<!-- đưa ds sổ ko nhập đc -->