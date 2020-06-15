<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PizzaHot- Register</title>

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">
    <?php include('admin/alertModal.php'); ?>
</head>

<body style="background-color: #82ae46 !important;">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block " >
                        <a href="index.php">
                            <img src="admin/congcu/img/bg_register2.jpg" width="480" height="670">
                        </a>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Tạo tài khoản!</h1>
                            </div>
                            <form class="user" name="form_register" action="handle-user.php" role="form" method="post" onsubmit="return dangki()"  >

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="txtFullname" placeholder="Họ và tên"  >
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="txtEmail" placeholder="Email" >
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="txtAddress" placeholder="Địa chỉ" >
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="txtPhone" placeholder="Sdt">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="txtCmnd" placeholder="CMND" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="txtUsername" id="username" placeholder="Tên đăng nhập " >
                                    <div id="message" style="padding: 5px 0 0 18px; color: red; font-weight: bold;"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" data-minlength="6" id="inputPassword" class="form-control form-control-user" name="txtPassword" placeholder="Mật khẩu" >
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" data-minlength="6" data-match="#inputPassword" data-match-error="Wh" name="txtRePassword" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Nhập lại mật khẩu" >
                                    </div>
                                </div>
                                <button type="submit" id="submit-regis" class="btn btn-primary btn-user btn-block" value="Đăng ký"  />Đăng ký</button>

                                <!-- <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Đăng kí với Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Đăng kí với Facebook
                                </a> -->
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">Quên mật khẩu?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Đã có tài khoản? Đăng nhập ngay!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/register.js"></script>
    <script src="js/ajax.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>
    <script src="admin/js/validator.js"></script>
</body>

</html>