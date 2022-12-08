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
            <th>brand id</th>
            <th>brand name</th>
        </tr>
        
        <?php
        
            require 'connectdtb.php';
            $query='select * from brand';
            $result=mysqli_query($conn, $query);
            $n=mysqli_num_rows($result);
            if ($n>0){
                while ($item=mysqli_fetch_assoc($result))
                {
                    echo '<tr>
                        <td>'.$item['brand_id'].'</td>
                        <td>'.$item['brand_name'].'</td>
                        <td><a href="delete.php?itemid='.$item['item_id'].'">Del</a>/<a href="edit.php?itemid='.$item['item_id'].'">Del</a></td>
                    </tr>';
                }
            }
        ?>
    </table>
    <a href="add.php">Add new item </a>
</body>
</html>