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
                    <h1 class="h3 mb-2 text-gray-800">Danh sách danh mục</h1>

                    <!-- Table button -->
                    <div class="d-flex flex-row-reverse">
                        <button type="button" class="btn btn-secondary mb-1">
                            <i class="fa fa-sync-alt"></i>
                        </button>
                        <button type="button" id="add" class="btn btn-primary mb-1 mr-1" data-toggle="modal" data-target="#categoryModal">
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
                                            <th>STT</th>
                                            <th>Tên danh mục</th>
                                            <th>Hình ảnh</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM loaisanpham";
                                        $result = DataProvider::executeQuery($sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr id="<?php echo $row['MACL']; ?>">
                                                <td><?php echo $row['MACL']; ?></td>
                                                <td><?php echo $row['TENCL']; ?></td>
                                                <td><img src="../images/products/<?php echo $row['HINHANHSP']; ?>" alt="" width="100px"></td>
                                                <td style="display:flex; align-items: center; justify-content: center;"></td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Danh mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="category">
                        <div class="form-group">
                            <input type="text" class="form-control" name="categoryname" id="categoryname" placeholder="Tên danh mục">
                        </div>
                        <div class="custom-file" style="margin-bottom:1rem">
                            <input type="file" name="image" id="image" class="custom-file-input">
                            <label id="image-label" class="custom-file-label" for="validatedCustomFile">Chọn hình ảnh sản phẩm</label>
                        </div>
                        <div class="container js-file-list">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-primary" id="addCategory">
                        Xác nhận
                    </a>
                </div>
            </div>
        </div>
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
        var imageNameGlobal;
        var imageSrcGlobal;
        var categoryAction;
        var editId;
        //clear data when add acccount
        $('#add').click(function(e) {

            $("#category")[0].reset();
            $('#image-label').text("Chọn hình ảnh sản phẩm");
            $('.js-file-list').html('');
            categoryAction = "add";

        });

        $('#dataTable').dataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": 2,
                "targets": -1,
                "data": null,
                "defaultContent": '<button class="btn btn-outline-info m-1 edit"><i class="fa fa-edit"></i></button>',
                    // '<button class="btn btn-outline-danger m-1 delete"><i class="fa fa-trash"></i></button>'
            }]
        });

        //handle edit button
        $('#dataTable tbody').on('click', '.edit', function(e) {

            editId = $(this).closest('tr').attr('id');
            var tds = $(this).closest('tr').find('td');

            $(".modal-body #category #categoryname").val(tds.eq(1).text());
            var imageSrc = tds.eq(2).find('img').attr('src');
            //set image
            var str = '<div class="mb-3">' +
                '<img class="img-thumbnail js-file-image" style="width: 100px">' +
                '</div>';
            $('.js-file-list').html(str);
            var filename = imageSrc.split('/').pop()
            $('.js-file-image').attr('src', imageSrc);
            $('#image-label').text(filename);
            //$('.js-file-image').attr('name', filename);
            categoryAction = "edit";
            $("#categoryModal").modal("show");
            //edit category

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
                    var fileSize = file.size;
                    $('.js-file-image').attr('src', imageSrcGlobal);
                    //$('.js-file-image').attr('name', imageNameGlobal);
                    $('#image-label').text(imageNameGlobal);
                };
                fileReader.readAsDataURL(file);
            });
        });
        $("#categoryModal #addCategory").click(function(e) {
            var imageName = typeof imageNameGlobal === "undefined" ? "" : imageNameGlobal;
            var src = typeof imageSrcGlobal === "undefined" ? "" : imageSrcGlobal;
            var x = $('form#category').serializeArray();
            x.push({
                'name': "category-action",
                'value': categoryAction
            });
            if (categoryAction == "edit") {
                x.push({
                    'name': "id",
                    'value': editId
                });
            }
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
                url: "handle-accept.php",
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
    </script>

</body>

</html>