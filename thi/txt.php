Đề bài:
PHP&SQL (hiển thị, thêm, sửa, xóa, tìm kiếm)
CSDL về sinh viên: sinhvien
server: localhost
username: root
password: ""
1. Truy cập csdl
2. Hiển thị ds sinh viên
3. Tạo thêm liên kết để nhập thêm sv mới, sử dụng form đã tạo (form nhập DL)
4. Tạo thêm liên kết để xóa 1 sinh viên
5. Tạo liên kết để sửa thông tin 1 sinh viên
6. Tạo chức năng tìm kiếm sinh viên

1. Truy cập vào Cơ sở dữ liệu: File dbConnect.php
Cách 1:
<?php
    define ("server","localhost");
    define ("username","root");
    define ("password","");
    define ("dbname","sinhvien");
    $conn=mysqli_connect(server,username,password,dbname);
    if (!$conn) echo "connect du lieu ko thanh cong";
?>

Cách 2:
<?php
    $conn=mysqli_connect("localhost", "root", "", "sinhvien");
?>
2. Hiển thị danh sách sv 
Hiển thị danh sách sinh viên(kiểu bảng):File sinhvien.php

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>MSV</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Thao tác</th>
        </tr>    
 
        <?php
            require "dbConnect.php";
            $sql="SELECT * FROM svinfo"; 
            $result=mysqli_query($conn,$sql); 
//KQ truy vấn là 1 bảng được lưu vào biến result
            $numRow=mysqli_num_rows($result); 
//kiểm tra KQ có bao nhiêu dòng
            if ($numRow>0){
                while($row=mysqli_fetch_array($result)) 
//biến row lưu lại từng dòng một của KQ truy vấn => KQ của 1 dòng truy vấn
//$row=mysqli_fetch_array: lấy từng dòng trong câu lệnh sql, lưu vào biến row
                { 
                    echo '<tr>
                    <td>'.$row['msv'].'</td>
                    <td>'.$row['hovaten'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['diachi'].'</td>
                    <td><a href="xoa.php?id='.$row['msv'].'">Xoá</a> - 
                    <a href="sua.php?id='.$row['msv'].'">Sửa</a></td>
                    </tr>';
                }
            }
        ?>
    </table>
    <a href="nhap.php">Thêm sinh viên mới</a><br>
    <a href="timkiem.php">Tìm kiếm sinh viên</a>
</body>
</html>
3. File tạo form nhập dữ liệu:
 
//Viết code nhập DL để liên kết => nhập sv mới

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập dữ liệu sinh viên</title>
</head>
<body>
    <form action="" method="POST">
        Nhập mã sinh viên: <input type="number" name="msv"><br>
        Nhập tên sinh viên: <input type="text" name="hoten"><br>
        Nhập email: <input type="text" name="email"><br>
        Nhập địa chỉ: <input type="text" name="diachi"><br>
        <input type="submit" name="nhap" value="Nhập thông tin">
    </form>
    <?php
    require 'dbConnect.php';
    if (isset($_POST['nhap']))
    {
        $MSV=$_POST['msv'];
        $TEN=$_POST['hoten'];
        $EMAIL=$_POST['email'];
        $DC=$_POST['diachi'];
        if ($MSV=="") echo "Bạn hãy nhập msv!";
        if ($TEN=="") echo "Bạn hãy nhập ho va ten!";
        if ($EMAIL=="") echo "Bạn hãy nhập email!";
        if ($DC=="") echo "Bạn hãy nhập dia chi!";
        if($MSV!=''&&$TEN!=''&&$EMAIL!=''&&$DC!="")
        {
            $sql='INSERT INTO svinfo (msv,hovaten,email,diachi) VALUES('.$MSV.',"'.$TEN.'","'.$EMAIL.'","'.$DC.'")';
            mysqli_query($conn,$sql);
            header ("location:sinhvien.php");
        }
    }
?>

</body>
</html>

4. Tạo thêm liên kết (chức năng) để nhập thêm sinh viên mới, sử dụng form nhập DL => Tạo thêm nút để có thể nhập thêm sinh viên
Bài làm
(Trong file sinhvien.php) <a href="nhap.php">Thêm sinh viên mới</a><br> 

