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
                    <h1 class="h3 mb-2 text-gray-800">Danh sách tài khoản</h1>

                    <!-- Table button -->
                    <div class="d-flex flex-row-reverse">
                        <button type="button" class="btn btn-secondary mb-1">
                            <i class="fa fa-sync-alt"></i>
                        </button>
                        <button type="button" class="btn btn-primary mb-1 mr-1" data-toggle="modal" data-target="#addUserModal">
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
                                            <th>Tên tài khoản</th>
                                            <th>Họ tên</th>
                                            <th>Chứng minh nhân dân</th>
                                            <th>Địa chỉ</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Duyệt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM taikhoan WHERE LEVEL = 0 AND DUYET = 0";
                                        $result = DataProvider::executeQuery($sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr id="<?php echo $row['IDUSER']; ?>">
                                                <td><?php echo $row['USERNAME']; ?></td>
                                                <td><?php echo $row['NAME']; ?></td>
                                                <td><?php echo $row['CMND']; ?></td>
                                                <td><?php echo $row['ADDRESS']; ?></td>
                                                <td><?php echo $row['EMAIL']; ?></td>
                                                <td><?php echo $row['PHONE']; ?></td>
                                                <td style='display:flex'></td>
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
                    <p>Xác nhận duyệt tài khoản ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit-active">Duyệt</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('includes/scroll-logout.php');
    include('deleteModal.php');
    include('usermodal.php');
    include('includes/scripts.php')
    ?>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script type="text/javascript" charset="utf-8">
        //clear data when add acccount
        $('#addUserModal').on('shown.bs.modal', function(e) {
            $(':input', '#addUserModal')
                .not(':button, :submit, :reset, :hidden')
                .val('')
                .prop('checked', false)
                .prop('selected', false);
        })

        $('#dataTable').dataTable({
            "columnDefs": [{
                    "orderable": false,
                    "targets": [2, 5, -1],
                },
                {
                    "targets": -1,
                    "data": null,
                    "defaultContent": '<button class="btn btn-outline-info m-1 activation"><i class="fa fa-check"></i></button>' +
                        '<button class="btn btn-outline-danger m-1 delete"><i class="fa fa-times"></i></button>'
                }
            ]
        });

        //Handle click on "Edit" button
        $('#dataTable tbody').on('click', '.activation', function(e) {
            var selector = $(this).closest('tr');
            var userid = selector.attr('id');
            var tds = $(this).closest('tr').find('td');
            $("#activationModal").modal("show");
            $('#activationModal').on('click', '#submit-active', function(e) {
                $.ajax({
                    type: "POST",
                    url: "handle-accept.php",
                    data: {

                        'action': 'activation',
                        'userid': userid
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
        });

        //Handle click on "Delete" button
        $('#dataTable tbody').on('click', '.delete', function(e) {
            var userid = $(this).closest('tr').attr('id');
            var tds = $(this).closest('tr').find('td');
            $('#deleteModal .modal-body p').html("Xác nhận xóa yêu cầu đăng kí");
            $("#deleteModal").modal("show");
            $('#deleteModal').on('click', '#submit-delete', function(e) {
                $.ajax({
                    type: "POST",
                    url: "handle-accept.php",
                    data: {

                        'action': 'delete',
                        'userid': userid
                    },
                    success: function(response) {

                        alert("Xóa yêu cầu thành công");
                        $("deleteModal").modal("hide");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                        alert("Duyệt thất bại");

                    }
                });
            });
        });
    </script>

</body>

</html>