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
        
        $sql = "UPDATE taikhoan SET NAME = '$name', ADDRESS = '$address', CMND = '$identity', PHONE = '$phone', LEVEL = '$role' WHERE USERNAME='$username'";
        
        $check = "select USERNAME from TAIKHOAN where USERNAME = '$username'";
        $run_check = DataProvider::executeQuery($check);
        if (mysqli_num_rows($run_check) == 1)
        {
            echo $sql;
            DataProvider::executeQuery($sql);         
        }
        else
            echo '<script>alert("Bạn đăng ký thất bại!");window.location="../../../index.php"</script>';  
    }
    if(isset($_POST['action-delete'])) {
        $userid = $_POST['userid'];
        echo $userid;
        echo $userid;
        $sql = "UPDATE taikhoan SET DUYET = 0 WHERE IDUSER=$userid";
        $run = DataProvider::executeQuery($sql);
        
        echo $run;
    }
?>