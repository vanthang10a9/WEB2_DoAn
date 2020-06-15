<?php
require('../core/DataProvider.php');

if (isset($_POST['product-action'])) {
    if ($_POST['product-action'] == "add") {
        $MASP = $_POST['productcode'];
        $TENSP = $_POST['productname'];
        $GIASP = $_POST['price'];
        $MACL = $_POST['category'];
        $MOTASP = $_POST['description'];
        $MANCC = $_POST['supplier'];
        $image = $_POST['image-name'] != "" ? $_POST['image-name'] : "";
        $img = $_POST['image-src'] != "" ? $_POST['image-src'] : "";

        $sql = "INSERT INTO sanpham(MASP, TENSP, GIASP, MACL, MOTASP, HINHANHSP, MANCC, DUYET) " .
            "VALUES('$MASP', '$TENSP', '$GIASP', '$MACL', '$MOTASP', '$image', '$MANCC', 0)";
        echo $sql;
        $run = DataProvider::executeQuery($sql);
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = "../images/products/$image";
        $success = file_put_contents($file, $data);
        echo $success ? $file : 'Unable to save the file.';
    }

    if ($_POST['product-action'] == "edit") {
        $MASP = $_POST['productcode'];
        $TENSP = $_POST['productname'];
        $GIASP = $_POST['price'];
        $MACL = $_POST['category'];
        $MOTASP = $_POST['description'];
        $MANCC = $_POST['supplier'];
        $image = $_POST['image-name'] != "" ? $_POST['image-name'] : "";
        $img = $_POST['image-src'] != "" ? $_POST['image-src'] : "";

        if ($image == "" && $img == "") {
            $sql = "UPDATE sanpham SET TENSP = '$TENSP', GIASP = '$GIASP', MACL='$MACL',"
                . " MOTASP='$MOTASP', MANCC='$MANCC' "
                . "WHERE MASP = '$MASP'";
        } else {
            $sql = "UPDATE sanpham SET TENSP = '$TENSP', GIASP = '$GIASP', MACL='$MACL',"
                . " MOTASP='$MOTASP', MANCC='$MANCC', HINHANHSP='$image' "
                . "WHERE MASP = '$MASP'";
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file = "../images/products/$image";
            $success = file_put_contents($file, $data);
            echo $success ? $file : 'Unable to save the file.';
        }

        $run = DataProvider::executeQuery($sql);

        echo $run;
    }

    if ($_POST['product-action'] == "delete") {
        $MASP = $_POST['id'];
        $sql = "UPDATE sanpham SET DUYET=1 WHERE MASP='$MASP'";
        echo $sql;
        $run = DataProvider::executeQuery($sql);

        echo $run;
    }

    if ($_POST['product-action'] == "activation") {
        $MASP = $_POST['id'];
        $sql = "UPDATE sanpham SET DUYET=2 WHERE MASP='$MASP'";
        echo $sql;
        $run = DataProvider::executeQuery($sql);

        echo $run;
    }
}

if (isset($_POST['supplier-action'])) {
    if ($_POST['supplier-action'] == 'add') {
        $TENNCC = $_POST['supplierName'];
        $THONGTIN = $_POST['supplierDetail'];
        $sql = "INSERT INTO nhacungcap(TENNCC, THONGTIN, DUYET) VALUES('$TENNCC', '$THONGTIN', '0')";
        $run = DataProvider::executeQuery($sql);
        echo $run;
    }

    if ($_POST['supplier-action'] == 'edit') {
        $MANCC = $_POST['id'];
        $TENNCC = $_POST['supplierName'];
        $THONGTIN = $_POST['supplierDetail'];
        $sql = "UPDATE nhacungcap SET TENNCC='$TENNCC', THONGTIN='$THONGTIN' WHERE MANCC='$MANCC'";
        $run = DataProvider::executeQuery($sql);
        echo $run;
    }

    if ($_POST['supplier-action'] == 'delete') {
        $MANCC = $_POST['id'];
        $sql = "UPDATE nhacungcap SET DUYET = '0' WHERE MANCC='$MANCC'";
        $run = DataProvider::executeQuery($sql);
        echo $run;
    }
}

if (isset($_POST['receipt-action'])) {
    if ($_POST['receipt-action'] == "add") {
        $MANCC = $_POST['supplier'];
        $MANV = "4";
        //$NGAYNHAP = $_POST['date'];
        $NGAYNHAP = str_replace('/', '-', $_POST['date']);
        $NGAYNHAP = date('Y-m-d', strtotime($NGAYNHAP));
        $TONGTIEN = $_POST['total'];
        $sql = "INSERT INTO donnhap(MANCC, MANV, NGAYNHAP, TONGTIEN, DUYET) VALUES('$MANCC', '$MANV', '$NGAYNHAP', '$TONGTIEN', '0')";
        $run = DataProvider::executeQuery($sql);
        $id =  DataProvider::executeQuery("SELECT max(MADN) AS id FROM donnhap");
        $row = mysqli_fetch_assoc($id);
        echo $row['id'];
    }
    if ($_POST['receipt-action'] == "add-detail") {
        $MASP = $_POST['productId'];
        $SOLUONG = $_POST['soluong'];
        $GIANHAP = $_POST['gianhap'];
        $MADN = $_POST['id'];

        $sql = "INSERT INTO chitietdonnhap(MADN, MASP, SOLUONG, GIANHAP) VALUES('$MADN', '$MASP', '$SOLUONG', '$GIANHAP')";
        
        $run = DataProvider::executeQuery($sql);
        echo $run;
        
    }
}
