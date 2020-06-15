<?php
session_start();
require('../../../HTTT/core/DataProvider.php');
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
//Nếu không phải là sự kiện đăng ký thì không xử lý
if (!isset($_POST['txtUsername'])) {
    die('');
}

$username   = addslashes($_POST['txtUsername']);
$password   = addslashes($_POST['txtPassword']);

$password = $password;

if ($result = DataProvider::executeQuery('SELECT * FROM taikhoan')) {
    if ($result != null) {
        while ($row = mysqli_fetch_array($result)) {
            if ($row['USERNAME'] == $username) {
                if ($row['PASSWORD'] == $password) {
                    echo "Đăng nhập thành công ! <a href='../../../HTTT/index.php'>Về trang chủ</a>";
                    $_SESSION['username'] = $username;
                    //header("Location: ../../index.php"); //điều hướng tự chuyển hướng về home
                    break;
                } else {
                    echo "Password không đúng !  <a href='javascript: history.go(-1)'>Trở lại</a>";
                    //header("Location: login.html?status=false"); //tự chuyển về lại trang login.html
                }
            }
        }
        // if(!isset($_SESSION['username'])){
        //     echo "Đăng nhập không thành công !";

        // }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PizzaHot - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <script>
        if (isset($_GET['status'])) {
            alert("Sai thông tin đăng nhập !");
        }
    </script>

</head>

<body style="background-color: #82ae46 !important;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url(img/bg_login.jpg)"></div>
                            <div class="col-lg-6 ">
                                <div class="p-5 ">
                                    <div class="text-center ">
                                        <h1 class="h4 text-gray-900 mb-4 ">Chào mừng bạn trở lại !</h1>
                                    </div>
                                    <form class="user" action="login.php" method="POST" onsubmit="return check()">
                                        <div class="form-group ">
                                            <input name="txtUsername" id="txtUsername" type="text" class="form-control form-control-user" aria-describedby="emailHelp " placeholder="Tên đăng nhập " />
                                        </div>
                                        <div class="form-group ">
                                            <input name="txtPassword" id="txtPassword" type="password " class="form-control form-control-user" placeholder="Mật khẩu " />
                                        </div>
                                        <div class="form-group ">
                                            <div class="custom-control custom-checkbox small ">
                                                <input type="checkbox " class="custom-control-input " id="customCheck ">
                                                <label class="custom-control-label " for="customCheck ">Ghi nhớ đăng nhập</label>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block " value="Đăng nhập" />
                                        <hr>
                                        <a href="#" class="btn btn-google btn-user btn-block ">
                                            <i class="fab fa-google fa-fw "></i> Đăng nhập với Google
                                        </a>
                                        <a href="#" class="btn btn-facebook btn-user btn-block ">
                                            <i class="fab fa-facebook-f fa-fw "></i> Đăng nhập với Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center ">
                                        <a class="small " href="forgot-password.html "> Quên mật khẩu?</a>
                                    </div>
                                    <div class="text-center ">
                                        <a class="small " href="register.html ">Tạo mới tài khoản!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js "></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js "></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js "></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js "></script>

    <script>
        function check() {
            if ($('#txtUsername').val() == '' || $('#txtPassword').val() == '') {
                alert('Vui lòng nhập đầy đủ thông tin !');
                return false;
            }
            return true;
        }
    </script>

</body>

</html>