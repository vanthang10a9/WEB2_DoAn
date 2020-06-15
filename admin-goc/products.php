<?php
include("includes/head.php");
$sql = "SELECT * FROM loaisanpham ORDER BY MACL";
$result = DataProvider::executeQuery($sql);
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
                    <h1 class="h3 mb-2 text-gray-800">Danh sách danh mục</h1>

                    <!-- Table button -->
                    <!-- <div class="d-flex flex-row-reverse">
                        <button type="button" class="btn btn-secondary mb-1">
                            <i class="fa fa-sync-alt"></i>
                        </button>
                        <button type="button" id="add" class="btn btn-primary mb-1 mr-1" data-toggle="modal" data-target="#productModal">
                            <i class="fa fa-plus"></i>
                        </button>

                    </div> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length">
                                            <label>
                                                <select id="categories" class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="" selected>Tìm theo danh mục</option>
                                                    <?php
                                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                                        <option value="<?php echo $row['TENCL']; ?>"><?php echo $row['TENCL']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length">
                                            <label style="display:inline-block">
                                                Tìm theo giá
                                                <input type="number" step="25000" class="form-control form-control-sm" id="minp">
                                                đến
                                                <input type="number" step="50000" class="form-control form-control-sm" id="maxp">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Mô tả</th>
                                            <th>Loại sản phẩm</th>
                                            <th>Hình ảnh</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT sp.*, lsp.MACL, lsp.TENCL FROM sanpham sp INNER JOIN loaisanpham lsp ON sp.MACL = lsp.MACL WHERE sp.DUYET= 2";
                                        $result = DataProvider::executeQuery($sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $row['MASP']; ?></td>
                                                <td><?php echo $row['TENSP']; ?></td>
                                                <td><?php echo $row['GIASP']; ?></td>
                                                <td><?php echo $row['MOTASP']; ?></td>
                                                <td id="<?php echo $row['MACL']; ?>"><?php echo $row['TENCL']; ?></td>
                                                <td><img src="../images/products/<?php echo $row['HINHANHSP']; ?>" alt="" width="100px"></td>
                                                <td><?php echo $row['SOLUONGSP']; ?></td>
                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
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
    <!-- End of Page Wrapper -->

    <?php
    include('productmodal.php');
    include('includes/scroll-logout.php');
    include('includes/scripts.php')
    ?>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script type="text/javascript" charset="utf-8">
        //clear data when add acccount
        $('#add').click(function(e) {
            $("#product")[0].reset();
            $('#image-label').text("Chọn hình ảnh sản phẩm");
            $('.js-file-list').html('');
            $("#productModal #action-button").html("Thêm sản phẩm");
        });

        $('#dataTable').dataTable({
            "columnDefs": [{
                    "orderable": false,
                    "targets": [5]
                }
            ]
        });

        //handle edit button
        $('#dataTable tbody').on('click', '.btn-info', function(e) {
            //var productid = $(this).closest('tr').attr('id');
            var tds = $(this).closest('tr').find('td');
            var elements = [];
            for (i = 0; i < tds.length; i++) {
                if (i == 4) {
                    elements[i] = tds.eq(i).attr('id');
                } else if (i == 5) {
                    elements[i] = tds.eq(i).find('img').attr('src');
                } else {
                    elements[i] = tds.eq(i).text();
                }
            }

            $(".modal-body #product #productcode").val(elements[0]);
            $(".modal-body #product #productname").val(elements[1]);
            $(".modal-body #product #price").val(elements[2]);
            $(".modal-body #product #description").val(elements[3]);
            $(".modal-body #product #category").val(elements[4]);
            //set image
            var str = '<div class="mb-3">' +
                '<img class="img-thumbnail js-file-image" style="width: 100px">' +
                '</div>';
            $('.js-file-list').html(str);
            var imageSrc = elements[5];
            var filename = imageSrc.split('/').pop()
            $('.js-file-image').attr('src', imageSrc);
            $('#image-label').text(filename);
            $("#productModal #action-button").html("Sửa sản phẩm");
            $("#productModal").modal("show");

        });

        $(document).ready(function() {
            $('#image').on('change', function() {
                var file = $(this)[0].files[0];

                var fileReader = new FileReader();
                fileReader.onload = function() {
                    var str = '<div class="mb-3">' +
                        '<img class="img-thumbnail js-file-image" style="width: 100px">' +
                        '</div>';
                    $('.js-file-list').html(str);
                    var imageSrc = event.target.result;
                    var fileName = file.name;
                    var fileSize = file.size;
                    $('.js-file-name').text(fileName);
                    $('.js-file-size').text(fileSize);
                    $('.js-file-image').attr('src', imageSrc);
                    $('#image-label').text(fileName);
                };
                fileReader.readAsDataURL(file);
            });
        });

        $(document).ready(function() {
            var table = $('#dataTable').DataTable();

            $('#categories').on('change', function() {
                table.columns(4).search(this.value).draw();
            });
        });
        /* Custom filtering function which will search data in column four between two values */
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = parseInt($('#minp').val(), 10);
                var max = parseInt($('#maxp').val(), 10);
                var price = parseFloat(data[2]) || 0; // use data for the age column

                if ((isNaN(min) && isNaN(max)) ||
                    (isNaN(min) && price <= max) ||
                    (min <= price && isNaN(max)) ||
                    (min <= price && price <= max)) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {
            var table = $('#dataTable').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#minp, #maxp').change(function() {
                table.draw();
            });
            $('#minp, #maxp').keyup(function() {
                table.draw();
            });
        });
    </script>

</body>

</html>