<?php
require('../core/DataProvider.php');
if (isset($_POST['action'])) {
    if ($_POST['action'] == "activation") {
        $userid = $_POST['userid'];
        echo $userid;
        echo $userid;
        $sql = "UPDATE taikhoan SET DUYET = 1 WHERE IDUSER=$userid";
        $run = DataProvider::executeQuery($sql);
        echo $run;
    }
    if ($_POST['action'] == "delete") {
        $userid = $_POST['userid'];
        $sql = "DELETE FROM taikhoan WHERE IDUSER=$userid";
        $run = DataProvider::executeQuery($sql);
        echo $run;
    }
}
if (isset($_POST['category-action'])) {
    if ($_POST['category-action'] == "add") {
        $categoryName = $_POST['categoryname'];
        $image = $_POST['image-name'] != "" ? $_POST['image-name'] : "";
        $img = $_POST['image-src'] != "" ? $_POST['image-src'] : "";
        $sql = "INSERT INTO loaisanpham(TENCL, HINHANHSP) VALUES('$categoryName', '$image')";
        $run = DataProvider::executeQuery($sql);
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = "../images/products/$image";
        $success = file_put_contents($file, $data);
        echo $success ? $file : 'Unable to save the file.';
        echo $run;
    }

    if ($_POST['category-action'] == "edit") {
        $categoryName = $_POST['categoryname'];
        $id = $_POST['id'];
        $image = $_POST['image-name'] != "" ? $_POST['image-name'] : "";
        $img = $_POST['image-src'] != "" ? $_POST['image-src'] : "";

        if ($image == "" && $img == "") {
            $sql = "UPDATE loaisanpham SET TENCL = '$categoryName' WHERE MACL = '$id'";
        } else {
            $sql = "UPDATE loaisanpham SET TENCL = '$categoryName', HINHANHSP = '$image' WHERE MACL = '$id'";
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
}
