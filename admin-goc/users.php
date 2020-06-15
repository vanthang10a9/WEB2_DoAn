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
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length">
                                            <label>
                                                <select id="role-filter" class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="" selected>Tìm theo vai trò</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Quản lý">Quản lý</option>
                                                    <option value="Nhân viên">Nhân viên</option>
                                                    <option value="Khách hàng">Khách hàng</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tên tài khoản</th>
                                            <th>Họ tên</th>
                                            <th>Chứng minh nhân dân</th>
                                            <th>Địa chỉ</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Vai trò</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM taikhoan WHERE DUYET = 1";
                                        $result = DataProvider::executeQuery($sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $level = $row['LEVEL'];
                                            switch ($level) {
                                                case 3:
                                                    $role = "Admin";
                                                    break;
                                                case 2:
                                                    $role = "Quản lý";
                                                    break;
                                                case 1:
                                                    $role = "Nhân viên";
                                                    break;
                                                default:
                                                    $role = "Khách hàng";
                                            }
                                            ?>
                                                <tr id="<?php echo $row['IDUSER']; ?>">
                                                    <td><?php echo $row['USERNAME']; ?></td>
                                                    <td><?php echo $row['NAME']; ?></td>
                                                    <td><?php echo $row['CMND']; ?></td>
                                                    <td><?php echo $row['ADDRESS']; ?></td>
                                                    <td><?php echo $row['EMAIL']; ?></td>
                                                    <td><?php echo $row['PHONE']; ?></td>
                                                    <td id="<?php echo $level; ?>"><?php echo $role; ?></td>
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

    <?php
    include('includes/scroll-logout.php');
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

        var table = $('#dataTable').dataTable({
            "columnDefs": [{
                    "orderable": false,
                    "targets": [2, 5, -1],
                },
                {
                    "targets": -1,
                    "data": null,
                    "defaultContent": '<button class="btn btn-outline-info m-1 edit"><i class="fa fa-edit"></i></button>' +
                        '<button class="btn btn-outline-danger m-1 delete"><i class="fa fa-trash"></i></button>'
                }
            ]
        });

        //Handle click on "Edit" button
        $('#dataTable tbody').on('click', '.edit', function(e) {
            var tds = $(this).closest('tr').find('td');
            var elements = [];
            for (i = 0; i < tds.length; i++) {
                if (i == tds.length - 2) {
                    elements[i] = tds.eq(i).attr('id');
                } else {
                    elements[i] = tds.eq(i).text();
                }
            }

            $(".modal-body #editUserModal #username").val(elements[0]);
            $(".modal-body #editUserModal #name").val(elements[1]);
            $(".modal-body #editUserModal #identity").val(elements[2]);
            $(".modal-body #editUserModal #address").val(elements[3]);
            $(".modal-body #editUserModal #email").val(elements[4]);
            $(".modal-body #editUserModal #phonenumber").val(elements[5]);
            $(".modal-body #editUserModal #role").val(elements[tds.length - 2]);
            $("#editUserModal").modal("show");

        });
        //handle click delete
        $('#dataTable tbody').on('click', '.delete', function(e) {
            var selector = $(this).closest('tr');
            var userid = selector.attr('id');
            var r = confirm("Xóa user");
            if (r == true) {
                $.ajax({
                    type: "POST",
                    url: "edit-account.php",
                    data: {

                        'action-delete': 'true',
                        'userid': userid
                    },
                    success: function(response) {
                        $('#dataTable').DataTable().row(selector).remove().draw(false);
                        //location.reload(true);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                        alert("Xóa thất bại");

                    }
                });
            }
        });
        $(document).ready(function() {
            var table = $('#dataTable').DataTable();

            $('#role-filter').on('change', function() {
                table.columns(6).search(this.value).draw();
            });
        });
    </script>

</body>

</html>