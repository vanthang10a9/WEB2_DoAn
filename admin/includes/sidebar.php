<?php // theo phân quyền mà hiện các danh muc cho mỗi quyền
    if ($re['LEVEL'] == 3) 
    include('includes/sidebar-admin.php');
    if ($re['LEVEL'] == 2) 
    include('includes/sidebar-manager.php');
    if ($re['LEVEL'] == 1) 
    include('includes/sidebar-staff.php'); ?>