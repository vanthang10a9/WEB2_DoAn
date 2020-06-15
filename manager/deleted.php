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
                    <div class="d-flex flex-row-reverse" id="reverse">
                        <button type="button" class="btn btn-secondary mb-1">
                            <i class="fa fa-sync-alt"></i>
                        </button>
                        <button type="button" id="add" class="btn btn-primary mb-1 mr-1" data-toggle="modal" data-target="#productModal">
                            <i class="fa fa-plus"></i>
                        </button>

                    </div>

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
                                            <th>Tình trạng</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT sp.*, lsp.MACL, lsp.TENCL FROM sanpham sp INNER JOIN loaisanpham lsp ON sp.MACL = lsp.MACL WHERE sp.DUYET=1 OR sp.DUYET=0";
                                        $result = DataProvider::executeQuery($sql);
                                        $arrMASP = [];

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            array_push($arrMASP, $row['MASP']);
                                            if ($row['DUYET'] == 0) {
                                                $tinhtrang = "Admin chưa duyệt";
                                            } else {
                                                $tinhtrang = "Chưa đăng bán";
                                            }
                                            ?>
                                            <tr duyet="<?php echo $row['DUYET']; ?>" id="<?php echo $row['MASP']; ?>" ncc="<?php echo $row['MANCC']; ?>">
                                                <td><?php echo $row['MASP']; ?></td>
                                                <td><?php echo $row['TENSP']; ?></td>
                                                <td><?php echo $row['GIASP']; ?></td>
                                                <td class="description"><?php echo $row['MOTASP']; ?></td>
                                                <td id="<?php echo $row['MACL']; ?>"><?php echo $row['TENCL']; ?></td>
                                                <td><img src="../images/products/<?php echo $row['HINHANHSP']; ?>" alt="" width="100px"></td>
                                                <td><?php echo $row['SOLUONGSP']; ?></td>
                                                <td><?php echo $tinhtrang; ?></td>
                                                <td style="display:flex"></td>
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
    <!--Activation Modal -->
    <div class="modal fade" id="activationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Xác nhận hiển thị bán sản phẩm này ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit-active">Duyệt</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('alertModal.php');
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
        var imageNameGlobal;
        var imageSrcGlobal;
        var productAction;
        var editId;
        var arrMASP = '<?php echo JSON_encode($arrMASP); ?>';
        //clear data when add
        $('#add').click(function(e) {
            $("#product")[0].reset();
            $('#image-label').text("Chọn hình ảnh sản phẩm");
            $('.js-file-list').html('');
            $("#productModal #action-button").html("Thêm sản phẩm");
            productAction = "add";
        });

        $('#dataTable').dataTable({
            "columnDefs": [{
                    "orderable": false,
                    "targets": [5, -1]
                },
                {
                    "targets": -1,
                    "data": null,
                    "defaultContent": '<button class="btn btn-outline-info m-1 activation"><i class="fa fa-check"></i></button>'
                },
                {
                    "width": "120px",
                    "targets": [3]
                }
            ]
        });

        $('#reserve').click(function(e) {
            $('#dataTable').DataTable().ajax().reload();
        });

        //active
        $('#dataTable tbody').on('click', '.activation', function(e) {
            var selector = $(this).closest('tr');
            var id = selector.attr('id');
            var duyet = selector.attr('duyet');

            if (duyet == "1") {
                $("#activationModal").modal("show");
                $('#activationModal').on('click', '#submit-active', function(e) {
                    $.ajax({
                        type: "POST",
                        url: "handle-manager.php",
                        data: {
                            'product-action': 'activation',
                            'id': id
                        },
                        success: function(response) {
                            $('#dataTable').DataTable().row(selector).remove().draw(false);
                            $("#activationModal").modal("hide");
                        },
                        error: function(jqXHR, textStatus, errorThrown) {

                            alert("Duyệt thất bại");

                        }
                    });
                });
            } else {
                $('#alertModal .modal-body p').html("Không thể đăng bán sản phẩm admin chưa duyệt");
                $('#alertModal').modal('show');
            }
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
                    imageSrcGlobal = event.target.result;
                    imageNameGlobal = file.name;
                    //var fileSize = file.size;
                    $('.js-file-image').attr('src', imageSrcGlobal);
                    //$('.js-file-image').attr('name', imageNameGlobal);
                    $('#image-label').text(imageNameGlobal);
                };
                fileReader.readAsDataURL(file);
            });
        });


        $("#productModal #action-button").click(function(e) {
            var imageName = typeof imageNameGlobal === "undefined" ? "" : imageNameGlobal;
            var src = typeof imageSrcGlobal === "undefined" ? "" : imageSrcGlobal;
            var x = $('form#product').serializeArray();
            x.push({
                'name': "product-action",
                'value': productAction
            });
            // if (productAction == "edit") {
            //     x.push({
            //         'name': "id",
            //         'value': editId
            //     });
            // }
            x.push({
                'name': "image-name",
                'value': imageName
            });
            x.push({
                'name': "image-src",
                'value': src
            });
            console.log(JSON.stringify(x));
            $.ajax({
                type: "POST",
                url: "handle-manager.php",
                data: x,
                success: function(response) {
                    imageNameGlobal = "";
                    imageSrcGlobal = "";
                    location.reload(true);
                },
                error: function(jqXHR, textStatus, errorThrown) {

                    alert("Chỉnh sửa thất bại");

                }
            });
            e.preventDefault();
        });

        /******************************************************/
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
<style>
    td.description,
    td.description>p {
        box-sizing: border-box;
        max-width: 100px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    td.description :hover,
    td.description>p:hover {
        z-index: 1;
        background-color: #FFFFCC;
        max-width: 500px;
        overflow: visible;
        white-space: normal;
        position: absolute;
    }
</style>