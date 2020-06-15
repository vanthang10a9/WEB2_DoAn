<?php
require 'core/DataProvider.php';

if (!isset($_SESSION)) {
    session_start();
}
$icon_cart = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $k => $v) {
        if (isset($k))
            $icon_cart += $v;
    }
} else {
    $icon_cart = 0;
}

$user = "Đăng nhập";
if (isset($_SESSION['username'])) {
    $sql = "SELECT NAME FROM taikhoan WHERE USERNAME='" . $_SESSION['username'] . "'";
    $result = DataProvider::executeQuery($sql);
    $row = mysqli_fetch_array($result);
    $user = $row['NAME'];
}
?>
<div class="py-1 bg-primary">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                        <span class="text">+ 1235 2355 98</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                        <span class="text">PizzaHot@email.com</span>
                    </div>
                    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                        <span class="text">3-5 Ngày làm việc có giao hàng &amp; trả hàng miễn phí</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php">PIZZA HÓt</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Danh mục
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item nav-item-home"><a href="index.php" class="nav-link">Trang chủ</a></li>
                <li class="nav-item dropdown nav-item-shop">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mua sắm</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="shop.php">Mua sắm</a>
                        <?php 
                        if(isset($_SESSION['username'])){
                        ?>
                            <a class="dropdown-item" href="cart.php">Giỏ hàng</a>
                            <!-- <a class="dropdown-item" id="subitem-checkout" href="checkout.php">Thanh toán</a> -->
                        <?php 
                        } 
                        ?>
                    </div>
                </li>
                <li class="nav-item nav-item-about"><a href="about.php" class="nav-link">Thông tin</a></li>
                <!-- <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li> -->
                <li class="nav-item nav-item-contact"><a href="contact.php" class="nav-link">Liên hệ</a></li>
                <li class="nav-item cta-colored nav-item-cart">
                    <a href="cart.php" class="nav-link">
                        <span class="icon-shopping_cart"></span>
                        [<span id="header-amount-cart"><?php echo $icon_cart ?></span>]
                    </a>
                </li>
                <?php
                if (isset($_SESSION['username'])) { ?>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username']; ?></span>

                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Đăng xuất
                            </a>
                            <a class="dropdown-item" href="history.php">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Lịch sử mua hàng
                            </a>
                        </div>
                    </li>
                <?php
                } else {
                    ?>
                    <li class="nav-item"><a href="login.php" class="nav-link">Đăng nhập</a></li>
                    <li class="nav-item"><a href="register.php" class="nav-link">Đăng kí</a></li>
                <?php
                }
                ?>

            </ul>
        </div>
    </div>
</nav>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xác nhận rời trang?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Đăng xuất tài khoản</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php" id="logout">Đăng xuất</a>
            </div>
        </div>
    </div>
</div>

