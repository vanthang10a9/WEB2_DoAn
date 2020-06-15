<?php
require('../core/DataProvider.php');
if(isset($_POST['action-dh'])) {
    if($_POST['action-dh'] == 'select-detail') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM chitietdonhang ct INNER JOIN sanpham sp ON ct.MASP = sp.MASP WHERE ct.MADH = '$id'";
        $result = DataProvider::executeQuery($sql);
        $table = "";
        while($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td><img src='../images/products/".$row['HINHANHSP']."' alt='' width='100px'></td>";
            $table .= "<td>".$row['TENSP']."</td>";
            $table .= "<td>".$row['GIASP']."</td>";
            $table .= "<td>".$row['SOLUONG']."</td>";
            $table .= "</tr>";
        }
        
        print $table;
    }       
}

if(isset($_POST['action-dn'])) {
    if($_POST['action-dn'] == 'select-detail') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM chitietdonnhap ct INNER JOIN sanpham sp ON ct.MASP = sp.MASP WHERE ct.MADN = '$id'";
        $result = DataProvider::executeQuery($sql);
        $table = "";
        while($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td><img src='../images/products/".$row['HINHANHSP']."' alt='' width='100px'></td>";
            $table .= "<td>".$row['TENSP']."</td>";
            $table .= "<td>".$row['GIANHAP']."</td>";
            $table .= "<td>".$row['SOLUONG']."</td>";
            $table .= "</tr>";
        }
        
        print $table;
    }       
}

if(isset($_POST['action-receipt'])) {
    if($_POST['action-receipt'] == "activation") {
        $id = $_POST['id'];
        $sql = "UPDATE donnhap SET DUYET = 1 WHERE MADN='$id'";
        $sql_detail = "SELECT MASP, SOLUONG FROM chitietdonnhap WHERE MADN = '$id'";
        $run_detail = DataProvider::executeQuery($sql_detail);
        while($row_detail = mysqli_fetch_assoc($run_detail)) {
            $MASP = $row_detail['MASP'];
            $SOLUONG = $row_detail['SOLUONG'];
            $sql_product = "UPDATE sanpham SET DUYET = 2, SOLUONGSP = SOLUONGSP + '$SOLUONG' WHERE MASP = '$MASP'";
            DataProvider::executeQuery($sql_product);
        }
        $run = DataProvider::executeQuery($sql);
        echo $run;
    }

    if($_POST['action-receipt'] == "delete") {
        $id = $_POST['id'];
        $sql = "DELETE FROM chitietdonnhap WHERE MADN='$id'";
        $run = DataProvider::executeQuery($sql);
        $sql = "DELETE FROM donnhap WHERE MADN='$id'";
        $run = DataProvider::executeQuery($sql);
        echo $run;
    }
}

if(isset($_POST['action-supplier'])) {
    if($_POST['action-supplier'] == "activation") {
        $id = $_POST['id'];
        $sql = "UPDATE nhacungcap SET DUYET = 1 WHERE MANCC='$id'";
        $run = DataProvider::executeQuery($sql);
        echo $run;
    }

    if($_POST['action-supplier'] == "delete") {
        $id = $_POST['id'];
        $sql = "DELETE FROM sanpham WHERE MANCC='$id'";
        $run = DataProvider::executeQuery($sql);
        $sql = "DELETE FROM nhacungcap WHERE MANCC='$id'";
        $run = DataProvider::executeQuery($sql);
        echo $id;
    }
}

if(isset($_POST['action-category'])) {

    if($_POST['action-category'] == "delete") {
        $id = $_POST['id'];
        $sql_check = "SELECT * FROM sanpham WHERE MACL='$id'";
        $run_check = DataProvider::executeQuery($sql_check);
        if(mysqli_num_rows($run_check) == 0) {
            $sql = "DELETE FROM loaisanpham WHERE MACL='$id'";
            $run = DataProvider::executeQuery($sql);
            echo $run;
        } else {
            echo "Có sản phẩm tồn tại trong danh mục, không thể xóa!";
            return false;
        }
    }
}
?>