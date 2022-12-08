<?php
    require 'connectdtb.php';
    $itemid=$_GET['itemid'];
    echo $itemid;
    $sql='DELETE FROM item WHERE item_id="'.$itemid.'"';
    $result = mysqli_query($conn,$sql);
    header('location:listitems.php')

?>