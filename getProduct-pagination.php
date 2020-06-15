<?php
    $start = isset($_GET['start']) ? $_GET['start'] : 1;
    $condition = isset($_GET['condition']) ? $_GET['condition'] : 1;
    require "core/DataProvider.php";
    $sql = "SELECT * FROM sanpham WHERE  $condition LIMIT $start, 8";
    $result = DataProvider::executeQuery($sql);
    $row = mysqli_fetch_all($result);
    //trả về 1 mảng tất cả các chuỗi data liên tiếp lấy từ bảng (lúc lấy data phải đếm tay để biết column số mấy)
    echo json_encode($row);
?>