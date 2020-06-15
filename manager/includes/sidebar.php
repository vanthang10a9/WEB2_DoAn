<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Quản lý kho</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý kho
    </div>

    <!-- Nav Item - Quản trị danh mục -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Danh mục</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý danh mục</h6>
                <a class="collapse-item" href="categories.php">Danh mục sản phẩm</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Quản trị sản phẩm -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Sản phẩm</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý sản phẩm</h6>
                <a class="collapse-item" href="deleted.php">Sản phẩm chưa được bán</a>
                <a class="collapse-item" href="products.php">Tất cả sản phẩm đang bán</a>
                <!-- <a class="collapse-item" href="utilities-color.php">Sản phẩm khuyến mãi</a> -->
                <!-- <a class="collapse-item" href="utilities-color.php">Sản phẩm mới</a> -->
            </div>
        </div>
    </li>

    <!-- Nav Item - Quản trị đơn hàng nhập -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Nhập hàng</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý nhập hàng</h6>
                <a class="collapse-item" href="add-receipt.php">Thêm đơn nhập</a>
                <a class="collapse-item" href="wait-accept.php">Đơn nhập chờ duyệt</a>
                <a class="collapse-item" href="goodsReceipt.php">Hóa đơn nhập hàng</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Quản trị nhà cung cấp -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Nhà cung cấp</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý nhà cung cấp</h6>
                <a class="collapse-item" href="wait-accept-supplier.php">Nhà cung cấp chờ duyệt</a>
                <a class="collapse-item" href="suppliers.php">Tất cả nhà cung cấp</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>