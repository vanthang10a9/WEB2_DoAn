<?php
$sqlcat = "SELECT * FROM loaisanpham";
$run = DataProvider::executeQuery($sqlcat);
?>
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="product">
                    <div class="form-group">
                        <input type="text" class="form-control" id="productcode" placeholder="Mã sản phẩm">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="productname" placeholder="Tên sản phẩm">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control" id="price" placeholder="Giá sản phẩm">
                        </div>
                        <div class="col-sm-6">
                            <select required class="form-control" id="category">
                                <option value="" disabled selected>Chọn danh mục</option>
                                <?php
                                while($rowcat = mysqli_fetch_assoc($run)) { ?>                                ?>
                                <option value="<?php echo $rowcat['idCL']; ?>"><?php echo $rowcat['tenCL']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="custom-file" style="margin-bottom:1rem">
                        <input type="file" id="image" class="custom-file-input">
                        <label id="image-label" class="custom-file-label" for="validatedCustomFile">Chọn hình ảnh sản phẩm</label>
                    </div>
                    <div class="container js-file-list">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="description" rows="10"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="" id="action-button" class="btn btn-primary">
                    Thực hiện
                </a>
            </div>
        </div>
    </div>
</div>