(Thêm trong file nhap.php)
//Viết code nhập DL để có thể tạo liên kết => nhập sv mới
<?php
    require 'dbConnect.php';
    if (isset($_POST['nhap']))
    {
        $MSV=$_POST['msv'];
        $TEN=$_POST['hoten'];
        $EMAIL=$_POST['email'];
        $DC=$_POST['diachi'];
        if ($MSV=="") echo "Bạn hãy nhập msv!";
        if ($TEN=="") echo "Bạn hãy nhập ho va ten!";
        if ($EMAIL=="") echo "Bạn hãy nhập email!";
        if ($DC=="") echo "Bạn hãy nhập dia chi!";
        if($MSV!=''&&$TEN!=''&&$EMAIL!=''&&$DC!="")
        {
            $sql='INSERT INTO svinfo (msv,hovaten,email,diachi) VALUES('.$MSV.',"'.$TEN.'","'.$EMAIL.'","'.$DC.'")';
            mysqli_query($conn,$sql);
            header ("location:sinhvien.php");
        }
    }
?>

5. Tạo thêm liên kết (chức năng) để xóa thêm sinh viên
<?php
    require 'dbconnect.php';
    $MSV=$_GET['msv'];
    $sql='DELETE FROM svinfo WHERE msv ="'.$MSV.'"';
    $result = mysqli_query($conn,$sql);
    header('location:sinhvien.php')
?>

6. Tạo chức năng tìm kiếm sinh viên
<div align="center">
            <form action="search.php" method="get">
                Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>
        <?php
        // Nếu người dùng submit form thì thực hiện
        if (isset($_REQUEST['ok'])) 
        {
            // Gán hàm addslashes để chống sql injection
            $search = addslashes($_GET['search']);
 
            // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
            if (empty($search)) {
                echo "Yeu cau nhap du lieu vao o trong";
            } 
            else
            {
                // Dùng câu lênh like trong sql và sứ dụng toán tử % của php để tìm kiếm dữ liệu chính xác hơn.
                $query = "select * from users where username like '%$search%'";
 
                // Kết nối sql
                mysql_connect("localhost", "root", "vertrigo", "basic");
 
                // Thực thi câu truy vấn
                $sql = mysql_query($query);
 
                // Đếm số đong trả về trong sql.
                $num = mysql_num_rows($sql);
 
                // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
                if ($num > 0 && $search != "") 
                {
                    // Dùng $num để đếm số dòng trả về.
                    echo "$num ket qua tra ve voi tu khoa <b>$search</b>";
 
                    // Vòng lặp while & mysql_fetch_assoc dùng để lấy toàn bộ dữ liệu có trong table và trả về dữ liệu ở dạng array.
                    echo '<table border="1" cellspacing="0" cellpadding="10">';
                    while ($row = mysql_fetch_assoc($sql)) {
                        echo '<tr>';
                            echo "<td>{$row['user_id']}</td>";
                            echo "<td>{$row['username']}</td>";
                            echo "<td>{$row['password']}</td>";
                            echo "<td>{$row['email']}</td>";
                            echo "<td>{$row['address']}</td>";
                        echo '</tr>';
                    }
                    echo '</table>';
                } 
                else {
                    echo "Khong tim thay ket qua!";
                }
            }
        }
        ?>   
    </body>

7. Edit 
Tạo thêm cột (hoặc gộp chung trong cột “Thao tác”) trong sinhvien.php
Tạo liên kết:
<td><a href="sua.php?id='.$row['msv'].'">Sửa</a></td>
Hoặc tạo chung cùng với “Xóa”:
<td><a href="xoa.php?id='.$row['msv'].'">Xoá</a> - <a href="sua.php?id='.$row['msv'].'">Sửa</a></td>
sua.php
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <form action="" method = "POST">
    <?php
         require 'connectdtb.php';
         $itemid=$_GET['itemid']; 
        $sql='select * from item_id="'.$itemid.'"';
        $result=mysql_query($conn, $sql);
        while($item=mysql_fetch_array($result)){
            echo 'item id: <input type="text" name="itemid" value="'.$item['item_id'].'">';
        }
        ?>
        item id: <input type="text" name = 'itemid'>
        <br>
        item name: <input type="text" name="itemname" >
        <br>
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
        category:...
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
</body> </html>

