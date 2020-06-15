<?php
    require('../core/DataProvider.php');
    if(isset($_POST['name']))
    {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        $identity = $_POST['identity'];
        $phone = $_POST['phonenumber'];
        $role = $_POST['role'];
        $password = $_POST['password'];
        $password2 = $_POST['repassword'];
        
        $sql = "insert into taikhoan(IDUSER,USERNAME,PASSWORD,NAME,CMND,ADDRESS,PHONE,LEVEL,DUYET) 
                values ('','$username','$password','$name','$identity','$address','$phone',$role,'1')";
        
        $check = "select USERNAME from TAIKHOAN where USERNAME = '$username'";
        $run_check = DataProvider::executeQuery($check);
        if (mysqli_num_rows($run_check) == 0)
        {
            DataProvider::executeQuery($sql);
            echo '<script>alert("Bạn đăng ký thành công!");window.location="../../../index.php"</script>';                
        }
        else
            echo '<script>alert("Bạn đăng ký thất bại!");window.location="../../../index.php"</script>';  
    }
?>