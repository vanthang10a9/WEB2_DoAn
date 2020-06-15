
<div class="row">
<?php
include 'core/DataProvider.php';
//khai báo các biến để tìm kiếm
// echo $_REQUEST['category'];
$category = isset($_REQUEST['category']) ? $_REQUEST['category'] : null;
$products = isset($_REQUEST['products']) ? $_REQUEST['products'] : null;
$minPrice = !empty($_REQUEST['minPrice']) ? $_REQUEST['minPrice'] : 0;
$maxPrice = !empty($_REQUEST['maxPrice']) ? $_REQUEST['maxPrice'] : 1000000;
$condition = "";
if (!is_null($category))
    $condition .= " AND MACL = $category";


//thuật toán phân trang -  Nguồn: https://freetuts.net/thuat-toan-phan-trang-voi-php-va-mysql-550.html
//tìm số records
$result = DataProvider::executeQuery("SELECT count(MACL) AS total FROM sanpham WHERE TENSP LIKE  '%".$products."%' AND  ". $minPrice ." <= GIASP AND ". $maxPrice ." >= GIASP " . $condition);

$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];

//tìm limit, current_page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 8;

//tính total_page, start
$total_page = ceil($total_records / $limit);
//giới hạn current_page
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}
//start
$start = ($current_page - 1) * $limit;

//lấy dánh sách sản phẩm
$sql = "SELECT * FROM sanpham WHERE TENSP LIKE  '%".$products."%' AND  ". $minPrice ." <= GIASP AND ". $maxPrice ." >= GIASP "   . $condition . " LIMIT $start, $limit";

$result = DataProvider::executeQuery($sql);
if(!$result){
    echo "<h4 style='margin-left: 120px'>KHÔNG TÌM THẤY SẢN PHẨM !!!</h4>";
}
if ($result != null) {
    while ($row = mysqli_fetch_array($result)) { ?>
        <div class="col-md-6 col-lg-3 ">
            <div class="product">
                <a href="product-single.php?id=<?php echo $row['MASP']; ?>" class="img-prod"><img class="img-fluid" src="images/products/<?php echo $row['HINHANHSP']; ?>" alt="Colorlib Template">
                    <?php if (!empty($row['KMSP'])) { ?><span class="status"><?php echo $row['KMSP']; ?> %</span> <?php } ?>
                    <div class="overlay"></div>
                </a>
                <div class="text py-3 pb-4 px-3 text-center">
                    <h3><a href="product-single.php?id=<?php echo $row['MASP']; ?>"><?php echo $row['TENSP']; ?></a></h3>
                    <div class="d-flex">
                        <div class="pricing">
                            <p class="price">
                                <?php
                                if (!empty($row['KMSP'])) {
                                    $price = $row['GIASP'] - ($row['GIASP'] * $row['KMSP']) / 100; ?>
                                    <span class="mr-2 price-dc"><?php echo number_format($row['GIASP'], 0, ".", "."); ?> Đ</span>
                                <?php
                                } else {
                                    $price = $row['GIASP'];
                                }
                                ?>
                                <span class="price-sale"><?php echo number_format($price, 0, ".", "."); ?> Đ</span>
                            </p>
                        </div>
                    </div>
                    <div class="bottom-area d-flex px-3 product-id-<?php echo $row['MASP']; ?>" id="<?php echo $row['MASP']; ?>">
                        <div class="m-auto d-flex">
                            <a href="product-single.php?id=<?php echo $row['MASP']; ?>" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                <span><i class="ion-ios-menu"></i></span>
                            </a>
                            <a href="javascript:void(0)" class="buy-now d-flex justify-content-center align-items-center mx-1" id="addcart-<?php echo $row['MASP']; ?>">
                                <span><i class="ion-ios-cart"></i></span>
                            </a>
                            <!-- <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                <span><i class="ion-ios-heart"></i></span>
                            </a> -->
                        </div>
                    </div>
                    <script type="text/javascript">
                        var mount;
                        $("a#addcart-<?php echo $row['MASP']; ?>").click(function(e) {
                            <?php if(isset($_SESSION['username'])){ ?>
                                e.preventDefault();
                                var item = {
                                    'id': $(".product-id-<?php echo $row['MASP'] ?>").attr('id'),
                                    'quantity': 1
                                };
                                $.ajax({
                                    type: "POST",
                                    url: "addcart.php",
                                    data: item,
                                    cache: false,
                                    success: function(results) {
                                        //console.log(data);
                                        mount = $('#header-amount-cart').html();
                                        $('#header-amount-cart').html(Number(mount) + 1);
                                        console.log(results);
                                        //window.location.reload();
                                    }
                                });
                            <?php
                            }else{ ?>
                                alert("Bạn phải đăng nhập mới được mua hàng.") ;
                            <?php } ?>
                        });
                    </script>
                </div>
            </div>
        </div>
<?php }
} ?>
</div>
<div class="row mt-5">
<div class="col text-center">
    <div class="block-27">
        <ul>
            <?php
            //hiển thị nút prev
            if ($current_page > 1 && $total_page > 1) { ?>
                <li><a href="shop.php?page=<?php echo ($current_page - 1); ?>">&lt;</a></li>
                <?php
            }
            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $current_page) { ?>
                    <li class="active"><span><?php echo $i; ?></span></li>
                <?php } else { ?>
                    <li><a id="<?= $i ?>" href="javascript:void(0)" data-index="<?= $i ?>"><?php echo $i; ?></a></li>
                <?php }
            }

            if ($current_page < $total_page && $total_page > 1) { ?>
                <li><a href="shop.php?page=<?php echo ($current_page + 1); ?>">&gt;</a></li>
            <?php }
            ?>
        </ul>
    </div>
</div>
</div>


