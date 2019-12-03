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