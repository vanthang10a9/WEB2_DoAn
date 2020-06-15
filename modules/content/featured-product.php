<?php
if (basename($_SERVER['PHP_SELF'], ".php") == "product-single") {
    $limit = 4;
} else {
    $limit = 8;
}
$sql = "SELECT * FROM sanpham ORDER BY RAND() LIMIT $limit";
$result = DataProvider::executeQuery($sql);
if ($result != null) {
    while ($row = mysqli_fetch_array($result)) { ?>
        <div class="col-md-6 col-lg-3 ftco-animate">
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
                                            $price = $row['GIASP'] - ($row['GIASP'] * $row['KMSP']) / 100;
                                            ?>
                                    <span class="mr-2 price-dc"><?php echo number_format($row['GIASP'],0,".","."); ?> Đ</span>
                                <?php
                                        } else {
                                            $price = $row['GIASP'];
                                        }
                                        ?>
                                <span class="price-sale"><?php echo number_format( $price,0,".","." ); ?> Đ</span>
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
                            <?php 
                                if(isset($_SESSION['username'])){
                            ?>
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
                                    //console.log(results);
                                    //window.location.reload();
                                }
                            });
                        <?php }else{?>
                            alert("Bạn phải đăng nhập mới được mua hàng.");
                        <?php } ?>
                        });
                    </script>
                </div>
            </div>
        </div>
<?php }
} ?>