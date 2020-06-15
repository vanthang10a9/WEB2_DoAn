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
                    <h1 class="h3 mb-2 text-gray-800">Danh sách nhà cung cấp</h1>
                    <!-- Table button -->
                    <div class="d-flex flex-row-reverse">
                        <button type="button" class="btn btn-secondary mb-1">
                            <i class="fa fa-sync-alt"></i>
                        </button>
                        <button type="button" id="add" class="btn btn-primary mb-1 mr-1">
                            <i class="fa fa-plus"></i>
                        </button>

                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã NCC</th>
                                            <th>Tên nhà cung cấp</th>
                                            <th>Thông tin</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM nhacungcap WHERE DUYET = 1";
                                        $result = DataProvider::executeQuery($sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr mancc="<?php echo $row['MANCC']; ?>">
                                                <td><?php echo $row['MANCC']; ?></td>
                                                <td><?php echo $row['TENNCC']; ?></td>
                                                <td><?php echo $row['THONGTIN']; ?></td>
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
    <!-- Add Categories Modal-->
    <div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nhà cung cấp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="supplier">
                        <div class="form-group">
                            <input type="text" class="form-control" name="supplierName" id="supplierName" placeholder="Tên nhà cung cấp">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="supplierDetail" id="supplierDetail" placeholder="Thông tin">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-primary" id="submit-action">
                        Xác nhận
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('includes/scroll-logout.php');
    include('deleteModal.php');
    include('alertModal.php');
    include('includes/scripts.php')
    ?>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script type="text/javascript" charset="utf-8">
        var supplierAction;
        var editMANCC;
        $('#add').click(function(e) {
            $("#supplier")[0].reset();
            supplierAction = "add";
            $('#supplierModal').modal('show');
        });

        $('#dataTable tbody').on('click', '.edit', function(e) {
            editMANCC = $(this).closest('tr').attr('mancc');
            var tds = $(this).closest('tr').find('td');

            $(".modal-body #supplier #supplierName").val(tds.eq(1).text());
            $(".modal-body #supplier #supplierDetail").val(tds.eq(2).text());
            supplierAction = "edit";
            $('#supplierModal').modal('show');
        });
        $('#dataTable tbody').on('click', '.delete', function(e) {
            var selector = $(this).closest('tr');
            var id = selector.attr('mancc');
            //var tds = $(this).closest('tr').find('td');
            $('#deleteModal .modal-body p').html("Xác nhận xóa sản phẩm ?");
            $("#deleteModal").modal("show");
            $('#deleteModal').on('click', '#submit-delete', function(event) {
                $.ajax({
                    type: "POST",
                    url: "handle-manager.php",
                    data: {

                        'supplier-action': 'delete',
                        'id': id
                    },
                    success: function(response) {
                        $('#dataTable').DataTable().row(selector).remove().draw(false);
                        $("#deleteModal").modal("hide");
                        if (response != 1) {
                            $('#alertModal .modal-body p').html(response);                       
                            $('#alertModal').modal('show');
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                        alert("Duyệt thất bại");

                    }
                });
                event.preventDefault();
            });

        });
        $('#dataTable').dataTable({
            "columnDefs": [{
                    "orderable": false,
                    "targets": [-1]
                },
                {
                    "targets": -1,
                    "data": null,
                    "defaultContent": '<button class="btn btn-outline-info m-1 edit"><i class="fa fa-edit"></i></button>' +
                        '<button class="btn btn-outline-danger m-1 delete"><i class="fa fa-trash"></i></button>'
                }
            ]
        });
        $('#submit-action').on('click', function(e) {
            var x = $('form#supplier').serializeArray();
            x.push({
                'name': "supplier-action",
                'value': supplierAction
            });
            if(supplierAction == "edit") {
                x.push({
                'name': "id",
                'value': editMANCC
            });
            }
            console.log(JSON.stringify(x));
            $.ajax({
                type: "POST",
                url: "handle-manager.php",
                data: x,
                success: function(response) {
                    if (response == '1') {
                        $('#alertModal .modal-body p').html("Thao tác thành công!");
                        $('#alertModal').modal('show');
                    } else {
                        $('#alertModal .modal-body p').html("Đã xảy ra lỗi");
                        $('#alertModal').modal('show');
                    }
                    //location.reload(true);
                },
                error: function(jqXHR, textStatus, errorThrown) {

                    alert("Thêm thất bại");

                }
            });
            e.preventDefault();
        });

        $('#alertModal').on('hide.bs.modal', function() {
            location.reload();
        });
    </script>

</body>

</html>