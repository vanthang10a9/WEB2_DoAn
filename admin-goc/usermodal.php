<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm tài khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addUserModal">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="aname" value="" placeholder="Họ và tên">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="ausername" placeholder="Tài khoản">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="address" id="aaddress" placeholder="Địa chỉ">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="identity" id="aidentity" placeholder="Chứng minh nhân dân">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phonenumber" id="aphonenumber" placeholder="Số điện thoại">
                    </div>
                    <div class="form-group">
                        <select required class="form-control" name="role" id="arole">
                            <option value="" disabled selected>Chọn vai trò</option>
                            <option value="0">Người dùng</option>
                            <option value="1">Nhân viên</option>
                            <option value="2">Quản lý</option>
                            <option value="3">Quản trị viên</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="repassword" id="repassword" placeholder="Nhập lại mật khẩu">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="" id="addAccount" class="btn btn-primary">
                    Thêm tài khoản
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa tài khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserModal">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="name" value="" placeholder="Họ và tên">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="username" id="username" placeholder="Tài khoản" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="address" id="address" placeholder="Địa chỉ">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="identity" id="identity" placeholder="Chứng minh nhân dân">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phonenumber" id="phonenumber" placeholder="Số điện thoại">
                    </div>
                    <div class="form-group">
                        <select required class="form-control" name="role" id="role">
                            <option value="" disabled selected>Chọn vai trò</option>
                            <option value="0">Người dùng</option>
                            <option value="1">Nhân viên</option>
                            <option value="2">Quản lý</option>
                            <option value="3">Quản trị viên</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="" id="editAccount" class="btn btn-primary">
                    Sửa tài khoản
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" charset="utf-8">
    $('#addAccount').click(function(event) {
        var x = $('form#addUserModal').serialize();
        console.log(x);
        $.ajax({
            type: "POST",
            url: "add-account.php",
            data: x,
            success: function(response) {

                location.reload(true);
            },
            error: function(jqXHR, textStatus, errorThrown) {

                alert("Đăng kí thất bại");

            }
        });
        event.preventDefault();
    });

    $('#editAccount').click(function(event) {
        event.preventDefault();
        var x = $('form#editUserModal').serialize();
        console.log(JSON.stringify(x));
        $.ajax({
            type: "POST",
            url: "edit-account.php",
            data: x,
            success: function(response) {

                location.reload(true);
            },
            error: function(jqXHR, textStatus, errorThrown) {

                alert("Chỉnh sửa thất bại");

            }
        });

    });
</script>