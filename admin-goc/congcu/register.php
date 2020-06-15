<?php
    //note:VanThang115: còn nhiều ô chưa kt định dạng, ô re-password chưa check
    require('core/connectsql.php');
 
    //Nếu không phải là sự kiện đăng ký thì không xử lý
    if (!isset($_POST['txtUsername'])){
        die('');
    }
     
          
    //Khai báo utf-8 để hiển thị được tiếng việt
    header('Content-Type: text/html; charset=UTF-8');
          
    //Lấy dữ liệu từ file dangky.php
    $username   = addslashes($_POST['txtUsername']);
    $password   = addslashes($_POST['txtPassword']);
    $email      = addslashes($_POST['txtEmail']);
    $fullname   = addslashes($_POST['txtFullname']);
    $address   = addslashes($_POST['txtAddress']);
    $phone        = addslashes($_POST['txtPhone']);
    $cmnd        = addslashes($_POST['txtCmnd']);
          
    //Kiểm tra người dùng đã nhập liệu đầy đủ chưa
    if (!$username || !$password || !$email || !$fullname || !$address || !$phone || !$cmnd)
    {
        echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
          
        // Mã khóa mật khẩu
        $password = md5($password);
          
    //Kiểm tra tên đăng nhập này đã có người dùng chưa
    // if ( mysqli_query($connection, "SELECT USERNAME FROM taikhoan WHERE USERNAME='$username'")) {
    //     echo "Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
    //     exit;
    // }
          
    // //Kiểm tra email có đúng định dạng hay không
    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email))
    {
        echo "Email này không hợp lệ. Vui long nhập email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
          
    // //Kiểm tra email đã có người dùng chưa
    // if ( mysqli_query($connection,"SELECT email FROM taikhoan WHERE email='$email'"))
    // {
    //     echo "Email này đã có người dùng. Vui lòng chọn Email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
    //     exit;
    // }
    // //Kiểm tra dạng nhập vào của ngày sinh
    // if (!preg_match("/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/", $phone))
    // {
    //         echo "Số điện thoại không hợp lệ. Vui long nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
    //         exit;
    //     }
          
    //Lưu thông tin thành viên vào bảng
    $sql = "INSERT INTO taikhoan (
        USERNAME,
        PASSWORD,
        EMAIL,
        NAME,
        ADDRESS,
        PHONE,
        CMND
    )
    VALUES (
        '$username',
        '$password',
        '$email',
        '$fullname',
        '$address',
        '$phone',
        '$cmnd'
        
    )" ;
    $addmember = mysqli_query($connection, $sql);
                          
    //Thông báo quá trình lưu
     
    if ($addmember)
        echo "Quá trình đăng ký thành công. <a href='login.html'>Vào trang đăng nhập</a>";
     else{           
        echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='register.html'>Thử lại</a>";
     }
?>