<?php
    //require 'core/DataProvider.php';
    $sql = "SELECT * FROM loaisanpham";
    $result = DataProvider::executeQuery($sql);
    while($row = mysqli_fetch_array($result)) {
        $arrayCategories[] = $row; 
    }
?>
<section class="ftco-section ftco-category ftco-no-pt">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 order-md-last align-items-stretch d-flex">
                        <div class="category-wrap-2 ftco-animate img mb-4 align-self-stretch d-flex" style="background-image: url(images/products/background1.png);">
                            <div class="text text-center">
                                <h2>Pizza</h2>
                                <p>Vị ngon trên từng mẫu bánh</p>
                                <p><a href="shop.php" class="btn btn-primary">Mua ngay</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/products/TruyenThong.png);">
                            <div class="text px-3 py-1">
                                <h2 class="mb-0"><a href="shop.php?category=<?php echo $arrayCategories[0]['MACL']; ?>"><?php echo $arrayCategories[0]['TENCL']; unset($arrayCategories[0]);?></a></h2>
                            </div>
                        </div>
                        <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/products/ThapCam.png);">
                            <div class="text px-3 py-1">
                                <h2 class="mb-0"><a href="shop.php?category=<?php echo $arrayCategories[1]['MACL']; ?>"><?php echo $arrayCategories[1]['TENCL']; unset($arrayCategories[1]);?></a></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/products/HaiSanCaoCap.png);">
                    <div class="text px-3 py-1">
                        <h2 class="mb-0"><a href="shop.php?category=<?php echo $arrayCategories[2]['MACL']; ?>"><?php echo $arrayCategories[2]['TENCL']; unset($arrayCategories[2]);?></a></h2>
                    </div>
                </div>
                <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(images/products/NhanNhoi.png);">
                    <div class="text px-3 py-1">
                        <h2 class="mb-0"><a href="shop.php?category=<?php echo $arrayCategories[3]['MACL']; ?>"><?php echo $arrayCategories[3]['TENCL']; unset($arrayCategories[3]);?></a></h2>
                    </div>
                </div>
            </div>
            <?php
                    foreach($arrayCategories as &$arr) {                             
                ?>
                    <div class='col-md-4'>
                        <div class='category-wrap ftco-animate img mb-4 d-flex align-items-end' style="background-image: url(images/products/<?php echo $arr['HINHANHSP']; ?>.png);" >
                            <div class='text px-3 py-1'>
                                <h2 class='mb-0'><a href="shop.php?category=<?php echo $arr['MACL'] ?>"><?php echo $arr['TENCL']; ?></a></h2>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
        </div>
    </div>
</section>