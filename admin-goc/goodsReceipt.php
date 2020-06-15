<?php
include("includes/head.php");
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Danh sách nhập hàng</h1>
                        <a href="" id="export" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Xuất báo cáo nhập</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length">
                                            <label style="display:inline-block">
                                                Tìm theo giá
                                                <input type="number" step="100000" class="form-control form-control-sm" id="minp">
                                                đến
                                                <input type="number" step="100000" class="form-control form-control-sm" id="maxp">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tên nhà cung cấp</th>
                                            <th>Người nhập</th>
                                            <th>Ngày nhập</th>
                                            <th>Tổng tiền</th>
                                            <th class="noExp">Chi tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM donnhap d INNER JOIN nhacungcap ncc ON d.MANCC = ncc.MANCC INNER JOIN taikhoan tk ON d.MANV = tk.IDUSER WHERE d.DUYET = 1";
                                        $result = DataProvider::executeQuery($sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr id="<?php echo $row['MADN']; ?>">
                                                <td><?php echo $row['TENNCC']; ?></td>
                                                <td><?php echo $row['NAME']; ?></td>
                                                <td><?php echo $row['NGAYNHAP']; ?></td>
                                                <td><?php echo $row['TONGTIEN']; ?></td>
                                                <td class="noExp"></td>
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

    <!-- activation modal-->
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
                    <p>Xác nhận duyệt đơn nhập ?</p>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-primary" id="submit-active">
                        Chấp nhận
                    </a>
                    <a href="" class="btn btn-secondary" data-dismiss="modal">
                        Thoát
                    </a>
                </div>
            </div>
        </div>
    </div>



    <?php
    include('receiptmodal.php');
    include('includes/scroll-logout.php');
    include('includes/scripts.php');
    include('deleteModal.php');
    ?>
    <!-- Page level plugins -->
    <script src="vendor/jquery/jquery.table2excel.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script type="text/javascript">
        $('#dataTable').dataTable({
            "columnDefs": [{
                    "orderable": false,
                    "targets": [4]
                },
                {
                    "targets": 4,
                    "data": null,
                    "defaultContent": '<button class="btn btn-outline-primary m-1 ct">Chi tiết</button>'
                }
            ]
        });
        $('#dataTable tbody').on('click', '.ct', function(e) {
            var id = $(this).closest('tr').attr('id');
            var x = {
                'action-dn': 'select-detail',
                'id': id
            };


            console.log(JSON.stringify(x));
            $.ajax({
                type: "POST",
                url: "handler.php",
                data: x,
                success: function(results) {
                    $('#detailz tbody').html(results);
                }
            });
            $("#receiptmodal").modal("show");
            e.preventDefault();

        });
        //Handle click on "Edit" button
        $('#dataTable tbody').on('click', '.activation', function(e) {
            var selector = $(this).closest('tr');
            var id = selector.attr('id');
            //var tds = $(this).closest('tr').find('td');
            $("#activationModal").modal("show");
            $('#activationModal').on('click', '#submit-active', function(event) {
                $.ajax({
                    type: "POST",
                    url: "handler.php",
                    data: {

                        'action-receipt': 'activation',
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
                event.preventDefault();
            });

        });

        //Handle click on "delete" button
        $('#dataTable tbody').on('click', '.delete', function(e) {
            var userid = $(this).closest('tr').attr('id');
            var tds = $(this).closest('tr').find('td');
            $("#deleteModal").modal("show");
        });
        //export report
        $("a#export").click(function() {
            $("#dataTable").table2excel({
                // exclude CSS class
                name: "Worksheet Name",
                exclude: ".noExp",
                filename: "DS_hoadon_nhap", //do not include extensi
                fileext: ".xls", // file extension
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
            });
        });
        /* Custom filtering function which will search data in column four between two values */
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = parseInt($('#minp').val(), 10);
                var max = parseInt($('#maxp').val(), 10);
                var price = parseFloat(data[3]) || 0; // use data for the age column

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
<style>
    .ct {
        padding: 0.3rem 0.3rem;
    }
</style>

</html>