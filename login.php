<?php include('admin/alertModal.php'); ?>
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
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">


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
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url(admin/congcu/img/bg_login.jpg)"></div>
                            <div class="col-lg-6 ">
                                <div class="p-5 ">
                                    <div class="text-center ">
                                        <h1 class="h4 text-gray-900 mb-4 ">Chào mừng bạn trở lại !</h1>
                                    </div>
                                    <form class="user" id="loginForm" onsubmit="return check()">
                                        <div class="form-group ">
                                            <input name="txtUsername" id="txtUsername" type="text" class="form-control form-control-user" aria-describedby="emailHelp " placeholder="Tên đăng nhập " />
                                        </div>
                                        <div class="form-group ">
                                            <input type="password" name="txtPassword" id="txtPassword" class="form-control form-control-user" placeholder="Mật khẩu " />
                                        </div>
                                        <div class="form-group ">
                                            <div class="custom-control custom-checkbox small ">
                                                <input type="checkbox " class="custom-control-input " id="customCheck ">
                                                <label class="custom-control-label " for="customCheck ">Ghi nhớ đăng nhập</label>
                                            </div>
                                        </div>
                                        <input type="submit" id="submit-login" class="btn btn-primary btn-user btn-block " value="Đăng nhập" />
                                        <hr>
                                        <!-- <a href="#" class="btn btn-google btn-user btn-block ">
                                            <i class="fab fa-google fa-fw "></i> Đăng nhập với Google
                                        </a>
                                        <a href="#" class="btn btn-facebook btn-user btn-block ">
                                            <i class="fab fa-facebook-f fa-fw "></i> Đăng nhập với Facebook
                                        </a> -->
                                    </form>
                                    <hr>
                                    <div class="text-center ">
                                        <a class="small " href="forgot-password.php "> Quên mật khẩu?</a>
                                    </div>
                                    <div class="text-center ">
                                        <a class="small " href="register.php ">Tạo mới tài khoản!</a>
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
    <script src="admin/vendor/jquery/jquery.min.js "></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js "></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js "></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js "></script>

    <script>
        function check() {
            if ($('#txtUsername').val() == '' || $('#txtPassword').val() == '') {
                alert('Vui lòng nhập đầy đủ thông tin !');
                return false;
            }
            return true;
        }
        var ok = 0;
        $('#submit-login').click(function(e) {
            var x = $('#loginForm').serializeArray();

            x.push({
                'name': 'user-action',
                'value': 'login'
            })
            $.ajax({
                type: "POST",
                url: "handle-user.php",
                data: x,
                success: function(results) {
                    var r = $.parseJSON(results);
                    if (r == null) {
                        $('#alertModal .modal-body p').html("Tài khoản hoặc mật khẩu không đúng!");
                        $('#alertModal').modal('show');
                    } else if (r['DUYET'] == '0') {
                        $('#alertModal .modal-body p').html("Tài khoản chưa được kích hoạt!");
                        $('#alertModal').modal('show');
                    } else {
                        $('#alertModal .modal-body p').html("Đăng nhập thành công");
                        ok = Number(r['LEVEL'] )+ 1;
                        $('#alertModal').modal('show');
                    }
                }
            });
            e.preventDefault();
        });
        $('#alertModal').on('hidden.bs.modal', function(e) {
            if (ok == 1) {
                location.href = 'index.php';
            }else{
                location.href = 'admin/index.php';
            }
            // if (ok == 2) {
            //     location.href = 'staff/index.php';
            // }
            // if (ok == 3) {
            //     location.href = 'manager/index.php';
            // }
            // if (ok == 4) {
            //     location.href = 'admin/index.php';
            // }
        });
    </script>

</body>

</html>