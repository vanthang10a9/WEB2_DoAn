<?php
include("includes/head.php");
$s_suppliers = "SELECT * FROM nhacungcap";
$run_suppliers = DataProvider::executeQuery($s_suppliers);
//
$s_categories = "SELECT * FROM loaisanpham";
$run_categories = DataProvider::executeQuery($s_categories);
while ($row = mysqli_fetch_assoc($run_categories)) {
    $arr_categories[] = $row;
}
//
$s_products = "SELECT * FROM sanpham";
$run_products = DataProvider::executeQuery($s_products);
while ($row = mysqli_fetch_assoc($run_products)) {
    $arr_products[] = $row;
}
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('includes/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('includes/topbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Thêm đơn nhập</h1>

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row justify-content-md-center">
                                <div class="col-lg-11">
                                    <div class="p-5">
                                        <form id="receipt">
                                            <div class="form-group">
                                                <select required class="form-control" name="supplier" id="supplier">
                                                    <option value="" disabled selected>Chọn nhà cung cấp</option>
                                                    <option value="">Thêm nhà cung cấp mới...</option>
                                                    <?php while ($row = mysqli_fetch_assoc($run_suppliers)) { ?>
                                                        <option value="<?php echo $row['MANCC']; ?>"><?php echo $row['TENNCC']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input class="form-control" type="text" name="manager" placeholder="<?php echo $USERNAME; ?>" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text" name="date" value="<?php echo date('d/m/Y'); ?>" readonly>
                                                </div>
                                            </div>
                                        </form>
                                        <hr>
                                        <form class="struc detail-receipt" style="display:none">
                                            <div class="form-group row add-product">
                                                <div class="col-sm-12 mb-0">
                                                    <h1 class="h5 text-gray-900 mb-2">Nhập sản phẩm</h1>
                                                </div>
                                                <div class="col-sm-12 mb-3 mb-0">
                                                    <select required class="form-control category">
                                                        <option value="" disabled selected>Chọn danh mục</option>
                                                        <option value="">Thêm danh mục mới...</option>
                                                        <?php foreach ($arr_categories as $row) { ?>
                                                            <option value="<?php echo $row['MACL']; ?>"><?php echo $row['TENCL']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-0">
                                                    <select name="productId" required class="form-control product" disabled>
                                                        <option value="" disabled selected>Chọn sản phẩm</option>
                                                        <option value="add-productz">Thêm sản phẩm mới...</option>
                                                        <?php foreach ($arr_products as $row) { ?>
                                                            <option value="<?php echo $row['MASP']; ?>" data-mancc="<?php echo $row['MANCC']; ?>" data-macl="<?php echo $row['MACL']; ?>"><?php echo $row['TENSP']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input disabled type="number" name="soluong" value="0" class="form-control soluong" min="1" placeholder="Số lượng nhập">
                                                </div>
                                                <div class="col-sm-3">
                                                    <input disabled type="number" name="gianhap" value="0" class="form-control gianhap" min="1" placeholder="Giá nhập">
                                                </div>
                                            </div>
                                        </form>
                                        <form class="detail-receipt save-receipt">
                                            <div class="form-group row add-product">
                                                <div class="col-sm-12 mb-0">
                                                    <h1 class="h5 text-gray-900 mb-2">Nhập sản phẩm</h1>
                                                </div>
                                                <div class="col-sm-12 mb-3 mb-0">
                                                    <select required class="form-control category">
                                                        <option value="" disabled selected>Chọn danh mục</option>
                                                        <option value="">Thêm danh mục mới...</option>
                                                        <?php foreach ($arr_categories as $row) { ?>
                                                            <option value="<?php echo $row['MACL']; ?>"><?php echo $row['TENCL']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-0">
                                                    <select name="productId" required class="form-control product" disabled>
                                                        <option value="" disabled selected>Chọn sản phẩm</option>
                                                        <option value="add-productz">Thêm sản phẩm mới...</option>
                                                        <?php foreach ($arr_products as $row) { ?>
                                                            <option value="<?php echo $row['MASP']; ?>" data-mancc="<?php echo $row['MANCC']; ?>" data-macl="<?php echo $row['MACL']; ?>"><?php echo $row['TENSP']; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                                <div class="col-sm-3">
                                                    <input disabled type="number" name="soluong" value="0" class="form-control soluong" min="1" placeholder="Số lượng nhập">
                                                </div>
                                                <div class="col-sm-3">
                                                    <input disabled type="number" name="gianhap" value="0" class="form-control gianhap" min="1" placeholder="Giá nhập">
                                                </div>
                                            </div>
                                        </form>
                                        <button type="button" class="btn btn-outline-primary mb-1 mr-1 b-add" data-toggle="tooltip" data-placement="top" title="Thêm sản phẩm">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <hr>
                                        <div class="col-sm-6 mb-3 mb-0">
                                            Tổng tiền: <label id="total">0</label> VNĐ
                                        </div>

                                        <hr>

                                        <a href="" id="submit" class="btn btn-primary btn-user btn-block">
                                            Thêm đơn nhập
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('includes/footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <?php
    include('includes/scroll-logout.php');
    include('includes/scripts.php')
    ?>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script type="text/javascript" charset="utf-8">
        var manccGlobal;
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        //add div container product
        $('.b-add').click(function(e) {
            $(this).before('<hr>', $('.struc').clone(true).removeClass('struc').removeAttr('style').addClass('save-receipt'));
        });

        var updateTotal = function() {

            var sumtotal;
            var sum = 0;
            var price = 0;
            var quantity = 0;
            var subtotal = 0;
            //Add each product price to total
            $(".add-product").each(function() {
                price = $('.gianhap', this).val();
                quantity = $('.soluong', this).val();

                //Total for one product
                subtotal = price * quantity;
                //alert(typeof(sum));
                sum += subtotal;
            });




            $('#total').html(sum.toString());
        };

        //Update total when quantity changes
        $(".soluong").change(function() {
            updateTotal();
        });

        $(".gianhap").keyup(function() {
            updateTotal();
        });


        $('select#supplier').on('change', function() {
            if ($(this)[0].selectedIndex == 1) {
                location.href = 'categories.php';
            }
        });
        $('select#supplier').on('change', function() {
            if ($(this)[0].selectedIndex == 1) {
                location.href = 'suppliers.php';
            }
            manccGlobal = $(this).val();
        });

        $('select.category').on('change', function() {
            if ($(this)[0].selectedIndex == 1) {
                location.href = 'categories.php';
            }
        });

        $('select.product').on('change', function() {
            if ($(this).val()== 'add-productz') {
                location.href = 'products.php';
            }
        });

        //var defaultSelect = $('.struc').find('select.product');
        $('.category').on('change', function() {
            var vals = $(this).val();
            var selector = $(this).closest('.add-product');
            var options = selector.find('select.product').find('option');
            var selectProduct = selector.find('select.product');
            selectProduct.prop("selectedIndex", 0).val();
            selectProduct.removeAttr('disabled');
            selector.find('input.soluong').removeAttr('disabled');
            selector.find('input.gianhap').removeAttr('disabled');
            options.hide();
            selectProduct.children("option[data-macl=" + vals + "][data-mancc=" + manccGlobal + "]").show();
            //alert(selectProduct.val());
            if (selectProduct.val() == null) {
                selector.find('input.soluong').prop('disabled', true);
                selector.find('input.gianhap').prop('disabled', true);
            }
        });
        $('.product').on('change', function() {
            //alert($(this).val());   
            var selector = $(this).closest('.add-product');
            if ($(this).val != null && $(this).val != "") {
                selector.find('input.soluong').removeAttr('disabled');
                selector.find('input.gianhap').removeAttr('disabled');
            }
        });

        $('#submit').click(function(e) {
            var x = $('#receipt').serializeArray();
            var madn;
            var total = $('#total').text();
            x.push({
                'name': "total",
                'value': total
            });
            x.push({
                'name': "receipt-action",
                'value': 'add'
            });
            $.ajax({
                type: "POST",
                url: "handle-manager.php",
                data: x,
                success: function(response) {
                    madn = response;
                    //location.reload(true);
                    $('.save-receipt').each(function() {
                        var detail = $(this).serializeArray();
                        detail.push({
                            'name': "receipt-action",
                            'value': 'add-detail'
                        });
                        detail.push({
                            'name': "id",
                            'value': madn
                        });
                        $.ajax({
                            type:"POST",
                            url: "handle-manager.php",
                            data: detail,
                            success : function(result) {
                                
                            }
                        })
                        console.log(JSON.stringify(detail));
                    });
                    location.href = 'wait-accept.php';
                },
                error: function(jqXHR, textStatus, errorThrown) {

                    alert("Chỉnh sửa thất bại");

                }
            });
            console.log(JSON.stringify(x));
            e.preventDefault();
        })
    </script>

</body>

</html>
<style>
    input::-webkit-calendar-picker-indicator {
        display: none;
    }

    .gianhap::-webkit-inner-spin-button,
    .gianhap::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>