<?php
session_start();
require('core/DataProvider.php');
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
//Nếu không phải là sự kiện đăng ký thì không xử lý
if (isset($_POST['user-action'])) {
    if ($_POST['user-action'] == 'login') {
        if (isset($_POST['txtUsername']) && isset($_POST['txtPassword'])) {
            //die('');
            $username   = addslashes($_POST['txtUsername']);
            $password   = md5($_POST['txtPassword']);
            $sql = "SELECT * FROM taikhoan WHERE USERNAME='$username' AND PASSWORD='$password' LIMIT 1";
            $result = DataProvider::executeQuery($sql);
            $row = mysqli_fetch_assoc($result);
            if ($row['DUYET'] == '1') {
                $_SESSION['username'] = $username;
            }
            echo json_encode($row);
        }
        // if ($result = DataProvider::executeQuery('SELECT * FROM taikhoan')) {
        //     if ($result != null) {
        //         while ($row = mysqli_fetch_array($result)) {
        //             if ($row['USERNAME'] == $username) {
        //                 if ($row['PASSWORD'] == $password) {
        //                     echo "Đăng nhập thành công ! <a href='../../../HTTT/index.php'>Về trang chủ</a>";
        //                     $_SESSION['username'] = $username;
        //                     //header("Location: ../../index.php"); //điều hướng tự chuyển hướng về home
        //                     break;
        //                 } else {
        //                     echo "Password không đúng !  <a href='javascript: history.go(-1)'>Trở lại</a>";
        //                     //header("Location: login.html?status=false"); //tự chuyển về lại trang login.html
        //                 }
        //             }
        //         }
        //         // if(!isset($_SESSION['username'])){
        //         //     echo "Đăng nhập không thành công !";

        //         // }
        //     }
        // }
    }
}

if (isset($_POST['logout'])) {
    unset($_SESSION['username']);
    header('location: login.php');
}

if (isset($_POST['order-action'])) {
    if ($_POST['order-action'] == 'add') {
        $idUser = $_POST['idUser'];
        $tongtien = $_POST['tongtien'];
        $date = date("Y-m-d");

        $sql = "INSERT INTO donhang(IDUSER, TONGTIEN, NGAYDH, STATUS, MANV) VALUES('$idUser', '$tongtien', '$date', '0', '26')";
        $run = DataProvider::executeQuery($sql);
        $id =  DataProvider::executeQuery("SELECT max(MADH) AS id FROM donhang");
        $row = mysqli_fetch_assoc($id);
        echo $row['id'];
    }

    if ($_POST['order-action'] == 'add-detail') {
        $MASP = $_POST['masp'];
        $SOLUONG = $_POST['quantity'];
        $GIASP = $_POST['price'];
        $MADH = $_POST['madh'];

        $sql = "INSERT INTO chitietdonhang(MADH, MASP, SOLUONG, GIASP) VALUES('$MADH', '$MASP', '$SOLUONG', '$GIASP')";
        $run = DataProvider::executeQuery($sql);
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        //echo $sql;
        echo $run;
    }

    if ($_POST['order-action'] == 'update-detail') {
        $NAME = $_POST['name'];
        $ADDRESS = $_POST['address'];
        $PHONE = $_POST['phone'];
        $EMAIL = $_POST['email'];
        $MADH = $_POST['madh'];

        $sql = "UPDATE donhang SET NAME='$NAME', ADDRESS='$ADDRESS', PHONE='$PHONE', EMAIL='$EMAIL' WHERE MADH = '$MADH'";
        $run = DataProvider::executeQuery($sql);
        //echo $sql;
        echo $run;
    }
}
if (isset($_POST['txtFullname'])) {
    $name = $_POST['txtFullname'];
    $email = $_POST['txtEmail'];
    $address = $_POST['txtAddress'];
    $username = $_POST['txtUsername'];
    $phone = $_POST['txtPhone'];
    $identity = $_POST['txtCmnd'];
    $password = md5($_POST['txtPassword']);
    $password2 = md5($_POST['txtRePassword']);

    $sql = "insert into taikhoan(USERNAME,PASSWORD,NAME,CMND,ADDRESS,PHONE,EMAIL,LEVEL,DUYET) 
            values ('$username','$password','$name','$identity','$address','$phone','$email','0','1')";
    // $check = "select USERNAME from TAIKHOAN where USERNAME = '$username'";
    // $run_check = DataProvider::executeQuery($check);
    // if (mysqli_num_rows($run_check) == 0) {
    $kq = DataProvider::executeQuery($sql);
    //     echo '1';
    // } else
    //     echo '0';
    
    if($kq){
        ?>
        <script>
            alert("Đăng kí thành công");
            window.location.assign("login.php");
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("Đăng kí thất bại");
            window.location.assign("register.php");
        </script>
        <?php
    }
}
// echo $_POST['user'];
if(isset($_POST['user'])){
    $username = $_POST['user'];
    // echo $username;
    $check = "select USERNAME from taikhoan where USERNAME = '$username'";
    $run_check = DataProvider::executeQuery($check);
    // echo $check;
    // $kq = false;
    if (mysqli_num_rows($run_check) > 0) {
        // $kq = true;
        echo "Tên đăng nhập đã tồn tại";
    }else{
        echo "Thành công ^.^";
    }
}

if (isset($_POST['action-dh'])) {
    if ($_POST['action-dh'] == 'select-detail') {
        $id = $_POST['id'];
        $sql = "SELECT * FROM chitietdonhang ct INNER JOIN sanpham sp ON ct.MASP = sp.MASP WHERE ct.MADH = '$id'";
        $result = DataProvider::executeQuery($sql);
        $table = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td><img src='images/products/" . $row['HINHANHSP'] . "' alt='' width='100px'></td>";
            $table .= "<td>" . $row['TENSP'] . "</td>";
            $table .= "<td>" . $row['GIASP'] . "</td>";
            $table .= "<td>" . $row['SOLUONG'] . "</td>";
            $table .= "</tr>";
        }

        print $table;
    }
}
