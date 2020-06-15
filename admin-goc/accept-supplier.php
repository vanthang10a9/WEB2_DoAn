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
                                            <th>Duyệt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM nhacungcap WHERE DUYET = 0";
                                        $result = DataProvider::executeQuery($sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr id="<?php echo $row['MANCC']; ?>">
                                                <td><?php echo $row['MANCC']; ?></td>
                                                <td><?php echo $row['TENNCC']; ?></td>
                                                <td><?php echo $row['THONGTIN']; ?></td>
                                                <td></td>
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
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="category">
                        <div class="form-group">
                            <input type="text" class="form-control" id="categoryname" placeholder="Tên danh mục">
                        </div>
                        <div class="custom-file" style="margin-bottom:1rem">
                            <input type="file" id="image" class="custom-file-input">
                            <label id="image-label" class="custom-file-label" for="validatedCustomFile">Chọn hình ảnh sản phẩm</label>
                        </div>
                        <div class="container js-file-list">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-primary">
                        Thêm danh mục
                    </a>
                </div>
            </div>
        </div>
    </div>

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
                    <p>Xác nhận duyệt nhà cung cấp mới ?</p>
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
    include('includes/scroll-logout.php');
    include('includes/scripts.php');
    include('deleteModal.php');
    ?>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script type="text/javascript" charset="utf-8">
        $('#dataTable').dataTable({
            "columnDefs": [{
                "targets": -1,
                "data": null,
                "defaultContent": '<button class="btn btn-outline-info m-1 activation"><i class="fa fa-check"></i></button>' +
                    '<button class="btn btn-outline-danger m-1 delete"><i class="fa fa-times"></i></button>'
            }]
        });

        //Handle click on "Edit" button
        $('#dataTable tbody').on('click', '.activation', function(e) {
            var selector = $(this).closest('tr');
            var id = selector.attr('id');
            $("#activationModal").modal("show");
            $('#activationModal').on('click', '#submit-active', function(event) {
                $.ajax({
                    type: "POST",
                    url: "handler.php",
                    data: {

                        'action-supplier': 'activation',
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
            var selector = $(this).closest('tr');
            var id = selector.attr('id');
            //var tds = $(this).closest('tr').find('td');
            $('#deleteModal .modal-body p').html("Xác nhận xóa yêu cầu thêm nhà cung cấp?");
            $("#deleteModal").modal("show");
            $('#deleteModal').on('click', '#submit-delete', function(event) {
                $.ajax({
                    type: "POST",
                    url: "handler.php",
                    data: {

                        'action-supplier': 'delete',
                        'id': id
                    },
                    success: function(response) {
                        $('#dataTable').DataTable().row(selector).remove().draw(false);
                        $("#deleteModal").modal("hide");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                        alert("Duyệt thất bại");

                    }
                });
                event.preventDefault();
            });

        });
    </script>


</body>

</html>