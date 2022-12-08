<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>item id</th>
            <th>item name</th>
            <th>item quantity</th>
            <th>item price</th>
            <!-- <th>item brand id</th> -->
            <!-- <th>item category</th> -->
            <th>action</th>
        </tr>
        
        <?php
        
            require 'connectdtb.php';
            $query='select * from item';
            $result=mysqli_query($conn, $query);
            $n=mysqli_num_rows($result);
            if ($n>0){
                while ($item=mysqli_fetch_assoc($result))
                {
                    echo '<tr>
                        <td>'.$item['item_id'].'</td>
                        <td>'.$item['item_name'].'</td>
                        <td>'.$item['item_quantity'].'</td>
                        <td>'.$item['item_price'].'</td>
                        <td><a href="delete.php?itemid='.$item['item_id'].'">Del</a>/<a href="edit.php?itemid='.$item['item_id'].'">Del</a></td>
                    </tr>';
                }
            }
        ?>
    </table>
    <a href="add.php">Add new item </a>
</body>
</html>